#include <string.h>

#include <php.h>

#include "protobuf.h"
#include "writer.h"

#define WRITER_DATA_SIZE_INCREMENT 1024
#define WRITER_VARINT_SPACE 10
#define WRITER_32BIT_SPACE 4
#define WRITER_64BIT_SPACE 8

static inline int writer_ensure_space(writer_t *writer, size_t len);
static inline void writer_write_varint(writer_t *writer, int64_t value);
static inline void write_fixed32(writer_t *writer, fixed32_t value);
static inline void write_fixed64(writer_t *writer, fixed64_t value);
static inline void zigzag_encode(int64_t *value);

void writer_free_pack(writer_t *writer)
{
	if (writer->data != NULL) {
		efree(writer->data);
		writer->data = NULL;

		writer->size = 0;
		writer->pos = 0;
	}
}

void writer_init(writer_t *writer)
{
	writer_init_ex(writer, WRITER_DATA_SIZE_INCREMENT);
}

void writer_init_ex(writer_t *writer, size_t size)
{
	if ((writer->data = (uint8_t *) emalloc(size)) != NULL)
		writer->size = size;
	else
		writer->size = 0;

	writer->pos = 0;
}

char *writer_get_pack(writer_t *writer, size_t *size)
{
	*size = writer->pos;
	return (char *) writer->data;
}

int writer_write_double(writer_t *writer, uint64_t field_number, double value)
{
	int64_t key;
	fixed64_t val;

	if (writer_ensure_space(writer, WRITER_VARINT_SPACE + WRITER_64BIT_SPACE) != 0)
		return -1;

	key = (field_number << 3 | WIRE_TYPE_64BIT);

	writer_write_varint(writer, key);

	val.d_val = value;
	write_fixed64(writer, val);

	return 0;
}

int writer_write_fixed32(writer_t *writer, uint64_t field_number, int32_t value)
{
	int64_t key;
	fixed32_t val;

	if (writer_ensure_space(writer, WRITER_VARINT_SPACE + WRITER_32BIT_SPACE) != 0)
		return -1;

	key = (field_number << 3 | WIRE_TYPE_32BIT);

	writer_write_varint(writer, key);

	val.i_val = value;
	write_fixed32(writer, val);

	return 0;
}

int writer_write_fixed64(writer_t *writer, uint64_t field_number, int64_t value)
{
	int64_t key;
	fixed64_t val;

	if (writer_ensure_space(writer, WRITER_VARINT_SPACE + WRITER_64BIT_SPACE) != 0)
		return -1;

	key = (field_number << 3 | WIRE_TYPE_64BIT);

	writer_write_varint(writer, key);

	val.i_val = value;
	write_fixed64(writer, val);

	return 0;
}

int writer_write_float(writer_t *writer, uint64_t field_number, double value)
{
	int64_t key;
	fixed32_t val;

	if (writer_ensure_space(writer, WRITER_VARINT_SPACE + WRITER_32BIT_SPACE) != 0)
		return -1;

	key = (field_number << 3 | WIRE_TYPE_32BIT);

	writer_write_varint(writer, key);

	val.f_val = value;
	write_fixed32(writer, val);

	return 0;
}

int writer_write_int(writer_t *writer, uint64_t field_number, int64_t value)
{
	int64_t key;

	if (writer_ensure_space(writer, 2 * WRITER_VARINT_SPACE) != 0)
		return -1;

	key = (field_number << 3 | WIRE_TYPE_VARINT);

	writer_write_varint(writer, key);
	writer_write_varint(writer, value);

	return 0;
}

int writer_write_signed_int(writer_t *writer, uint64_t field_number, int64_t value)
{
	int64_t key;

	if (writer_ensure_space(writer, 2 * WRITER_VARINT_SPACE) != 0)
		return -1;

	key = (field_number << 3 | WIRE_TYPE_VARINT);

	writer_write_varint(writer, key);

	zigzag_encode(&value);

	writer_write_varint(writer, value);

	return 0;
}

int writer_write_string(writer_t *writer, uint64_t field_number, const char *str, size_t len)
{
	int64_t key;

	if (writer_ensure_space(writer, 2 * WRITER_VARINT_SPACE + len) != 0)
		return -1;

	key = (field_number << 3 | WIRE_TYPE_LENGTH_DELIMITED);

	writer_write_varint(writer, key);
	writer_write_varint(writer, len);

	if (len > 0) {
		memcpy(writer->data + writer->pos, str, len);
		writer->pos += len;
	}

	return 0;
}

int writer_write_packed_double(writer_t *writer, uint64_t field_number, zval *values)
{
	fixed64_t val;
	HashPosition i;
	zval *value;
	writer_t packed_writer;
	int ret, num;
	size_t pack_size;
	char *pack;

	num = zend_hash_num_elements(Z_ARRVAL_P(values));
	if (num == 0) {
		return 0;
	}

	writer_init_ex(&packed_writer, WRITER_64BIT_SPACE * num);

	PB_FOREACH(&i, Z_ARRVAL_P(values)) {
		value = zend_hash_get_current_data_ex(Z_ARRVAL_P(values), &i);
		val.d_val = Z_DVAL_P(value);
		write_fixed64(&packed_writer, val);
	}

	pack = writer_get_pack(&packed_writer, &pack_size);
	ret = writer_write_string(writer, field_number, pack, pack_size);
	writer_free_pack(&packed_writer);

	return ret;
}

int writer_write_packed_fixed32(writer_t *writer, uint64_t field_number, zval *values)
{
	fixed32_t val;
	HashPosition i;
	zval *value;
	writer_t packed_writer;
	int ret, num;
	size_t pack_size;
	char *pack;

	num = zend_hash_num_elements(Z_ARRVAL_P(values));
	if (num == 0) {
		return 0;
	}

	writer_init_ex(&packed_writer, WRITER_32BIT_SPACE * num);

	PB_FOREACH(&i, Z_ARRVAL_P(values)) {
		value = zend_hash_get_current_data_ex(Z_ARRVAL_P(values), &i);
		val.i_val = (int32_t)Z_LVAL_P(value);
		write_fixed32(&packed_writer, val);
	}

	pack = writer_get_pack(&packed_writer, &pack_size);
	ret = writer_write_string(writer, field_number, pack, pack_size);
	writer_free_pack(&packed_writer);

	return ret;
}

int writer_write_packed_fixed64(writer_t *writer, uint64_t field_number, zval *values)
{
	fixed64_t val;
	HashPosition i;
	zval *value;
	writer_t packed_writer;
	int ret, num;
	size_t pack_size;
	char *pack;

	num = zend_hash_num_elements(Z_ARRVAL_P(values));
	if (num == 0) {
		return 0;
	}

	writer_init_ex(&packed_writer, WRITER_64BIT_SPACE * num);

	PB_FOREACH(&i, Z_ARRVAL_P(values)) {
		value = zend_hash_get_current_data_ex(Z_ARRVAL_P(values), &i);
		val.i_val = Z_LVAL_P(value);
		write_fixed64(&packed_writer, val);
	}

	pack = writer_get_pack(&packed_writer, &pack_size);
	ret = writer_write_string(writer, field_number, pack, pack_size);
	writer_free_pack(&packed_writer);

	return ret;
}

int writer_write_packed_float(writer_t *writer, uint64_t field_number, zval *values)
{
	fixed32_t val;
	HashPosition i;
	zval *value;
	writer_t packed_writer;
	int ret, num;
	size_t pack_size;
	char *pack;

	num = zend_hash_num_elements(Z_ARRVAL_P(values));
	if (num == 0) {
		return 0;
	}

	writer_init_ex(&packed_writer, WRITER_32BIT_SPACE * num);

	PB_FOREACH(&i, Z_ARRVAL_P(values)) {
		value = zend_hash_get_current_data_ex(Z_ARRVAL_P(values), &i);
		val.f_val = Z_DVAL_P(value);
		write_fixed32(&packed_writer, val);
	}

	pack = writer_get_pack(&packed_writer, &pack_size);
	ret = writer_write_string(writer, field_number, pack, pack_size);
	writer_free_pack(&packed_writer);

	return ret;
}

int writer_write_packed_int(writer_t *writer, uint64_t field_number, zval *values)
{
	int64_t val;
	HashPosition i;
	zval *value;
	writer_t packed_writer;
	int ret, num;
	size_t pack_size;
	char *pack;

	num = zend_hash_num_elements(Z_ARRVAL_P(values));
	if (num == 0) {
		return 0;
	}

	writer_init_ex(&packed_writer, WRITER_VARINT_SPACE * num);

	PB_FOREACH(&i, Z_ARRVAL_P(values)) {
		value = zend_hash_get_current_data_ex(Z_ARRVAL_P(values), &i);
		val = Z_LVAL_P(value);
		writer_write_varint(&packed_writer, val);
	}

	pack = writer_get_pack(&packed_writer, &pack_size);
	ret = writer_write_string(writer, field_number, pack, pack_size);
	writer_free_pack(&packed_writer);

	return ret;
}

int writer_write_packed_bool(writer_t *writer, uint64_t field_number, zval *values)
{
	int64_t val;
	HashPosition i;
	zval *value;
	writer_t packed_writer;
	int ret, num;
	size_t pack_size;
	char *pack;

	num = zend_hash_num_elements(Z_ARRVAL_P(values));
	if (num == 0) {
		return 0;
	}

	writer_init_ex(&packed_writer, WRITER_VARINT_SPACE * num);

	PB_FOREACH(&i, Z_ARRVAL_P(values)) {
		value = zend_hash_get_current_data_ex(Z_ARRVAL_P(values), &i);
		if (Z_TYPE_P(value) == IS_TRUE) {
			val = 1;
		} else {
			val = 0;
		}
		writer_write_varint(&packed_writer, val);
	}

	pack = writer_get_pack(&packed_writer, &pack_size);
	ret = writer_write_string(writer, field_number, pack, pack_size);
	writer_free_pack(&packed_writer);

	return ret;
}

int writer_write_packed_signed_int(writer_t *writer, uint64_t field_number, zval *values)
{
	int64_t val;
	HashPosition i;
	zval *value;
	writer_t packed_writer;
	int ret, num;
	size_t pack_size;
	char *pack;

	num = zend_hash_num_elements(Z_ARRVAL_P(values));
	if (num == 0) {
		return 0;
	}

	writer_init_ex(&packed_writer, WRITER_VARINT_SPACE * num);

	PB_FOREACH(&i, Z_ARRVAL_P(values)) {
		value = zend_hash_get_current_data_ex(Z_ARRVAL_P(values), &i);
		val = Z_LVAL_P(value);
		zigzag_encode(&val);
		writer_write_varint(&packed_writer, val);
	}

	pack = writer_get_pack(&packed_writer, &pack_size);
	ret = writer_write_string(writer, field_number, pack, pack_size);
	writer_free_pack(&packed_writer);

	return ret;
}

static inline int writer_ensure_space(writer_t *writer, size_t space)
{
	uint8_t *data;
	size_t left_space;

	left_space = writer->size - writer->pos;

	if (left_space < space) {
		writer->size += (space - left_space);
		data = (uint8_t *) erealloc(writer->data, writer->size);

		if (data == NULL)
			return -1;

		writer->data = data;
	}

	return 0;
}

static inline void writer_write_varint(writer_t *writer, int64_t value)
{
	int i;
	uint8_t byte;

	if (value == 0) {
		writer->data[writer->pos++] = 0;
	} else if (value < 0) {
		for (i = 0; i < WRITER_VARINT_SPACE - 1; i++) {
			writer->data[writer->pos++] = value | 0x80;
			*(uint64_t *) &value >>= 7;
		}

		writer->data[writer->pos++] = value;
	} else {
		do {
			byte = value;
			value >>= 7;

			if (value != 0)
				byte |= 0x80;
			else
				byte &= 0x7F;

			writer->data[writer->pos++] = byte;
		} while (value != 0);
	}
}

static inline void write_fixed32(writer_t *writer, fixed32_t value)
{
	uint8_t *out;
	out = writer->data + writer->pos;
#ifndef WORDS_BIGENDIAN
	memcpy(out, &value.u_val, 4);
#else
	out[0] = value.u_val;
	out[1] = value.u_val >> 8;
	out[2] = value.u_val >> 16;
	out[3] = value.u_val >> 24;
#endif

	writer->pos += WRITER_32BIT_SPACE;
}

static inline void write_fixed64(writer_t *writer, fixed64_t value)
{
#ifndef WORDS_BIGENDIAN
	uint8_t *out;
	out = writer->data + writer->pos;
	memcpy(out, &value.u_val, 8);
	writer->pos += WRITER_64BIT_SPACE;
#else
	fixed32_t lo;
	lo.u_val = value.u_val;

	fixed32_t hi;
	hi.u_val = value.u_val >> 32;

	write_fixed32(writer, lo);
	write_fixed32(writer, hi);
#endif
}

static inline void zigzag_encode(int64_t *value)
{
	if (*value < 0)
		*(uint64_t *) value = ((uint64_t) (-(*value)) * 2) - 1;
	else
		*(uint64_t *) value = 2 * (*value);
}
