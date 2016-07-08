#ifndef PROTOBUF_PHP_PROTOBUF_H
#define PROTOBUF_PHP_PROTOBUF_H

#include <stdint.h>

#define PB_FOREACH(iter, hash) \
	for (zend_hash_internal_pointer_reset_ex((hash), (iter)); zend_hash_has_more_elements_ex((hash), (iter)) == SUCCESS; zend_hash_move_forward_ex((hash), (iter)))

enum
{
	WIRE_TYPE_VARINT = 0,
	WIRE_TYPE_64BIT  = 1,
	WIRE_TYPE_LENGTH_DELIMITED = 2,
	WIRE_TYPE_32BIT = 5
};

typedef union
{
	float f_val;
	int32_t i_val;
	uint32_t u_val;
} fixed32_t;

typedef union
{
	double d_val;
	int64_t i_val;
	uint64_t u_val;
} fixed64_t;

#endif /* PROTOBUF_PHP_PROTOBUF_H */
