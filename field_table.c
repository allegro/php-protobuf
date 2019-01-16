#include <php.h>

#include "field_table.h"

static int field_table_comparator(const void *key, const void *item);

field_t *field_table_append(field_table_t *table, uint32_t field_number)
{
    assert(table->next < table->count);
    assert(table->index == 0 || table->fields[table->index - 1].number < field_number);

    field_t *field = &table->fields[table->next++];
    field->number = field_number;
    return field;
}

void field_table_destroy(field_table_t *table)
{
    for (int i = 0; i < table->count; ++i) {
        zval_ptr_dtor(&table->fields[i].value);
    }
    efree(table->fields);
}

field_t *field_table_get(field_table_t *table, uint32_t field_number)
{
    return bsearch(&field_number, table->fields, table->count, sizeof(field_t), field_table_comparator);
}

void field_table_init(field_table_t *table, size_t count)
{
    table->fields = ecalloc(sizeof(field_t), count);
    table->count = count;
    table->next = 0;
}

void field_table_iter_init(field_table_iter_t *iter, field_table_t *table)
{
    iter->index = 0;
    iter->table = table;
}

field_t *field_table_iter_next(field_table_iter_t *iter, uint32_t *field_number)
{
    if (iter->index < iter->table->count) {
        field_t *field = &iter->table->fields[iter->index++];
        if (field_number != NULL) {
            *field_number = field->number;
        }
        return field;
    }

    return NULL;
}

static int field_table_comparator(const void *key, const void *item)
{
    const uint32_t *field_number = key;
    const field_t *field = item;

    if (*field_number < field->number) {
        return -1;
    } else if (*field_number > field->number) {
        return 1;
    }

    return 0;
}