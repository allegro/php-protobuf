<?php
/**
 * Auto generated from descriptor.proto at 2016-06-26 19:19:31
 */

namespace Google\Protobuf\Compiler {
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