<?php
/**
 * Generated from descriptor.proto by the protocol buffer compiler. DO NOT EDIT!
 */

namespace Google\Protobuf;

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