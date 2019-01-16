<?php
/**
 * Generated from descriptor.proto by the protocol buffer compiler. DO NOT EDIT!
 */

namespace Google\Protobuf {
/**
 * Label enum embedded in FieldDescriptorProto message
 */
final class FieldDescriptorProto_Label
{
    const LABEL_OPTIONAL = 1;
    const LABEL_REQUIRED = 2;
    const LABEL_REPEATED = 3;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'LABEL_OPTIONAL' => self::LABEL_OPTIONAL,
            'LABEL_REQUIRED' => self::LABEL_REQUIRED,
            'LABEL_REPEATED' => self::LABEL_REPEATED,
        );
    }
}
}