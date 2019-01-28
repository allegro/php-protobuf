<?php
/**
 * Generated from descriptor.proto by the protocol buffer compiler. DO NOT EDIT!
 */

namespace Google\Protobuf\DescriptorProto;

/**
 * ExtensionRange message embedded in DescriptorProto message
 */
class ExtensionRange extends \Allegro\Protobuf\Internal\Message
{
    /* Field index constants */
    const START = 1;
    const END = 2;
    const OPTIONS = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::START => array(
            'name' => 'start',
            'required' => false,
            'type' => \Allegro\Protobuf\Internal\Message::PB_TYPE_INT,
        ),
        self::END => array(
            'name' => 'end',
            'required' => false,
            'type' => \Allegro\Protobuf\Internal\Message::PB_TYPE_INT,
        ),
        self::OPTIONS => array(
            'name' => 'options',
            'required' => false,
            'type' => '\Google\Protobuf\ExtensionRangeOptions'
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
     * Sets value of 'start' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setStart($value)
    {
        return $this->set(self::START, $value);
    }

    /**
     * Returns value of 'start' property
     *
     * @return integer
     */
    public function getStart()
    {
        $value = $this->get(self::START);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'start' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasStart()
    {
        return $this->get(self::START) !== null;
    }

    /**
     * Sets value of 'end' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setEnd($value)
    {
        return $this->set(self::END, $value);
    }

    /**
     * Returns value of 'end' property
     *
     * @return integer
     */
    public function getEnd()
    {
        $value = $this->get(self::END);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'end' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasEnd()
    {
        return $this->get(self::END) !== null;
    }

    /**
     * Sets value of 'options' property
     *
     * @param \Google\Protobuf\ExtensionRangeOptions $value Property value
     *
     * @return null
     */
    public function setOptions(\Google\Protobuf\ExtensionRangeOptions $value=null)
    {
        return $this->set(self::OPTIONS, $value);
    }

    /**
     * Returns value of 'options' property
     *
     * @return \Google\Protobuf\ExtensionRangeOptions
     */
    public function getOptions()
    {
        return $this->get(self::OPTIONS);
    }

    /**
     * Returns true if 'options' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasOptions()
    {
        return $this->get(self::OPTIONS) !== null;
    }
}