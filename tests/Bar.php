<?php
/**
 * Auto generated from test.proto at 2018-01-11 23:39:22
 */

namespace {
/**
 * Bar message
 */
class Bar extends \ProtobufMessage
{
    /* Field index constants */
    const DOUBLE_FIELD = 1;
    const INT_FIELD = 2;
    const LAST_FIELD = 66;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::DOUBLE_FIELD => array(
            'name' => 'double_field',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_DOUBLE,
        ),
        self::INT_FIELD => array(
            'name' => 'int_field',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LAST_FIELD => array(
            'name' => 'last_field',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * Clears message values and sets default ones
     *
     * @return null
     */
    public function reset()
    {
        $this->values[self::DOUBLE_FIELD] = null;
        $this->values[self::INT_FIELD] = null;
        $this->values[self::LAST_FIELD] = null;
    }

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
     * Sets value of 'int_field' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setIntField($value)
    {
        return $this->set(self::INT_FIELD, $value);
    }

    /**
     * Returns value of 'int_field' property
     *
     * @return integer
     */
    public function getIntField()
    {
        $value = $this->get(self::INT_FIELD);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Sets value of 'last_field' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setLastField($value)
    {
        return $this->set(self::LAST_FIELD, $value);
    }

    /**
     * Returns value of 'last_field' property
     *
     * @return string
     */
    public function getLastField()
    {
        $value = $this->get(self::LAST_FIELD);
        return $value === null ? (string)$value : $value;
    }
}
}