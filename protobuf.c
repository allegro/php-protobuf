#include <php.h>
#include <ext/standard/php_string.h>
#include <Zend/zend_exceptions.h>

#include "field_table.h"
#include "php_protobuf.h"
#include "protobuf.h"
#include "reader.h"
#include "writer.h"

#ifndef Z_ADDREF
#define Z_ADDREF(z) ZVAL_ADDREF(&(z))
#endif

#ifndef Z_SET_REFCOUNT
#define Z_SET_REFCOUNT(z, c) ZVAL_REFCOUNT(&(z)) = (c)
#endif

#ifndef Z_UNSET_ISREF
#define Z_UNSET_ISREF(z) PZVAL_IS_REF(&(z)) = 0
#endif

#ifndef ZVAL_COPY_VALUE
#define ZVAL_COPY_VALUE(z, v) \
	do { \
		(z)->value = (v)->value; \
		Z_TYPE_P(z) = Z_TYPE_P(v); \
	} while (0)
#endif

#ifndef INIT_PZVAL_COPY
#define INIT_PZVAL_COPY(z, v) \
	do { \
		ZVAL_COPY_VALUE(z, v); \
		Z_SET_REFCOUNT_P(z, 1); \
		Z_UNSET_ISREF_P(z); \
	} while (0)
#endif

#define PB_COMPILE_ERROR(message, ...) PB_COMPILE_ERROR_EX(getThis(), message, __VA_ARGS__)
#define PB_COMPILE_ERROR_EX(this, message, ...) \
	zend_throw_exception_ex(NULL, 0 TSRMLS_CC, "%s: compile error - " #message, Z_OBJCE_P(this)->name, __VA_ARGS__)
#define PB_CONSTANT(name) \
	zend_declare_class_constant_long(pb_entry, #name, sizeof(#name) - 1, name TSRMLS_CC)
#define PB_PARSE_ERROR(message, ...) \
	PB_PARSE_ERROR_EX(getThis(), message, __VA_ARGS__)
#define PB_PARSE_ERROR_EX(this, message, ...) \
	zend_throw_exception_ex(NULL, 0 TSRMLS_CC, "%s: parse error - " #message, this, __VA_ARGS__)

#define PB_DUMP_METHOD "dump"
#define PB_FIELDS_METHOD "fields"
#define PB_PARSE_FROM_STRING_METHOD "parseFromString"
#define PB_SERIALIZE_TO_STRING_METHOD "serializeToString"
#define PB_PRINT_DEBUG_STRING_METHOD "printDebugString"

#define PB_FIELD_DEFAULT "default"
#define PB_FIELD_NAME "name"
#define PB_FIELD_PACKED "packed"
#define PB_FIELD_REPEATED "repeated"
#define PB_FIELD_REQUIRED "required"
#define PB_FIELD_TYPE "type"

#define MIN_FIELD_NUMBER 0
#define MAX_FIELD_NUMBER 536870911

#define RETURN_THIS() RETURN_ZVAL(this_ptr, 1, 0);

enum
{
	PB_TYPE_DOUBLE = 1,
	PB_TYPE_FIXED32,
	PB_TYPE_FIXED64,
	PB_TYPE_FLOAT,
	PB_TYPE_INT,
	PB_TYPE_SIGNED_INT,
	PB_TYPE_STRING,
	PB_TYPE_BOOL
};

typedef struct {
	zend_object std;

	field_table_t field_table;
} message_t;

zend_class_entry *pb_entry;
zend_object_handlers message_handlers;

static void message_free_object_storage(message_t *intern TSRMLS_DC)
{
	zend_object_std_dtor(&intern->std TSRMLS_CC);

	field_table_destroy(&intern->field_table);

	efree(intern);
}

static zend_object_value message_create_object(zend_class_entry *class_type TSRMLS_DC)
{
	zend_object_value retval;

	message_t *intern = emalloc(sizeof(message_t));
	memset(intern, 0, sizeof(message_t));

	zend_object_std_init(&intern->std, class_type TSRMLS_CC);
#if PHP_VERSION_ID >= 50400
	object_properties_init(&intern->std, class_type);
#else
	zend_hash_copy(intern->std.properties, &(class_type->default_properties),
		(copy_ctor_func_t) zval_add_ref, NULL, sizeof(zval*));
#endif

	retval.handle = zend_objects_store_put(
		intern,
		(zend_objects_store_dtor_t) zend_objects_destroy_object,
		(zend_objects_free_object_storage_t) message_free_object_storage,
		NULL TSRMLS_CC
	);
	retval.handlers = &message_handlers;

	return retval;
}

static field_t *message_get_field(zval *object, long field_number TSRMLS_DC)
{
	if (field_number < MIN_FIELD_NUMBER || field_number > MAX_FIELD_NUMBER) {
		PB_COMPILE_ERROR_EX(object, "%ld: field number is out of range <%d, %d>", field_number, MIN_FIELD_NUMBER, MAX_FIELD_NUMBER);
		return NULL;
	}

	message_t *intern = zend_object_store_get_object(object);

	field_t *field = field_table_get(&intern->field_table, (uint32_t) field_number);
	if (field == NULL) {
		PB_COMPILE_ERROR_EX(object, "%ld: unknown field number", field_number);
		return NULL;
	}

	return field;
}

static zval *pb_prepare_value(zval *this, uint32_t field_number, zval *value);
static int pb_print_field_value(zval *value, long level, zend_bool only_set);
static int pb_dump_field_value(zval *value, long level, zend_bool only_set);
static int pb_print_debug_field_value(zval *value, long level);
static zval **pb_get_field_type(zval *this, zval **field_descriptors, uint32_t field_number);
static zval **pb_get_field_descriptor(zval *this, zval *field_descriptors, uint32_t field_number);
static zval *pb_get_field_descriptors(zval *this);
static const char *pb_get_field_name(zval *this, uint32_t field_number);
static int pb_get_wire_type(int field_type);
static const char *pb_get_wire_type_name(int wire_type);
static int pb_parse_field_value(zval *this, reader_t *reader, long field_number, long field_type, zval *value);
static int pb_serialize_field_value(zval *this, writer_t *writer, uint32_t field_number, zval **type, zval *value);
static int pb_serialize_packed_field(zval *this, writer_t *writer, long field_number, long field_type, zval *values);

static ulong PB_FIELD_DEFAULT_HASH;
static ulong PB_FIELD_REPEATED_HASH;
static ulong PB_FIELD_TYPE_HASH;

PHP_METHOD(ProtobufMessage, __construct)
{
	message_t *intern = zend_object_store_get_object(getThis() TSRMLS_CC);

	zval *field_descriptors = pb_get_field_descriptors(getThis());

	size_t count = (size_t) zend_hash_num_elements(Z_ARRVAL_P(field_descriptors));

	field_table_init(&intern->field_table, count);

	HashPosition i;

	PB_FOREACH(&i, Z_ARRVAL_P(field_descriptors)) {
		ulong field_number;
		zval **field_descriptor;

		zend_hash_get_current_key_ex(Z_ARRVAL_P(field_descriptors), NULL, NULL, &field_number, 0, &i);
		zend_hash_get_current_data_ex(Z_ARRVAL_P(field_descriptors), (void **) &field_descriptor, &i);

		zval **field_repeated;
		int res = zend_hash_quick_find(Z_ARRVAL_PP(field_descriptor), PB_FIELD_REPEATED, sizeof(PB_FIELD_REPEATED), PB_FIELD_REPEATED_HASH, (void **) &field_repeated);

		zval *value;
		MAKE_STD_ZVAL(value);

		if (res == SUCCESS) {
			ALLOC_HASHTABLE(Z_ARRVAL_P(value));
			Z_TYPE_P(value) = IS_ARRAY;
			zend_hash_init(Z_ARRVAL_P(value), 0, NULL, ZVAL_PTR_DTOR, 0);
		} else {
			ZVAL_NULL(value);
		}

		field_t *field = field_table_append(&intern->field_table, (uint32_t) field_number);
		field->value = value;
	}
}

PHP_METHOD(ProtobufMessage, reset)
{
	message_t *object = zend_object_store_get_object(getThis());

	field_table_iter_t iter;
	field_table_iter_init(&iter, &object->field_table);
	field_t *field;
	while ((field = field_table_iter_next(&iter, NULL))) {
		if (Z_REFCOUNT_P(field->value) == 1 && (Z_TYPE_P(field->value) == IS_NULL || (Z_TYPE_P(field->value) == IS_ARRAY && zend_hash_num_elements(Z_ARRVAL_P(field->value)) == 0))) {
			continue;
		}

		int is_array = Z_TYPE_P(field->value) == IS_ARRAY;

		zval_ptr_dtor(&field->value);

		zval *value;

		MAKE_STD_ZVAL(value);

		if (is_array) {
			ALLOC_HASHTABLE(Z_ARRVAL_P(value));
			Z_TYPE_P(value) = IS_ARRAY;
			zend_hash_init(Z_ARRVAL_P(value), 0, NULL, ZVAL_PTR_DTOR, 0);
		} else {
			ZVAL_NULL(value);
		}

		field->value = value;
	}
}

PHP_METHOD(ProtobufMessage, append)
{
	long field_number;
	zval *array, *prepared_value, *value;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "lz", &field_number, &value) == FAILURE) {
		RETURN_THIS();
	}

	field_t *field = message_get_field(getThis(), field_number TSRMLS_CC);
	if (field == NULL) {
		return;
	}

	if (Z_TYPE_P(value) == IS_NULL) {
		RETURN_THIS();
	}

	array = field->value;

	if ((prepared_value = pb_prepare_value(getThis(), (uint32_t) field_number, value)) != NULL) {
		add_next_index_zval(array, prepared_value);
	}

	RETURN_THIS();
}

PHP_METHOD(ProtobufMessage, clear)
{
	long field_number;
	zval *array;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "l", &field_number) == FAILURE) {
		return;
	}

	field_t *field = message_get_field(getThis(), field_number TSRMLS_CC);
	if (field == NULL) {
		return;
	}

	array = field->value;

	if (Z_TYPE_P(array) != IS_ARRAY) {
		PB_COMPILE_ERROR("'%s' field internal type should be an array", pb_get_field_name(getThis(), field_number));

		RETURN_THIS();
	}

	zend_hash_clean(Z_ARRVAL_P(array));

	RETURN_THIS();
}

PHP_METHOD(ProtobufMessage, printDebugString)
{
	int indent;
	char indent_char;
	long level = 0;
	const char *field_name;
	ulong index;
	HashPosition i;
	zval **field_descriptor, *field_descriptors, **val, *value;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "|l", &level) == FAILURE || level < 0) {
		return;
	}

	indent = ((int)level) * 2;
	indent_char = indent ? ' ': '\0';

	if ((field_descriptors = pb_get_field_descriptors(getThis())) == NULL)
		return;

	message_t *object = zend_object_store_get_object(getThis());

	field_table_iter_t iter;
	field_table_iter_init(&iter, &object->field_table);

	uint32_t field_number;
	field_t *field;

	while((field = field_table_iter_next(&iter, &field_number)) != NULL) {
		value = field->value;

		if ((field_descriptor = pb_get_field_descriptor(getThis(), field_descriptors, field_number)) == NULL)
			return;

		if ((field_name = pb_get_field_name(getThis(), field_number)) == NULL)
			return;

		if (Z_TYPE_P(value) == IS_ARRAY) {
			if (zend_hash_num_elements(Z_ARRVAL_P(value)) == 0)
				continue;

			zval **field_type;
			if ((field_type = pb_get_field_type(getThis(), field_descriptor, field_number)) == NULL)
				return;

			int wire = pb_get_wire_type(Z_LVAL_PP(field_type));

			PB_FOREACH(&i, Z_ARRVAL_P(value)) {
				zend_hash_get_current_key_ex(Z_ARRVAL_P(value), NULL, NULL, &index, 0, &i);
				zend_hash_get_current_data_ex(Z_ARRVAL_P(value), (void **) &val, &i);

				if (Z_TYPE_P(value) == IS_NULL)
					continue;

				if ((wire == WIRE_TYPE_LENGTH_DELIMITED && Z_TYPE_PP(val) != IS_STRING) || wire == -1) {
					php_printf("%*c%s {", indent, indent_char, field_name);
					if (pb_print_debug_field_value(*val, level + 1) != 0)
						return;
					php_printf("%*c}\n", indent, indent_char);
				} else {
					php_printf("%*c%s:", indent, indent_char, field_name);
					if (pb_print_debug_field_value(*val, level + 1) != 0)
						return;
				}
			}
		} else if (Z_TYPE_P(value) == IS_OBJECT) {
			php_printf("%*c%s {", indent, indent_char, field_name);
			if (pb_print_debug_field_value(value, level + 1) != 0)
				return;
			php_printf("%*c}\n", indent, indent_char);
		} else if (Z_TYPE_P(value) != IS_NULL) {
			php_printf("%*c%s:", indent, indent_char, field_name);
			if (pb_print_debug_field_value(value, level + 1) != 0)
				return;
		}
	}
}

PHP_METHOD(ProtobufMessage, dump)
{
	zend_bool only_set = 1;
	long level = 0;
	const char *field_name;
	ulong index;
	HashPosition j;
	zval **val, *value;
	message_t *object;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "|bl", &only_set, &level) == FAILURE || level < 0) {
		return;
	}

	if (level > 0)
		php_printf("%*c%s {\n", 2 * (int) level, ' ', Z_OBJCE_P(getThis())->name);
	else
		php_printf("%s {\n", Z_OBJCE_P(getThis())->name);

	object = zend_object_store_get_object(getThis());

	field_table_iter_t iter;
	field_table_iter_init(&iter, &object->field_table);

	uint32_t field_number;
	field_t *field;
	while ((field = field_table_iter_next(&iter, &field_number)) != NULL) {
		value = field->value;

		if ((field_name = pb_get_field_name(getThis(), field_number)) == NULL)
			return;

		if (Z_TYPE_P(value) == IS_ARRAY) {
			if (zend_hash_num_elements(Z_ARRVAL_P(value)) > 0 || !only_set) {
				php_printf("%*c%u: %s(%d) => \n", ((int) level + 1) * 2, ' ', field_number, field_name, zend_hash_num_elements(Z_ARRVAL_P(value)));

				if (zend_hash_num_elements(Z_ARRVAL_P(value)) > 0) {
					PB_FOREACH(&j, Z_ARRVAL_P(value)) {
						zend_hash_get_current_key_ex(Z_ARRVAL_P(value), NULL, NULL, &index, 0, &j);
						zend_hash_get_current_data_ex(Z_ARRVAL_P(value), (void **) &val, &j);

						php_printf("%*c[%lu] =>", ((int) level + 2) * 2, ' ', index);

						if (pb_dump_field_value(*val, level + 3, only_set) != 0)
							return;
					}
				} else
					php_printf("%*cempty\n", ((int) level + 2) * 2, ' ');
			}
		} else if (Z_TYPE_P(value) != IS_NULL || !only_set) {
			php_printf("%*c%u: %s =>", 2 * ((int) level + 1), ' ', field_number, field_name);

			if (pb_dump_field_value(value, level + 1, only_set) != 0)
				return;
		}
	}

	if (level > 0)
		php_printf("%*c}\n", 2 * (int) level, ' ');
	else
		php_printf("}\n");
}

PHP_METHOD(ProtobufMessage, count)
{
	long field_number;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "l", &field_number) == FAILURE) {
		return;
	}

	field_t *field;
	if ((field = message_get_field(getThis(), field_number TSRMLS_CC)) == NULL)
		return;

	zval *value = field->value;

	if (Z_TYPE_P(value) == IS_ARRAY) {
		RETURN_LONG(zend_hash_num_elements(Z_ARRVAL_P(value)));
	} else {
		PB_COMPILE_ERROR("'%s' field internal type should be an array", pb_get_field_name(getThis(), field_number));
		return;
	}
}

PHP_METHOD(ProtobufMessage, get)
{
	long field_number, index = -1;
	zval **val, *value;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "l|l", &field_number, &index) == FAILURE) {
		return;
	}

	field_t *field;
	if ((field = message_get_field(getThis(), field_number TSRMLS_CC)) == NULL) {
		return;
	}

	value = field->value;

	if (index != -1) {
		if (Z_TYPE_P(value) != IS_ARRAY) {
			PB_COMPILE_ERROR("'%s' field internal type should be an array", pb_get_field_name(getThis(), field_number));
			return;
		}

		if (zend_hash_index_find(Z_ARRVAL_P(value), index, (void **) &val) == FAILURE)
			return;

		value = *val;
	} else {
		if (Z_TYPE_P(value) == IS_NULL) {
			zval *field_descriptors = pb_get_field_descriptors(getThis());
			zval **field_descriptor = pb_get_field_descriptor(getThis(), field_descriptors, field->number);
			zval **default_value;
			if (zend_hash_quick_find(Z_ARRVAL_PP(field_descriptor), PB_FIELD_DEFAULT, sizeof(PB_FIELD_DEFAULT), PB_FIELD_DEFAULT_HASH, (void **) &default_value) == SUCCESS) {
				value = *default_value;
			}
		}
	}

	RETURN_ZVAL(value, 1, 0);
}

PHP_METHOD(ProtobufMessage, parseFromString)
{
	char *pack, *str, *subpack;
	zend_class_entry **sub_ce;
	reader_t reader, packed_reader;
	uint8_t wire_type;
	uint32_t field_number;
	int expected_wire_type, str_size, pack_size, subpack_size, ret, field_repeated;
	zval arg, *args, **field_descriptor, **field_type, *field_descriptors, name, *old_value, *value = NULL, zret;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "s", &pack, &pack_size) == FAILURE) {
		return;
	}

	if ((field_descriptors = pb_get_field_descriptors(getThis())) == NULL) {
		return;
	}

	message_t *object = zend_object_store_get_object(getThis());

	reader_init(&reader, pack, pack_size);

	while (reader_has_more(&reader)) {
		if (reader_read_tag(&reader, &field_number, &wire_type) != 0)
			break;

		if (zend_hash_index_find(Z_ARRVAL_P(field_descriptors), field_number, (void **) &field_descriptor) == FAILURE) {
			switch (wire_type)
			{
				case WIRE_TYPE_VARINT:
					ret = reader_skip_varint(&reader);
					break;

				case WIRE_TYPE_64BIT:
					ret = reader_skip_64bit(&reader);
					break;

				case WIRE_TYPE_LENGTH_DELIMITED:
					ret = reader_skip_length_delimited(&reader);
					break;

				case WIRE_TYPE_32BIT:
					ret = reader_skip_32bit(&reader);
					break;

				default:
					PB_PARSE_ERROR("unexpected wire type %ld for unexpected %u field", wire_type, field_number);
					return;
			}

			if (ret != 0) {
				PB_PARSE_ERROR("parse unexpected %u field of wire type %s fail", field_number, pb_get_wire_type_name(wire_type));
				return;
			}

			continue;
		}

		if ((field_type = pb_get_field_type(getThis(), field_descriptor, field_number)) == NULL) {
			return;
		}

		field_t *field = field_table_get(&object->field_table, field_number);
		old_value = field->value;

		field_repeated = (Z_TYPE_P(old_value) == IS_ARRAY);
		if (field_repeated) {
			ALLOC_INIT_ZVAL(value);
			add_next_index_zval(old_value, value);
		} else
			value = old_value;

		if (Z_TYPE_PP(field_type) == IS_STRING) {
			if (wire_type != WIRE_TYPE_LENGTH_DELIMITED) {
				PB_PARSE_ERROR("'%s' field wire type is %s but should be %s", pb_get_field_name(getThis(), field_number), pb_get_wire_type_name(wire_type), pb_get_wire_type_name(WIRE_TYPE_LENGTH_DELIMITED));
				return;
			}
#if ZEND_MODULE_API_NO >= 20100525
			if (zend_lookup_class_ex(Z_STRVAL_PP(field_type), Z_STRLEN_PP(field_type), NULL, 1, &sub_ce TSRMLS_CC) == FAILURE)
#else
			if (zend_lookup_class_ex(Z_STRVAL_PP(field_type), Z_STRLEN_PP(field_type), 1, &sub_ce TSRMLS_CC) == FAILURE)
#endif
			{
				PB_COMPILE_ERROR("class %s for '%s' does not exist", Z_STRVAL_PP(field_type), pb_get_field_name(getThis(), field_number));
				return;
			}

			if (reader_read_string(&reader, &subpack, &subpack_size) == 0) {
				object_init_ex(value, *sub_ce);

				INIT_ZVAL(name);
				ZVAL_STRINGL(&name, ZEND_CONSTRUCTOR_FUNC_NAME, sizeof(ZEND_CONSTRUCTOR_FUNC_NAME) - 1, 0);

				if (call_user_function(NULL, &value, &name, &zret, 0, NULL TSRMLS_CC) == FAILURE) {
					return;
				}

				INIT_ZVAL(name);
				ZVAL_STRINGL(&name, PB_PARSE_FROM_STRING_METHOD, sizeof(PB_PARSE_FROM_STRING_METHOD) - 1, 0);

				INIT_ZVAL(arg);
				ZVAL_STRINGL(&arg, subpack, subpack_size, 0);
				Z_ADDREF(arg);

				args = &arg;

				if (call_user_function(NULL, &value, &name, &zret, 1, &args TSRMLS_CC) == FAILURE)
					return;

				if (Z_TYPE(zret) != IS_BOOL)
					return;
			}
		} else if (Z_TYPE_PP(field_type) == IS_LONG) {
			expected_wire_type = pb_get_wire_type(Z_LVAL_PP(field_type));
			if (field_repeated && wire_type == WIRE_TYPE_LENGTH_DELIMITED && expected_wire_type != WIRE_TYPE_LENGTH_DELIMITED) {
				if (reader_read_string(&reader, &str, &str_size) != 0) {
					PB_PARSE_ERROR("parse '%s' field fail", pb_get_field_name(getThis(), field_number));
					return;
				}

				reader_init(&packed_reader, str, str_size);

				while (reader_has_more(&packed_reader)) {
					if (value == NULL) {
						ALLOC_INIT_ZVAL(value);
						add_next_index_zval(old_value, value);
					}
					if (pb_parse_field_value(getThis(), &packed_reader, field_number, Z_LVAL_PP(field_type), value) != 0) {
						return;
					}
					value = NULL;
				}
			} else {
				if (expected_wire_type != wire_type) {
					PB_PARSE_ERROR("'%s' field wire type is %s but should be %s", pb_get_field_name(getThis(), field_number), pb_get_wire_type_name(wire_type), pb_get_wire_type_name(expected_wire_type));
					return;
				}

				if (pb_parse_field_value(getThis(), &reader, field_number, Z_LVAL_PP(field_type), value) != 0) {
					return;
				}
			}
		} else {
			PB_COMPILE_ERROR("unexpected %s type of '%s' field type in field descriptor", zend_get_type_by_const(Z_TYPE_PP(field_type)), pb_get_field_name(getThis(), field_number));
			return;
		}
	}

	RETURN_TRUE;
}

PHP_METHOD(ProtobufMessage, serializeToString)
{
	writer_t writer;
	char *pack;
	size_t pack_size;
	HashPosition i;
	zval *array, **field_descriptor, *field_descriptors, **packed, **required, **type, *value;

	if ((field_descriptors = pb_get_field_descriptors(getThis())) == NULL)
		return;

	writer_init(&writer);

	message_t *object = zend_object_store_get_object(getThis());

	field_table_iter_t iter;
	field_table_iter_init(&iter, &object->field_table);

	uint32_t field_number;
	field_t *field;

	while((field = field_table_iter_next(&iter, &field_number)) != NULL) {
		if ((field_descriptor = pb_get_field_descriptor(getThis(), field_descriptors, field_number)) == NULL) {
			goto fail;
		}

		if ((type = pb_get_field_type(getThis(), field_descriptor, field_number)) == NULL) {
			goto fail;
		}

		value = field->value;

		if (Z_TYPE_P(value) == IS_NULL) {
			if (zend_hash_find(Z_ARRVAL_PP(field_descriptor), PB_FIELD_REQUIRED, sizeof(PB_FIELD_REQUIRED), (void **) &required) == FAILURE) {
				PB_COMPILE_ERROR("missing '%s' field required property in field descriptor", pb_get_field_name(getThis(), field_number));
				goto fail;
			}

			if (Z_BVAL_PP(required)) {
				zend_throw_exception_ex(NULL, 0 TSRMLS_CC, "%s: '%s' field is required and must be set", Z_OBJCE_P(getThis())->name, pb_get_field_name(getThis(), field_number));
				goto fail;
			}

			continue;
		}

		if (Z_TYPE_P(value) == IS_ARRAY) {
			array = value;

			if (zend_hash_find(Z_ARRVAL_PP(field_descriptor), PB_FIELD_PACKED, sizeof(PB_FIELD_PACKED), (void **) &packed) != FAILURE && Z_BVAL_PP(packed)) {
				if (pb_serialize_packed_field(getThis(), &writer, field_number, Z_LVAL_PP(type), array) != 0)
					goto fail;
			} else {
				PB_FOREACH(&i, Z_ARRVAL_P(array)) {
					zval **val;
					zend_hash_get_current_data_ex(Z_ARRVAL_P(array), (void **) &val, &i);
					if (pb_serialize_field_value(getThis(), &writer, field_number, type, *val) != 0)
						goto fail;
				}
			}
		} else if (pb_serialize_field_value(getThis(), &writer, field_number, type, value) != 0)
			goto fail;
	}

	pack = writer_get_pack(&writer, &pack_size);

	RETURN_STRINGL(pack, pack_size, 0);

fail:
	writer_free_pack(&writer);
}

PHP_METHOD(ProtobufMessage, set)
{
	long field_number;
	zval *prepared_value, *value;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "lz", &field_number, &value) == FAILURE) {
		RETURN_THIS();
	}

	field_t *field = message_get_field(getThis(), field_number TSRMLS_CC);

	if (Z_TYPE_P(value) == IS_NULL) {
		// null value means 'no value', therefore should not be converted
		Z_ADDREF_P(value);
		zval_ptr_dtor(&field->value);
		field->value = value;
	} else {
		if ((prepared_value = pb_prepare_value(getThis(), field_number, value)) != NULL) {
			zval_ptr_dtor(&field->value);
			field->value = prepared_value;
		}
	}

	RETURN_THIS();
}

ZEND_BEGIN_ARG_INFO_EX(arginfo_construct, 0, 0, 0)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_reset, 0, 0, 0)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_append, 0, 0, 2)
	ZEND_ARG_INFO(0, position)
	ZEND_ARG_INFO(0, value)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_clear, 0, 0, 1)
	ZEND_ARG_INFO(0, position)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_printDebugString, 0, 0, 0)
	ZEND_ARG_INFO(0, level)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_dump, 0, 0, 0)
	ZEND_ARG_INFO(0, onlySet)
	ZEND_ARG_INFO(0, level)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_count, 0, 0, 1)
	ZEND_ARG_INFO(0, position)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_get, 0, 0, 1)
	ZEND_ARG_INFO(0, position)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_parseFromString, 0, 0, 1)
	ZEND_ARG_INFO(0, packed)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_serializeToString, 0, 0, 0)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_set, 0, 0, 2)
	ZEND_ARG_INFO(0, position)
	ZEND_ARG_INFO(0, value)
ZEND_END_ARG_INFO()

static zend_function_entry pb_methods[] = {
	PHP_ME(ProtobufMessage, __construct, arginfo_construct, ZEND_ACC_PUBLIC | ZEND_ACC_CTOR)
	PHP_ME(ProtobufMessage, reset, arginfo_reset, ZEND_ACC_PUBLIC)
	PHP_ME(ProtobufMessage, append, arginfo_append, ZEND_ACC_PUBLIC)
	PHP_ME(ProtobufMessage, clear, arginfo_clear, ZEND_ACC_PUBLIC)
	PHP_ME(ProtobufMessage, dump, arginfo_dump, ZEND_ACC_PUBLIC)
	PHP_ME(ProtobufMessage, count, arginfo_count, ZEND_ACC_PUBLIC)
	PHP_ME(ProtobufMessage, get, arginfo_get, ZEND_ACC_PUBLIC)
	PHP_ME(ProtobufMessage, parseFromString, arginfo_parseFromString, ZEND_ACC_PUBLIC)
	PHP_ME(ProtobufMessage, serializeToString, arginfo_serializeToString, ZEND_ACC_PUBLIC)
	PHP_ME(ProtobufMessage, set, arginfo_set, ZEND_ACC_PUBLIC)
	PHP_ME(ProtobufMessage, printDebugString, arginfo_printDebugString, ZEND_ACC_PUBLIC)
	{NULL, NULL, NULL, 0, 0}
};

PHP_MINIT_FUNCTION(allegro_protobuf)
{
	zend_class_entry ce;

	PB_FIELD_DEFAULT_HASH = zend_get_hash_value(PB_FIELD_DEFAULT, sizeof(PB_FIELD_DEFAULT));
	PB_FIELD_REPEATED_HASH = zend_get_hash_value(PB_FIELD_REPEATED, sizeof(PB_FIELD_REPEATED));
	PB_FIELD_TYPE_HASH = zend_get_hash_value(PB_FIELD_TYPE, sizeof(PB_FIELD_TYPE));

	INIT_CLASS_ENTRY(ce, "ProtobufMessage", pb_methods);
	pb_entry = zend_register_internal_class(&ce TSRMLS_CC);
	pb_entry->create_object = message_create_object;

	memcpy(&message_handlers, zend_get_std_object_handlers(), sizeof(zend_object_handlers));

	PB_CONSTANT(PB_TYPE_DOUBLE);
	PB_CONSTANT(PB_TYPE_FIXED32);
	PB_CONSTANT(PB_TYPE_FIXED64);
	PB_CONSTANT(PB_TYPE_FLOAT);
	PB_CONSTANT(PB_TYPE_INT);
	PB_CONSTANT(PB_TYPE_SIGNED_INT);
	PB_CONSTANT(PB_TYPE_STRING);
	PB_CONSTANT(PB_TYPE_BOOL);

	return SUCCESS;
}

zend_module_entry allegro_protobuf_module_entry = {
#if ZEND_MODULE_API_NO >= 20010901
	STANDARD_MODULE_HEADER,
#endif
	PHP_PROTOBUF_EXTNAME,
	NULL,
	PHP_MINIT(allegro_protobuf),
	NULL,
	NULL,
	NULL,
	NULL,
#if ZEND_MODULE_API_NO >= 20010901
	PHP_PROTOBUF_VERSION,
#endif
	STANDARD_MODULE_PROPERTIES
};

#ifdef COMPILE_DL_ALLEGRO_PROTOBUF
ZEND_GET_MODULE(allegro_protobuf)
#endif

static zval *pb_prepare_value(zval *this, uint32_t field_number, zval *value)
{
	zval *converted_value, **field_descriptor, *field_descriptors, **type;
	long expected_type;
	TSRMLS_FETCH();

	if ((field_descriptors = pb_get_field_descriptors(this)) == NULL)
		goto fail;

	if ((field_descriptor = pb_get_field_descriptor(this, field_descriptors, field_number)) == NULL)
		goto fail;

	if ((type = pb_get_field_type(this, field_descriptor, field_number)) == NULL)
		goto fail;

	if (Z_TYPE_PP(type) == IS_LONG) {
		switch (Z_LVAL_PP(type))
		{
			case PB_TYPE_DOUBLE:
			case PB_TYPE_FLOAT:
				expected_type = IS_DOUBLE;
				break;

			case PB_TYPE_FIXED32:
			case PB_TYPE_INT:
			case PB_TYPE_FIXED64:
			case PB_TYPE_SIGNED_INT:
			case PB_TYPE_BOOL:
				expected_type = IS_LONG;
				break;

			case PB_TYPE_STRING:
				expected_type = IS_STRING;
				break;

			default:
				PB_COMPILE_ERROR_EX(this, "unexpected '%s' field type %d in field descriptor", pb_get_field_name(this, field_number), zend_get_type_by_const(Z_LVAL_PP(type)));
				goto fail;
		}

		if (Z_TYPE_P(value) != expected_type) {
			ALLOC_ZVAL(converted_value);
			INIT_PZVAL_COPY(converted_value, value);
			zval_copy_ctor(converted_value);
			convert_to_explicit_type(converted_value, expected_type);
			return converted_value;
		}
	} else if (Z_TYPE_PP(type) != IS_STRING) {
		PB_COMPILE_ERROR_EX(this, "unexpected %s type of '%s' field type in field descriptor", zend_get_type_by_const(Z_TYPE_PP(type)), pb_get_field_name(this, field_number));
		goto fail;
	}

	Z_ADDREF_P(value);
	return value;

fail:
	return NULL;
}

static int pb_print_field_value(zval *value, long level, zend_bool only_set)
{
	const char *string_value;
	zval tmp;
	TSRMLS_FETCH();

	INIT_ZVAL(tmp);

	if (Z_TYPE_P(value) == IS_NULL)
		string_value = "null";
	else if (Z_TYPE_P(value) == IS_BOOL) {
		if (Z_BVAL_P(value) )
			string_value = "true";
		else
			string_value = "false";
	} else {
		tmp = *value;
		zval_copy_ctor(&tmp);
		Z_SET_REFCOUNT(tmp, 1);
		Z_UNSET_ISREF(tmp);
		convert_to_string(&tmp);
		string_value = Z_STRVAL(tmp);
	}

	if (Z_TYPE_P(value) == IS_STRING)
		php_printf(" \"%s\"\n", string_value);
	else
		php_printf(" %s\n", string_value);

	zval_dtor(&tmp);

	return 0;
}

static int pb_print_debug_field_value(zval *value, long level)
{
	zval tmp, ret, arg0, *args[1];
	TSRMLS_FETCH();

	INIT_ZVAL(tmp);

	if (Z_TYPE_P(value) == IS_OBJECT) {
		php_printf("\n");

		INIT_ZVAL(arg0);
		Z_TYPE(arg0) = IS_LONG;
		Z_LVAL(arg0) = level;
		Z_ADDREF(arg0);

		args[0] = &arg0;

		ZVAL_STRING(&tmp, PB_PRINT_DEBUG_STRING_METHOD, 0);

		if (call_user_function(NULL, &value, &tmp, &ret, 1, args TSRMLS_CC) == FAILURE)
			return -1;
		else
			return 0;
	}

	return pb_print_field_value(value, level, 1);
}

static int pb_dump_field_value(zval *value, long level, zend_bool only_set)
{
	zval tmp, ret, arg0, arg1, *args[2];
	TSRMLS_FETCH();

	INIT_ZVAL(tmp);

	if (Z_TYPE_P(value) == IS_OBJECT) {
		php_printf("\n");

		INIT_ZVAL(arg0);
		Z_TYPE(arg0) = IS_BOOL;
		Z_LVAL(arg0) = only_set;
		Z_ADDREF(arg0);

		INIT_ZVAL(arg1);
		Z_TYPE(arg1) = IS_LONG;
		Z_LVAL(arg1) = level;
		Z_ADDREF(arg1);

		args[0] = &arg0;
		args[1] = &arg1;

		ZVAL_STRING(&tmp, PB_DUMP_METHOD, 0);

		if (call_user_function(NULL, &value, &tmp, &ret, 2, args TSRMLS_CC) == FAILURE)
			return -1;
		else
			return 0;
	}

	return pb_print_field_value(value, level, only_set);
}

static zval **pb_get_field_descriptor(zval *this, zval *field_descriptors, uint32_t field_number)
{
	zval **field_descriptor = NULL;
	TSRMLS_FETCH();

	if (zend_hash_index_find(Z_ARRVAL_P(field_descriptors), field_number, (void **) &field_descriptor) == FAILURE)
		PB_COMPILE_ERROR_EX(this, "missing %u field descriptor", field_number);

	return field_descriptor;
}

static zval **pb_get_field_type(zval *this, zval **field_descriptor, uint32_t field_number)
{
	zval **field_type;
	TSRMLS_FETCH();

	if (zend_hash_quick_find(Z_ARRVAL_PP(field_descriptor), PB_FIELD_TYPE, sizeof(PB_FIELD_TYPE), PB_FIELD_TYPE_HASH, (void **) &field_type) == FAILURE)
		PB_COMPILE_ERROR_EX(this, "missing '%s' field type property in field descriptor", pb_get_field_name(this, field_number));

	return field_type;
}

static zval *pb_get_field_descriptors(zval *this)
{
	zval *descriptors, method;
	TSRMLS_FETCH();

	INIT_ZVAL(method);
	ZVAL_STRINGL(&method, PB_FIELDS_METHOD, sizeof(PB_FIELDS_METHOD) - 1, 0);

	call_user_function_ex(NULL, &this, &method, &descriptors, 0, NULL, 0, NULL TSRMLS_CC);

	Z_DELREF_P(descriptors);

	return descriptors;
}

static const char *pb_get_field_name(zval *this, uint32_t field_number)
{
	zval **field_descriptor, *field_descriptors, **field_name;
	TSRMLS_FETCH();

	if ((field_descriptors = pb_get_field_descriptors(this)) == NULL)
		return NULL;

	if ((field_descriptor = pb_get_field_descriptor(this, field_descriptors, field_number)) == NULL)
		return NULL;

	if (zend_hash_find(Z_ARRVAL_PP((field_descriptor)), PB_FIELD_NAME, sizeof(PB_FIELD_NAME), (void **) &(field_name))) {
		PB_COMPILE_ERROR_EX(this, "missing %u field name property in field descriptor", field_number);
		return NULL;
	}

	return (const char *) Z_STRVAL_PP(field_name);
}

static int pb_get_wire_type(int field_type)
{
	int ret;

	switch (field_type)
	{
		case PB_TYPE_DOUBLE:
		case PB_TYPE_FIXED64:
			ret = WIRE_TYPE_64BIT;
			break;

		case PB_TYPE_FIXED32:
		case PB_TYPE_FLOAT:
			ret = WIRE_TYPE_32BIT;
			break;

		case PB_TYPE_INT:
		case PB_TYPE_SIGNED_INT:
		case PB_TYPE_BOOL:
			ret = WIRE_TYPE_VARINT;
			break;

		case PB_TYPE_STRING:
			ret = WIRE_TYPE_LENGTH_DELIMITED;
			break;

		default:
			ret = -1;
			break;
	}

	return ret;
}

static const char *pb_get_wire_type_name(int wire_type)
{
	const char *name;

	switch (wire_type)
	{
		case WIRE_TYPE_VARINT:
			name = "varint";
			break;

		case WIRE_TYPE_64BIT:
			name = "64bit";
			break;

		case WIRE_TYPE_LENGTH_DELIMITED:
			name = "length-delimited";
			break;

		case WIRE_TYPE_32BIT:
			name = "32bit";
			break;

		default:
			name = "unknown";
			break;
	}

	return name;
}

static int pb_parse_field_value(zval *this, reader_t *reader, long field_number, long field_type, zval *value)
{
	int ret, str_size;
	char *str;

	switch (field_type)
	{
		case PB_TYPE_DOUBLE:
			Z_TYPE_P(value) = IS_DOUBLE;
			ret = reader_read_double(reader, &Z_DVAL_P(value));
			break;

		case PB_TYPE_FIXED32:
			Z_TYPE_P(value) = IS_LONG;
			ret = reader_read_fixed32(reader, &Z_LVAL_P(value));
			break;

		case PB_TYPE_FIXED64:
			Z_TYPE_P(value) = IS_LONG;
			ret = reader_read_fixed64(reader, &Z_LVAL_P(value));
			break;

		case PB_TYPE_FLOAT:
			Z_TYPE_P(value) = IS_DOUBLE;
			ret = reader_read_float(reader, &Z_DVAL_P(value));
			break;

		case PB_TYPE_INT:
			Z_TYPE_P(value) = IS_LONG;
			ret = reader_read_int(reader, &Z_LVAL_P(value));
			break;

		case PB_TYPE_BOOL:
			Z_TYPE_P(value) = IS_BOOL;
			ret = reader_read_int(reader, &Z_LVAL_P(value));
			break;

		case PB_TYPE_SIGNED_INT:
			Z_TYPE_P(value) = IS_LONG;
			ret = reader_read_signed_int(reader, &Z_LVAL_P(value));
			break;

		case PB_TYPE_STRING:
			if ((ret = reader_read_string(reader, &str, &str_size)) == 0)
				ZVAL_STRINGL(value, str, str_size, 1);
			break;

		default:
			PB_COMPILE_ERROR_EX(this, "unexpected '%s' field type %d in field descriptor", pb_get_field_name(this, field_number), field_type);
			return -1;
	}

	if (ret != 0) {
		PB_PARSE_ERROR_EX(this, "parse '%s' field fail", pb_get_field_name(this, field_number));
	}

	return ret;
}

static int pb_serialize_field_value(zval *this, writer_t *writer, uint32_t field_number, zval **type, zval *value)
{
	int r;
	zval ret, method;
	TSRMLS_FETCH();

	if (Z_TYPE_PP(type) == IS_STRING) {
		INIT_ZVAL(method);
		ZVAL_STRING(&method, PB_SERIALIZE_TO_STRING_METHOD, 0);

		if (call_user_function(NULL, &value, &method, &ret, 0, NULL TSRMLS_CC) == FAILURE)
			return -1;

		if (Z_TYPE(ret) != IS_STRING)
			return -1;

		writer_write_message(writer, field_number, Z_STRVAL(ret), Z_STRLEN(ret));

		zval_dtor(&ret);
	} else if (Z_TYPE_PP(type) == IS_LONG) {
		switch (Z_LVAL_PP(type))
		{
			case PB_TYPE_DOUBLE:
				r = writer_write_double(writer, field_number, Z_DVAL_P(value));
				break;

			case PB_TYPE_FIXED32:
				r = writer_write_fixed32(writer, field_number, Z_LVAL_P(value));
				break;

			case PB_TYPE_INT:
			case PB_TYPE_BOOL:
				r = writer_write_int(writer, field_number, Z_LVAL_P(value));
				break;

			case PB_TYPE_FIXED64:
				r = writer_write_fixed64(writer, field_number, Z_LVAL_P(value));
				break;

			case PB_TYPE_FLOAT:
				r = writer_write_float(writer, field_number, Z_DVAL_P(value));
				break;

			case PB_TYPE_SIGNED_INT:
				r = writer_write_signed_int(writer, field_number, Z_LVAL_P(value));
				break;

			case PB_TYPE_STRING:
				r = writer_write_string(writer, field_number, Z_STRVAL_P(value), Z_STRLEN_P(value));
				break;

			default:
				PB_COMPILE_ERROR_EX(this, "unexpected '%s' field type %d in field descriptor", pb_get_field_name(this, field_number), Z_LVAL_PP(type));
				return -1;
		}

		if (r != 0) {
			return -1;
		}
	} else {
		PB_COMPILE_ERROR_EX(this, "unexpected %s type of '%s' field type in field descriptor", zend_get_type_by_const(Z_TYPE_PP(type)), pb_get_field_name(this, field_number));
		return -1;
	}

	return 0;
}

static int pb_serialize_packed_field(zval *this, writer_t *writer, long field_number, long field_type, zval *values)
{
	int ret = 0;

	switch (field_type)
	{
		case PB_TYPE_DOUBLE:
			ret = writer_write_packed_double(writer, field_number, values);
			break;

		case PB_TYPE_FIXED32:
			ret = writer_write_packed_fixed32(writer, field_number, values);
			break;

		case PB_TYPE_FIXED64:
			ret = writer_write_packed_fixed64(writer, field_number, values);
			break;

		case PB_TYPE_FLOAT:
			ret = writer_write_packed_float(writer, field_number, values);
			break;

		case PB_TYPE_SIGNED_INT:
			ret = writer_write_packed_signed_int(writer, field_number, values);
			break;

		case PB_TYPE_INT:
		case PB_TYPE_BOOL:
			ret = writer_write_packed_int(writer, field_number, values);
			break;

		default:
			PB_COMPILE_ERROR_EX(this, "unexpected '%s' type %d for packed field in field descriptor", pb_get_field_name(this, field_number), field_type);
			return -1;
	}

	return ret;
}
