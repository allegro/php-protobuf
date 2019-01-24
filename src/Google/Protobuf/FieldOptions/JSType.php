<?php
/**
 * Generated from descriptor.proto by the protocol buffer compiler. DO NOT EDIT!
 */

namespace Google\Protobuf\FieldOptions;

/**
 * JSType enum embedded in FieldOptions message
 */
final class JSType
{
    const JS_NORMAL = 0;
    const JS_STRING = 1;
    const JS_NUMBER = 2;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'JS_NORMAL' => self::JS_NORMAL,
            'JS_STRING' => self::JS_STRING,
            'JS_NUMBER' => self::JS_NUMBER,
        );
    }
}