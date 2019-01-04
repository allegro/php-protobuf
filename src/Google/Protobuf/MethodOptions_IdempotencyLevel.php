<?php
/**
 * Auto generated from descriptor.proto at 2019-01-07 11:34:00
 *
 * google.protobuf package
 */

namespace Google\Protobuf {
/**
 * IdempotencyLevel enum embedded in MethodOptions message
 */
final class MethodOptions_IdempotencyLevel
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
}