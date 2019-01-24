<?php
/**
 * Generated from descriptor.proto by the protocol buffer compiler. DO NOT EDIT!
 */

namespace Google\Protobuf\FieldOptions;

/**
 * CType enum embedded in FieldOptions message
 */
final class CType
{
    const STRING = 0;
    const CORD = 1;
    const STRING_PIECE = 2;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'STRING' => self::STRING,
            'CORD' => self::CORD,
            'STRING_PIECE' => self::STRING_PIECE,
        );
    }
}