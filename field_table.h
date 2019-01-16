#ifndef PROTOBUF_PHP_FIELD_TABLE_H
#define PROTOBUF_PHP_FIELD_TABLE_H

#include <stdint.h>
#include <sys/types.h>


typedef struct {
    uint32_t number;
    zval *value;
} field_t;

typedef struct {
    field_t *fields;
    size_t count;
    size_t next;
} field_table_t;

typedef struct {
    uint32_t index;
    field_table_t *table;
} field_table_iter_t;

field_t *field_table_append(field_table_t *table, uint32_t field_number);
void field_table_destroy(field_table_t *table);
field_t *field_table_get(field_table_t *table, uint32_t field_number);
void field_table_init(field_table_t *table, size_t count);

void field_table_iter_init(field_table_iter_t *iter, field_table_t *table);
field_t *field_table_iter_next(field_table_iter_t *iter, uint32_t *field_number);

#endif /* PROTOBUF_PHP_FIELD_TABLE_H */