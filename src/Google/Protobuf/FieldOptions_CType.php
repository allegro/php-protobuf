<?php
/**
 * Auto generated from descriptor.proto at 2019-01-07 11:34:00
 *
 * google.protobuf package
 */

namespace Google\Protobuf {
/**
 * CType enum embedded in FieldOptions message
 */
final class FieldOptions_CType
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
}