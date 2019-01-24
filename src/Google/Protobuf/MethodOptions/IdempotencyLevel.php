<?php
/**
 * Generated from descriptor.proto by the protocol buffer compiler. DO NOT EDIT!
 */

namespace Google\Protobuf\MethodOptions;

/**
 * IdempotencyLevel enum embedded in MethodOptions message
 */
final class IdempotencyLevel
{
    const IDEMPOTENCY_UNKNOWN = 0;
    const NO_SIDE_EFFECTS = 1;
    const IDEMPOTENT = 2;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'IDEMPOTENCY_UNKNOWN' => self::IDEMPOTENCY_UNKNOWN,
            'NO_SIDE_EFFECTS' => self::NO_SIDE_EFFECTS,
            'IDEMPOTENT' => self::IDEMPOTENT,
        );
    }
}