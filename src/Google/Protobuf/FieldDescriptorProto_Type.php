<?php
/**
 * Auto generated from descriptor.proto at 2016-07-08 14:22:37
 *
 * google.protobuf package
 */

namespace Google\Protobuf {
/**
 * Type enum embedded in FieldDescriptorProto message
 */
final class FieldDescriptorProto_Type
{
    const TYPE_DOUBLE = 1;
    const TYPE_FLOAT = 2;
    const TYPE_INT64 = 3;
    const TYPE_UINT64 = 4;
    const TYPE_INT32 = 5;
    const TYPE_FIXED64 = 6;
    const TYPE_FIXED32 = 7;
    const TYPE_BOOL = 8;
    const TYPE_STRING = 9;
    const TYPE_GROUP = 10;
    const TYPE_MESSAGE = 11;
    const TYPE_BYTES = 12;
    const TYPE_UINT32 = 13;
    const TYPE_ENUM = 14;
    const TYPE_SFIXED32 = 15;
    const TYPE_SFIXED64 = 16;
    const TYPE_SINT32 = 17;
    const TYPE_SINT64 = 18;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'TYPE_DOUBLE' => self::TYPE_DOUBLE,
            'TYPE_FLOAT' => self::TYPE_FLOAT,
            'TYPE_INT64' => self::TYPE_INT64,
            'TYPE_UINT64' => self::TYPE_UINT64,
            'TYPE_INT32' => self::TYPE_INT32,
            'TYPE_FIXED64' => self::TYPE_FIXED64,
            'TYPE_FIXED32' => self::TYPE_FIXED32,
            'TYPE_BOOL' => self::TYPE_BOOL,
            'TYPE_STRING' => self::TYPE_STRING,
            'TYPE_GROUP' => self::TYPE_GROUP,
            'TYPE_MESSAGE' => self::TYPE_MESSAGE,
            'TYPE_BYTES' => self::TYPE_BYTES,
            'TYPE_UINT32' => self::TYPE_UINT32,
            'TYPE_ENUM' => self::TYPE_ENUM,
            'TYPE_SFIXED32' => self::TYPE_SFIXED32,
            'TYPE_SFIXED64' => self::TYPE_SFIXED64,
            'TYPE_SINT32' => self::TYPE_SINT32,
            'TYPE_SINT64' => self::TYPE_SINT64,
        );
    }
}
}