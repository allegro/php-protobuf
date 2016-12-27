#include <php.h>
#include <ext/standard/php_string.h>
#include <Zend/zend_exceptions.h>

#include "php_protobuf.h"
#include "protobuf.h"
#include "reader.h"
#include "writer.h"

#define PB_COMPILE_ERROR(message, ...) PB_COMPILE_ERROR_EX(getThis(), message, __VA_ARGS__)
#define PB_COMPILE_ERROR_EX(this, message, ...) \
	zend_throw_exception_ex(NULL, 0 TSRMLS_CC, "%s: compile error - " #message, ZSTR_VAL(Z_OBJCE_P(this)->name), __VA_ARGS__)
#define PB_CONSTANT(name) \
	zend_declare_class_constant_long(pb_entry, #name, sizeof(#name) - 1, name TSRMLS_CC)
#define PB_PARSE_ERROR(message, ...) \
	PB_PARSE_ERROR_EX(getThis(), message, __VA_ARGS__)
#define PB_PARSE_ERROR_EX(this, message, ...) \
	zend_throw_exception_ex(NULL, 0 TSRMLS_CC, "%s: parse error - " #message, ZSTR_VAL(Z_OBJCE_P(this)->name), __VA_ARGS__)
#define IS_BOOL(zval) ((Z_TYPE(zval) == IS_FALSE) || (Z_TYPE(zval) == IS_TRUE))

#define PB_RESET_METHOD "reset"
#define PB_DUMP_METHOD "dump"
#define PB_FIELDS_METHOD "fields"
#define PB_PARSE_FROM_STRING_METHOD "parseFromString"
#define PB_SERIALIZE_TO_STRING_METHOD "serializeToString"
#define PB_PRINT_DEBUG_STRING_METHOD "printDebugString"

#define PB_FIELD_NAME "name"
#define PB_FIELD_PACKED "packed"
#define PB_FIELD_REQUIRED "required"
#define PB_FIELD_TYPE "type"
#define PB_VALUES_PROPERTY "values"

#define RETURN_THIS() RETURN_ZVAL(getThis(), 1, 0);

// when opcache is enabled initial array could be stored in
// shared memory as an immutable one, in this case it should be separated
#define ARRAY_ADD_NEXT_INDEX(array, zval_p) \
	if (Z_IMMUTABLE_P(array)) SEPARATE_ARRAY(array); \
	add_next_index_zval((array), (zval_p))

#define IS_32_BIT (sizeof(zend_long) < sizeof(int64_t))

#define ZVAL_INT64(zval, value) \
	if ((value) > ZEND_LONG_MAX || (value) < ZEND_LONG_MIN) { \
		ZVAL_DOUBLE(zval, (double)(value)); \
	} else { \
		ZVAL_LONG(zval, (zend_long)(value)); \
	}

#define Z_LVAL_INT64(zval, int64_out_p)         \
	if (Z_TYPE_P(zval) == IS_DOUBLE) {          \
		*int64_out_p = (int64_t)Z_DVAL_P(zval); \
	} else {                                    \
		*int64_out_p = (int64_t)Z_LVAL_P(zval); \
	}

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

zend_class_entry *pb_entry;

static int pb_assign_value(zval *this, zval *dst, zval *src, zend_ulong field_number);
static int pb_print_field_value(zval *value, zend_long level, zend_bool only_set);
static int pb_dump_field_value(zval *value, zend_long level, zend_bool only_set);
static int pb_print_debug_field_value(zval *value, zend_long level);
static zval *pb_get_field_type(zval *this, zval *field_descriptors, zend_ulong field_number);
static zval *pb_get_field_descriptor(zval *this, zval *field_descriptors, zend_ulong field_number);
static int pb_get_field_descriptors(zval *this, zval* return_value);
static const char *pb_get_field_name(zval *this, zend_ulong field_number);

static int pb_get_wire_type(int field_type);
static const char *pb_get_wire_type_name(int wire_type);
static zval *pb_get_value(zval *this, zval *values, zend_ulong field_number);
static zval *pb_get_values(zval *this);
static int pb_parse_field_value(zval *this, reader_t *reader, zend_ulong field_number, zend_long field_type, zval *value);
static int pb_serialize_field_value(zval *this, writer_t *writer, zend_ulong field_number, zval *type, zval *value);
static int pb_serialize_packed_field(zval *this, writer_t *writer, zend_ulong field_number, zend_long field_type, zval *values);
static int pb_is_field_packed(zval *field_descriptor);

PHP_METHOD(ProtobufMessage, __construct)
{
	zval values;
	array_init(&values);

	add_property_zval(getThis(), PB_VALUES_PROPERTY, &values);
	zval_ptr_dtor(&values);
}

PHP_METHOD(ProtobufMessage, append)
{
	zend_long field_number;
	zval *array, *value, *values, val;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "lz", &field_number, &value) == FAILURE) {
		RETURN_THIS();
	}

	if (Z_TYPE_P(value) == IS_NULL)
		RETURN_THIS();

	if ((values = pb_get_values(getThis())) == NULL)
		RETURN_THIS();

	if ((array = pb_get_value(getThis(), values, (zend_ulong)field_number)) == NULL)
		RETURN_THIS();

	if (pb_assign_value(getThis(), &val, value, (zend_ulong)field_number) != 0) {
		RETURN_THIS();
	}

	ARRAY_ADD_NEXT_INDEX(array, &val);
	RETURN_THIS();
}

PHP_METHOD(ProtobufMessage, clear)
{
	zend_long field_number;
	zval *array, *values;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "l", &field_number) == FAILURE) {
		return;
	}

	if ((values = pb_get_values(getThis())) == NULL)
		RETURN_THIS();

	if ((array = pb_get_value(getThis(), values, (zend_ulong)field_number)) == NULL)
		RETURN_THIS();

	if (Z_TYPE_P(array) != IS_ARRAY) {
		PB_COMPILE_ERROR("'%s' field internal type should be an array", pb_get_field_name(getThis(), (zend_ulong)field_number));

		RETURN_THIS();
	}

	zend_hash_clean(Z_ARRVAL_P(array));
	RETURN_THIS();
}

PHP_METHOD(ProtobufMessage, printDebugString)
{
	int indent;
	char indent_char;
	zend_long level = 0;
	const char *field_name;
	zend_ulong field_number, index;
	HashPosition i, j;
	zval *field_descriptor, field_descriptors, *val, *value, *values;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "|l", &level) == FAILURE || level < 0) {
		return;
	}

	indent = ((int)level) * 2;
	indent_char = indent ? ' ': '\0';

	if ((values = pb_get_values(getThis())) == NULL)
		return;

	if (pb_get_field_descriptors(getThis(), &field_descriptors))
		return;

	int is_loop_finished = 0;
	PB_FOREACH(&i, Z_ARRVAL_P(values)) {
		if (is_loop_finished)
			break;

		zend_hash_get_current_key_ex(Z_ARRVAL_P(values), NULL, &field_number, &i);
		value = zend_hash_get_current_data_ex(Z_ARRVAL_P(values), &i);

		if ((field_descriptor = pb_get_field_descriptor(getThis(), &field_descriptors, field_number)) == NULL)
			break;

		if ((field_name = pb_get_field_name(getThis(), field_number)) == NULL)
			break;

		if (Z_TYPE_P(value) == IS_ARRAY) {
			if (zend_hash_num_elements(Z_ARRVAL_P(value)) == 0)
				continue;

			zval *field_type;
			if ((field_type = pb_get_field_type(getThis(), field_descriptor, field_number)) == NULL)
				break;

			int wire = pb_get_wire_type(Z_LVAL_P(field_type));

			PB_FOREACH(&j, Z_ARRVAL_P(value)) {
				zend_hash_get_current_key_ex(Z_ARRVAL_P(value), NULL, &index, &j);
				val = zend_hash_get_current_data_ex(Z_ARRVAL_P(value), &j);

				if (Z_TYPE_P(value) == IS_NULL) // make sure it's not Z_TYPE_P(val)
					continue;

				if ((wire == WIRE_TYPE_LENGTH_DELIMITED && Z_TYPE_P(val) != IS_STRING) || wire == -1) {
					php_printf("%*c%s {", indent, indent_char, field_name);
					if (pb_print_debug_field_value(val, level + 1) != 0) {
						is_loop_finished = 1;
						break;
					}
					php_printf("%*c}\n", indent, indent_char);
				} else {
					php_printf("%*c%s:", indent, indent_char, field_name);
					if (pb_print_debug_field_value(val, level + 1) != 0) {
						is_loop_finished = 1;
						break;
					}
				}
			}
		} else if (Z_TYPE_P(value) == IS_OBJECT) {
			php_printf("%*c%s {", indent, indent_char, field_name);
			if (pb_print_debug_field_value(value, level + 1) != 0)
				break;
			php_printf("%*c}\n", indent, indent_char);
		} else if (Z_TYPE_P(value) != IS_NULL) {
			php_printf("%*c%s:", indent, indent_char, field_name);
			if (pb_print_debug_field_value(value, level + 1) != 0)
				break;
		}
	}

	zval_ptr_dtor(&field_descriptors);
}

PHP_METHOD(ProtobufMessage, dump)
{
	zend_bool only_set = 1;
	zend_long level = 0;
	const char *field_name;
	zend_ulong field_number, index;
	HashPosition i, j;
	zval *field_descriptor, field_descriptors, *val, *value, *values;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "|bl", &only_set, &level) == FAILURE || level < 0) {
		return;
	}

	if (pb_get_field_descriptors(getThis(), &field_descriptors))
		return;

	if ((values = pb_get_values(getThis())) == NULL)
		goto fail0;

	if (level > 0)
		php_printf("%*c%s {\n", 2 * (int) level, ' ', ZSTR_VAL(Z_OBJCE_P(getThis())->name));
	else
		php_printf("%s {\n", ZSTR_VAL(Z_OBJCE_P(getThis())->name));

	PB_FOREACH(&i, Z_ARRVAL_P(values)) {
		zend_hash_get_current_key_ex(Z_ARRVAL_P(values), NULL, &field_number, &i);
		value = zend_hash_get_current_data_ex(Z_ARRVAL_P(values), &i);
		if ((field_descriptor = pb_get_field_descriptor(getThis(), &field_descriptors, field_number)) == NULL)
			goto fail0;

		if ((field_name = pb_get_field_name(getThis(), field_number)) == NULL)
			goto fail0;

		if (Z_TYPE_P(value) == IS_ARRAY) {
			if (zend_hash_num_elements(Z_ARRVAL_P(value)) > 0 || !only_set) {
				php_printf("%*c%lu: %s(%u) => \n", ((int) level + 1) * 2, ' ', (uint64_t)field_number, field_name, zend_hash_num_elements(Z_ARRVAL_P(value)));

				if (zend_hash_num_elements(Z_ARRVAL_P(value)) > 0) {
					PB_FOREACH(&j, Z_ARRVAL_P(value)) {
						zend_hash_get_current_key_ex(Z_ARRVAL_P(value), NULL, &index, &j);
						val = zend_hash_get_current_data_ex(Z_ARRVAL_P(value), &j);

						php_printf("%*c[%lu] =>", ((int) level + 2) * 2, ' ', (uint64_t)index);

						if (pb_dump_field_value(val, level + 3, only_set) != 0)
							goto fail0;
					}
				} else
					php_printf("%*cempty\n", ((int) level + 2) * 2, ' ');
			}
		} else if (Z_TYPE_P(value) != IS_NULL || !only_set) {
			php_printf("%*c%lu: %s =>", 2 * ((int) level + 1), ' ', (uint64_t)field_number, field_name);

			if (pb_dump_field_value(value, level + 1, only_set) != 0)
				goto fail0;
		}
	}

	if (level > 0)
		php_printf("%*c}\n", 2 * (int) level, ' ');
	else
		php_printf("}\n");

fail0:
	zval_ptr_dtor(&field_descriptors);
}

PHP_METHOD(ProtobufMessage, count)
{
	zend_long field_number;
	zval *value, *values;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "l", &field_number) == FAILURE) {
		return;
	}

	if ((values = pb_get_values(getThis())) == NULL)
		return;

	if ((value = pb_get_value(getThis(), values, (zend_ulong)field_number)) == NULL)
		return;

	if (Z_TYPE_P(value) == IS_ARRAY) {
		RETURN_LONG(zend_hash_num_elements(Z_ARRVAL_P(value)));
	} else {
		PB_COMPILE_ERROR("'%s' field internal type should be an array", pb_get_field_name(getThis(), (zend_ulong)field_number));
		return;
	}
}

PHP_METHOD(ProtobufMessage, get)
{
	zend_long field_number, index = -1;
	zval *val, *value, *values;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "l|l", &field_number, &index) == FAILURE) {
		return;
	}

	if ((values = pb_get_values(getThis())) == NULL)
		return;

	if ((value = pb_get_value(getThis(), values, (zend_ulong)field_number)) == NULL)
		return;

	if (index != -1) {
		if (Z_TYPE_P(value) != IS_ARRAY) {
			PB_COMPILE_ERROR("'%s' field internal type should be an array", pb_get_field_name(getThis(), (zend_ulong)field_number));
			return;
		}

		val = zend_hash_index_find(Z_ARRVAL_P(value), index);
		if (val == NULL)
			return;

		value = val;
	}

	RETURN_ZVAL(value, 1, 0);
}

PHP_METHOD(ProtobufMessage, parseFromString)
{
	char *pack, *str, *subpack;
	zend_class_entry *sub_ce;
	reader_t reader, packed_reader;
	uint8_t wire_type;
	zend_ulong field_number;
	uint64_t next_field_number;
	int32_t int32_value;
	int64_t int64_value;
	int expected_wire_type, str_size, subpack_size, ret, field_repeated;
	size_t pack_size;
	zval arg, *args, *field_descriptor, *field_type, field_descriptors, name, *old_value, value, *values, zret;
	int bool_value;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "s", &pack, &pack_size) == FAILURE)
		return;

	ZVAL_STRINGL(&name, PB_RESET_METHOD, sizeof(PB_RESET_METHOD) - 1);

	if (call_user_function(NULL, getThis(), &name, &zret, 0, NULL TSRMLS_CC) == FAILURE) {
		zval_ptr_dtor(&name);
		return;
	}

	zval_ptr_dtor(&name);
	zval_ptr_dtor(&zret);

	if (pb_get_field_descriptors(getThis(), &field_descriptors))
		return;

	if ((values = pb_get_values(getThis())) == NULL)
		goto fail0;

	reader_init(&reader, pack, pack_size);

	while (reader_has_more(&reader)) {
		if (reader_read_tag(&reader, &next_field_number, &wire_type) != 0)
			break;
		field_number = (zend_ulong)next_field_number;

		if ((field_descriptor = zend_hash_index_find(Z_ARRVAL(field_descriptors), field_number)) == NULL) {
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
					PB_PARSE_ERROR("unexpected wire type %ld for unexpected %lu field", wire_type, (uint64_t)field_number);
					goto fail0;
			}

			if (ret != 0) {
				PB_PARSE_ERROR("parse unexpected %lu field of wire type %s fail", (uint64_t)field_number, pb_get_wire_type_name(wire_type));
				goto fail0;
			}

			continue;
		}

		if ((field_type = pb_get_field_type(getThis(), field_descriptor, field_number)) == NULL)
			goto fail0;

		if ((old_value = pb_get_value(getThis(), values, field_number)) == NULL)
			goto fail0;

		ZVAL_NULL(&value);
		field_repeated = (Z_TYPE_P(old_value) == IS_ARRAY);

		if (Z_TYPE_P(field_type) == IS_STRING) {
			if (wire_type != WIRE_TYPE_LENGTH_DELIMITED) {
				PB_PARSE_ERROR("'%s' field wire type is %s but should be %s", pb_get_field_name(getThis(), field_number), pb_get_wire_type_name(wire_type), pb_get_wire_type_name(WIRE_TYPE_LENGTH_DELIMITED));
				goto fail0;
			}
			if ((sub_ce = zend_lookup_class_ex(Z_STR_P(field_type), NULL, 1)) == NULL) {
				PB_COMPILE_ERROR("class %s for '%s' does not exist", Z_STRVAL_P(field_type), pb_get_field_name(getThis(), field_number));
				goto fail0;
			}

			if ((ret = reader_read_string(&reader, &subpack, &subpack_size)) == 0) {
				object_init_ex(&value, sub_ce);

				ZVAL_STRINGL(&name, ZEND_CONSTRUCTOR_FUNC_NAME, sizeof(ZEND_CONSTRUCTOR_FUNC_NAME) - 1);

				if (call_user_function(NULL, &value, &name, &zret, 0, NULL TSRMLS_CC) == FAILURE) {
					zval_ptr_dtor(&name);
					goto fail0;
				}

				zval_ptr_dtor(&name);
				zval_ptr_dtor(&zret);

				ZVAL_STRINGL(&name, PB_PARSE_FROM_STRING_METHOD, sizeof(PB_PARSE_FROM_STRING_METHOD) - 1);
				ZVAL_STRINGL(&arg, subpack, subpack_size);

				args = &arg;
				if (call_user_function(NULL, &value, &name, &zret, 1, args TSRMLS_CC) == FAILURE) {
					zval_ptr_dtor(&name);
					goto fail0;
				}

				zval_ptr_dtor(&arg);
				zval_ptr_dtor(&name);

				bool_value = (Z_TYPE(zret) != IS_TRUE) && (Z_TYPE(zret) != IS_FALSE);
				zval_ptr_dtor(&zret);

				if (bool_value) {
					goto fail0;
				}
			}
		} else if (Z_TYPE_P(field_type) == IS_LONG) {
			expected_wire_type = pb_get_wire_type(Z_LVAL_P(field_type));
			if (field_repeated && wire_type == WIRE_TYPE_LENGTH_DELIMITED && expected_wire_type != WIRE_TYPE_LENGTH_DELIMITED) {
				if (reader_read_string(&reader, &str, &str_size) != 0) {
					PB_PARSE_ERROR("parse '%s' field fail", pb_get_field_name(getThis(), field_number));
					goto fail0;
				}

				reader_init(&packed_reader, str, str_size);
				while (reader_has_more(&packed_reader)) {
					if (pb_parse_field_value(getThis(), &packed_reader, field_number, Z_LVAL_P(field_type), &value) != 0) {
						return;
					}

					if (Z_REFCOUNTED(value))
						Z_ADDREF(value);
					ARRAY_ADD_NEXT_INDEX(old_value, &value);
					zval_ptr_dtor(&value);
				}

				continue;

			} else {
				if (expected_wire_type != wire_type) {
					PB_PARSE_ERROR("'%s' field wire type is %s but should be %s", pb_get_field_name(getThis(), field_number), pb_get_wire_type_name(wire_type), pb_get_wire_type_name(expected_wire_type));
					goto fail0;
				}

				if (pb_parse_field_value(getThis(), &reader, field_number, Z_LVAL_P(field_type), &value) != 0) {
					goto fail0;
				}
			}
		} else {
			PB_COMPILE_ERROR("unexpected %s type of '%s' field type in field descriptor", zend_get_type_by_const(Z_TYPE_P(field_type)), pb_get_field_name(getThis(), field_number));
			return;
		}

		if (field_repeated) {
			if (Z_REFCOUNTED(value))
				Z_ADDREF(value);
			ARRAY_ADD_NEXT_INDEX(old_value, &value);
		} else {
			zval_ptr_dtor(old_value);
			ZVAL_COPY(old_value, &value);
		}

		zval_ptr_dtor(&value);
	}

	zval_ptr_dtor(&field_descriptors);
	RETURN_TRUE;

fail0:
	zval_ptr_dtor(&field_descriptors);
	return;
}

PHP_METHOD(ProtobufMessage, serializeToString)
{
	writer_t writer;
	char *pack;
	size_t pack_size;
	zend_ulong field_number;
	HashPosition i, j;
	zval *array, *field_descriptor, field_descriptors, *required, *type, *value, *values;

	if ((values = pb_get_values(getThis())) == NULL)
		return;

	if (pb_get_field_descriptors(getThis(), &field_descriptors))
		return;

	writer_init(&writer);

	PB_FOREACH(&i, Z_ARRVAL(field_descriptors)) {
		zend_hash_get_current_key_ex(Z_ARRVAL(field_descriptors), NULL, &field_number, &i);
		field_descriptor = zend_hash_get_current_data_ex(Z_ARRVAL(field_descriptors), &i);
		if (Z_TYPE_P(field_descriptor) != IS_ARRAY) {
			zend_throw_exception_ex(NULL, 0 TSRMLS_CC, "%s: '%s' field descriptor must be an array", ZSTR_VAL(Z_OBJCE_P(getThis())->name), pb_get_field_name(getThis(), field_number));
			goto fail;
		}

		if ((value = zend_hash_index_find(Z_ARRVAL_P(values), field_number)) == NULL) {
			PB_COMPILE_ERROR("missing '%s' field value", pb_get_field_name(getThis(), field_number));
			goto fail;
		}

		if ((type = pb_get_field_type(getThis(), field_descriptor, field_number)) == NULL)
			goto fail;

		if (Z_TYPE_P(value) == IS_NULL) {
			if ((required = zend_hash_str_find(Z_ARRVAL_P(field_descriptor), PB_FIELD_REQUIRED, sizeof(PB_FIELD_REQUIRED) - 1)) == NULL) {
				zend_throw_exception_ex(NULL, 0 TSRMLS_CC, "%s: '%s' field is required and must be set", ZSTR_VAL(Z_OBJCE_P(getThis())->name), pb_get_field_name(getThis(), field_number));
			}

			if (Z_TYPE_P(required) == IS_TRUE) {
				zend_throw_exception_ex(NULL, 0 TSRMLS_CC, "%s: '%s' field is required and must be set", ZSTR_VAL(Z_OBJCE_P(getThis())->name), pb_get_field_name(getThis(), field_number));
				goto fail;
			}

			continue;
		}

		if (Z_TYPE_P(value) == IS_ARRAY) {
			array = value;
			if (pb_is_field_packed(field_descriptor)) {
				if (pb_serialize_packed_field(getThis(), &writer, field_number, Z_LVAL_P(type), array) != 0)
					goto fail;
			} else {
				PB_FOREACH(&j, Z_ARRVAL_P(array)) {
					value = zend_hash_get_current_data_ex(Z_ARRVAL_P(array), &j);
					if (pb_serialize_field_value(getThis(), &writer, field_number, type, value) != 0)
					goto fail;
				}
			}
		} else if (pb_serialize_field_value(getThis(), &writer, field_number, type, value) != 0)
			goto fail;
	}

	pack = writer_get_pack(&writer, &pack_size);
	RETVAL_STRINGL(pack, pack_size);

	zval_ptr_dtor(&field_descriptors);
	writer_free_pack(&writer);

	return;

fail:
	zval_ptr_dtor(&field_descriptors);
	writer_free_pack(&writer);

	return;
}

PHP_METHOD(ProtobufMessage, set)
{
	zend_long field_number = -1;
	zval *old_value, *value, *values;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "lz", &field_number, &value) == FAILURE) {
		RETURN_THIS();
	}

	if ((values = pb_get_values(getThis())) == NULL)
		RETURN_THIS();

	if ((old_value = pb_get_value(getThis(), values, (zend_ulong)field_number)) == NULL)
		RETURN_THIS();

	if (Z_TYPE_P(value) == IS_NULL) {
		if (Z_TYPE_P(old_value) != IS_NULL) {
			zval_ptr_dtor(old_value);
			ZVAL_NULL(old_value);
		}
	} else {
		zval_ptr_dtor(old_value);
		pb_assign_value(getThis(), old_value, value, (zend_ulong)field_number);
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
	PHP_ABSTRACT_ME(ProtobufMessage, reset, arginfo_reset)
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

PHP_MINIT_FUNCTION(protobuf)
{
	zend_class_entry ce;

	INIT_CLASS_ENTRY(ce, "ProtobufMessage", pb_methods);
	pb_entry = zend_register_internal_class(&ce TSRMLS_CC);

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

zend_module_entry protobuf_module_entry = {
	STANDARD_MODULE_HEADER,
	PHP_PROTOBUF_EXTNAME,
	NULL,
	PHP_MINIT(protobuf),
	NULL,
	NULL,
	NULL,
	NULL,
	PHP_PROTOBUF_VERSION,
	STANDARD_MODULE_PROPERTIES
};

#ifdef COMPILE_DL_PROTOBUF
ZEND_GET_MODULE(protobuf)
#endif

static int pb_assign_value(zval *this, zval *dst, zval *src, zend_ulong field_number)
{
	zval *field_descriptor, field_descriptors, tmp, *type;
    TSRMLS_FETCH();

	if (pb_get_field_descriptors(this, &field_descriptors))
		goto fail0;

	if ((field_descriptor = pb_get_field_descriptor(this, &field_descriptors, field_number)) == NULL)
		goto fail1;

	if ((type = pb_get_field_type(this, field_descriptor, field_number)) == NULL)
		goto fail1;

	ZVAL_DUP(&tmp, src);

	if (Z_TYPE_P(type) == IS_LONG) {
		switch (Z_LVAL_P(type))
		{
			case PB_TYPE_DOUBLE:
			case PB_TYPE_FLOAT:
				if (Z_TYPE(tmp) != IS_DOUBLE)
					convert_to_explicit_type(&tmp, IS_DOUBLE);
				break;

			case PB_TYPE_FIXED32:
				if (Z_TYPE(tmp) != IS_LONG)
					convert_to_explicit_type(&tmp, IS_LONG);
				break;

			case PB_TYPE_BOOL:
				if (!IS_BOOL(tmp)) {
					convert_to_boolean(&tmp);
				}
				break;

			case PB_TYPE_INT:
			case PB_TYPE_FIXED64:
			case PB_TYPE_SIGNED_INT:
				if ((Z_TYPE(tmp) == IS_DOUBLE) && IS_32_BIT) {
					if ((double)ZEND_LONG_MAX < Z_DVAL(tmp)) {
						// store big value for 32bit systems as double
						break;
					}
				}

				convert_to_explicit_type(&tmp, IS_LONG);
				break;

			case PB_TYPE_STRING:
				if (Z_TYPE(tmp) != IS_STRING)
					convert_to_explicit_type(&tmp, IS_STRING);

				break;

			default:
				PB_COMPILE_ERROR_EX(this, "unexpected '%s' field type %d in field descriptor", pb_get_field_name(this, field_number), zend_get_type_by_const(Z_LVAL_P(type)));
				goto fail2;
		}

	} else if (Z_TYPE_P(type) != IS_STRING) {
		PB_COMPILE_ERROR_EX(this, "unexpected %s type of '%s' field type in field descriptor", zend_get_type_by_const(Z_TYPE_P(type)), pb_get_field_name(this, field_number));
		goto fail2;
	}

	*dst = tmp;

	zval_ptr_dtor(&field_descriptors);
	return 0;
fail2:
	zval_ptr_dtor(&tmp);
fail1:
	zval_ptr_dtor(&field_descriptors);
fail0:
	return -1;
}

static int pb_print_field_value(zval *value, zend_long level, zend_bool only_set)
{
	const char *string_value;
	zval tmp;
	TSRMLS_FETCH();

	if (Z_TYPE_P(value) == IS_NULL)
		string_value = "null";
	else if (Z_TYPE_P(value) == IS_TRUE)
		string_value = "true";
	else if (Z_TYPE_P(value) == IS_FALSE)
		string_value = "false";
	else {
		ZVAL_DUP(&tmp, value);
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

static int pb_print_debug_field_value(zval *value, zend_long level)
{
	zval tmp, ret, arg0, args[1];
	int dump_result;
	TSRMLS_FETCH();

	ZVAL_UNDEF(&ret);

	if (Z_TYPE_P(value) == IS_OBJECT) {
		php_printf("\n");

		ZVAL_LONG(&arg0, level);
		args[0] = arg0;

		ZVAL_STRINGL(&tmp, PB_PRINT_DEBUG_STRING_METHOD, sizeof(PB_PRINT_DEBUG_STRING_METHOD) - 1);

		dump_result = call_user_function(NULL, value, &tmp, &ret, 1, args TSRMLS_CC);
		zval_ptr_dtor(&tmp);

		if (dump_result == FAILURE)
			return -1;
		else
			return 0;

		zval_ptr_dtor(&ret);
	}

	return pb_print_field_value(value, level, 1);
}

static int pb_dump_field_value(zval *value, zend_long level, zend_bool only_set)
{
	const char *string_value;
	zval tmp, ret, arg0, arg1, args[2];
	int dump_result;
    TSRMLS_FETCH();

    ZVAL_UNDEF(&ret); // call_user_function will segfault without this init

	if (Z_TYPE_P(value) == IS_OBJECT) {
		php_printf("\n");

		ZVAL_BOOL(&arg0, only_set);
		ZVAL_LONG(&arg1, level);

		args[0] = arg0;
		args[1] = arg1;

		ZVAL_STRINGL(&tmp, PB_DUMP_METHOD, sizeof(PB_DUMP_METHOD) - 1);

		dump_result = call_user_function(NULL, value, &tmp, &ret, 2, args TSRMLS_CC);
		zval_ptr_dtor(&tmp);
		if (dump_result == FAILURE)
			return -1;
		else
			return 0;
	}

	return pb_print_field_value(value, level, only_set);
}

static zval *pb_get_field_descriptor(zval *this, zval *field_descriptors, zend_ulong field_number)
{
	zval *field_descriptor = NULL;
    TSRMLS_FETCH();

    field_descriptor = zend_hash_index_find(Z_ARRVAL_P(field_descriptors), field_number);
    if (field_descriptor == NULL)
		PB_COMPILE_ERROR_EX(this, "missing %lu field descriptor", (uint64_t)field_number);

	return field_descriptor;
}

static zval *pb_get_field_type(zval *this, zval *field_descriptor, zend_ulong field_number)
{
	zval *field_type;
    TSRMLS_FETCH();

    field_type = zend_hash_str_find(Z_ARRVAL_P(field_descriptor), PB_FIELD_TYPE, sizeof(PB_FIELD_TYPE) - 1);
    if (field_type == NULL)
		PB_COMPILE_ERROR_EX(this, "missing '%s' field type property in field descriptor", pb_get_field_name(this, field_number));

	return field_type;
}

static int pb_get_field_descriptors(zval *this, zval* return_value)
{
	zval descriptors, method;
    TSRMLS_FETCH();

	ZVAL_STRINGL(&method, PB_FIELDS_METHOD, sizeof(PB_FIELDS_METHOD) - 1);
	if (call_user_function_ex(NULL, this, &method, &descriptors, 0, NULL, 0, NULL TSRMLS_CC) == FAILURE) {
		return -1;
	}
	*return_value = descriptors;
	zval_ptr_dtor(&method);

	return 0;
}

static const char *pb_get_field_name(zval *this, zend_ulong field_number)
{
	zval *field_descriptor, field_descriptors, *field_name;
    TSRMLS_FETCH();

	if (pb_get_field_descriptors(this, &field_descriptors))
		return NULL;

	if ((field_descriptor = pb_get_field_descriptor(this, &field_descriptors, field_number)) == NULL)
		goto fail0;

	field_name = zend_hash_str_find(Z_ARRVAL_P(field_descriptor), PB_FIELD_NAME, sizeof(PB_FIELD_NAME) - 1);
	if (field_name == NULL) {
		PB_COMPILE_ERROR_EX(this, "missing %lu field name property in field descriptor", (uint64_t)field_number);
		goto fail0;
	}

	zval_ptr_dtor(&field_descriptors);
	return (const char *) Z_STRVAL_P(field_name);

fail0:
	zval_ptr_dtor(&field_descriptors);
	return NULL;
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

static zval *pb_get_value(zval *this, zval *values, zend_ulong field_number)
{
	zval *value = NULL;
    TSRMLS_FETCH();

    value = zend_hash_index_find(Z_ARRVAL_P(values), field_number);
    if (value == NULL)
		PB_COMPILE_ERROR_EX(this, "missing %lu field value", (uint64_t)field_number);

    return value;
}

static zval *pb_get_values(zval *this)
{
	zval *values = NULL;
    TSRMLS_FETCH();

	values = zend_hash_str_find(Z_OBJPROP_P(this), PB_VALUES_PROPERTY, sizeof(PB_VALUES_PROPERTY) - 1);
	return values;
}

static int pb_parse_field_value(zval *this, reader_t *reader, zend_ulong field_number, zend_long field_type, zval *value)
{
	int ret, str_size;
	char *str;
	int32_t int32_value;
	int64_t int64_value;

	switch (field_type)
	{
		case PB_TYPE_DOUBLE:
			convert_to_double(value);
			ret = reader_read_double(reader, &Z_DVAL_P(value));
			break;

		case PB_TYPE_FIXED32:
			convert_to_long(value);
			ret = reader_read_fixed32(reader, &int32_value);
			ZVAL_LONG(value, (zend_long)int32_value);
			break;

		case PB_TYPE_FIXED64:
			ret = reader_read_fixed64(reader, &int64_value);
			ZVAL_INT64(value, int64_value);
			break;

		case PB_TYPE_FLOAT:
			convert_to_double(value);
			ret = reader_read_float(reader, &Z_DVAL_P(value));
			break;

		case PB_TYPE_INT:
			ret = reader_read_int(reader, &int64_value);
			ZVAL_INT64(value, int64_value);
			break;

		case PB_TYPE_BOOL:
			ret = reader_read_int(reader, &int64_value);
			ZVAL_BOOL(value, int64_value);
			break;

		case PB_TYPE_SIGNED_INT:
			ret = reader_read_signed_int(reader, &int64_value);
			ZVAL_INT64(value, int64_value);
			break;

		case PB_TYPE_STRING:
			if ((ret = reader_read_string(reader, &str, &str_size)) == 0)
				ZVAL_STRINGL(value, str, str_size);
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

static int pb_serialize_field_value(zval *this, writer_t *writer, zend_ulong field_number, zval *type, zval *value)
{
	int r;
	zval ret, method;
	int64_t int64_value;
    TSRMLS_FETCH();

	if (Z_TYPE_P(type) == IS_STRING) {
		ZVAL_STRINGL(&method, PB_SERIALIZE_TO_STRING_METHOD, sizeof(PB_SERIALIZE_TO_STRING_METHOD) - 1);

		if (call_user_function(NULL, value, &method, &ret, 0, NULL TSRMLS_CC) == FAILURE) {
			zval_ptr_dtor(&method);
			return -1;
		}
		zval_ptr_dtor(&method);

		if (Z_TYPE(ret) != IS_STRING) {
			zval_ptr_dtor(&ret);
			return -1;
		}

		writer_write_message(writer, (uint64_t)field_number, Z_STRVAL(ret), Z_STRLEN(ret));

		zval_ptr_dtor(&ret);
	} else if (Z_TYPE_P(type) == IS_LONG) {
		switch (Z_LVAL_P(type))
		{
			case PB_TYPE_DOUBLE:
				r = writer_write_double(writer, (uint64_t)field_number, Z_DVAL_P(value));
				break;

			case PB_TYPE_FIXED32:
				r = writer_write_fixed32(writer, (uint64_t)field_number, Z_LVAL_P(value));
				break;

			case PB_TYPE_BOOL:
				if (Z_TYPE_P(value) == IS_TRUE) {
					int64_value = 1;
				} else {
					int64_value = 0;
				}
				r = writer_write_int(writer, (uint64_t)field_number, int64_value);
				break;

			case PB_TYPE_INT:
				Z_LVAL_INT64(value, &int64_value);
				r = writer_write_int(writer, (uint64_t)field_number, int64_value);
				break;

			case PB_TYPE_FIXED64:
				Z_LVAL_INT64(value, &int64_value);
				r = writer_write_fixed64(writer, (uint64_t)field_number, int64_value);
				break;

			case PB_TYPE_FLOAT:
				r = writer_write_float(writer, (uint64_t)field_number, Z_DVAL_P(value));
				break;

			case PB_TYPE_SIGNED_INT:
				Z_LVAL_INT64(value, &int64_value);
				r = writer_write_signed_int(writer, (uint64_t)field_number, int64_value);
				break;

			case PB_TYPE_STRING:
				r = writer_write_string(writer, (uint64_t)field_number, Z_STRVAL_P(value), Z_STRLEN_P(value));
				break;

			default:
				PB_COMPILE_ERROR_EX(this, "unexpected '%s' field type %d in field descriptor", pb_get_field_name(this, field_number), Z_LVAL_P(type));
				return -1;
		}

		if (r != 0) {
			return -1;
		}
	} else {
		PB_COMPILE_ERROR_EX(this, "unexpected %s type of '%s' field type in field descriptor", zend_get_type_by_const(Z_TYPE_P(type)), pb_get_field_name(this, field_number));
		return -1;
	}

	return 0;
}

static int pb_serialize_packed_field(zval *this, writer_t *writer, zend_ulong field_number, zend_long field_type, zval *values)
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
			ret = writer_write_packed_int(writer, field_number, values);
			break;

		case PB_TYPE_BOOL:
			ret = writer_write_packed_bool(writer, field_number, values);
			break;

		default:
			PB_COMPILE_ERROR_EX(this, "unexpected '%s' type %d for packed field in field descriptor", pb_get_field_name(this, field_number), field_type);
			return -1;
	}

	return ret;
}

static int pb_is_field_packed(zval *field_descriptor)
{
	zval field_name;
	zval *packed;
	ZVAL_STRINGL(&field_name, PB_FIELD_PACKED, sizeof(PB_FIELD_PACKED) - 1);

	packed = zend_hash_find(Z_ARRVAL_P(field_descriptor), Z_STR(field_name));
	zval_ptr_dtor(&field_name);
	if (packed == NULL) {
		return 0;
	}
	return 1;
}
