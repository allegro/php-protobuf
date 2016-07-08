<?php
/**
 * Auto generated from descriptor.proto at 2016-06-26 19:19:31
 */

namespace Google\Protobuf\Compiler {
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