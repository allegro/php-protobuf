<?php
/**
 * Generated from test.proto by the protocol buffer compiler. DO NOT EDIT!
 */

namespace {
/**
 * Bar message
 */
class Bar extends \ProtobufMessage
{
    /* Field index constants */
    const DOUBLE_FIELD = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::DOUBLE_FIELD => array(
            'name' => 'double_field',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_DOUBLE,
        ),
    );

    /**
     * Returns field descriptors
     *
     * @return array
     */
    public function fields()
    {
        return self::$fields;
    }

    /**
     * Sets value of 'double_field' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setDoubleField($value)
    {
        return $this->set(self::DOUBLE_FIELD, $value);
    }

    /**
     * Returns value of 'double_field' property
     *
     * @return double
     */
    public function getDoubleField()
    {
        $value = $this->get(self::DOUBLE_FIELD);
        return $value === null ? (double)$value : $value;
    }

    /**
     * Returns true if 'double_field' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasDoubleField()
    {
        return $this->get(self::DOUBLE_FIELD) !== null;
    }
}
}