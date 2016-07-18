<?php
/**
 * Auto generated from descriptor.proto at 2016-07-08 14:22:37
 *
 * google.protobuf package
 */

namespace Google\Protobuf {
/**
 * OptimizeMode enum embedded in FileOptions message
 */
final class FileOptions_OptimizeMode
{
    const SPEED = 1;
    const CODE_SIZE = 2;
    const LITE_RUNTIME = 3;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'SPEED' => self::SPEED,
            'CODE_SIZE' => self::CODE_SIZE,
            'LITE_RUNTIME' => self::LITE_RUNTIME,
        );
    }
}
}