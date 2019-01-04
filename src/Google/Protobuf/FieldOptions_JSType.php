<?php
/**
 * Auto generated from descriptor.proto at 2019-01-07 11:34:00
 *
 * google.protobuf package
 */

namespace Google\Protobuf {
/**
 * JSType enum embedded in FieldOptions message
 */
final class FieldOptions_JSType
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
}