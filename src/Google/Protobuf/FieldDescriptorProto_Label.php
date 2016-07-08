<?php
/**
 * Auto generated from descriptor.proto at 2016-07-08 14:22:37
 *
 * google.protobuf package
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