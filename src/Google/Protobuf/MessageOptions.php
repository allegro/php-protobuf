<?php
/**
 * Auto generated from descriptor.proto at 2016-07-08 14:22:37
 *
 * google.protobuf package
 */

namespace Google\Protobuf {
/**
 * MessageOptions message
 */
class MessageOptions extends \ProtobufMessage
{
    /* Field index constants */
    const MESSAGE_SET_WIRE_FORMAT = 1;
    const NO_STANDARD_DESCRIPTOR_ACCESSOR = 2;
    const DEPRECATED = 3;
    const MAP_ENTRY = 7;
    const UNINTERPRETED_OPTION = 999;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::MESSAGE_SET_WIRE_FORMAT => array(
            'default' => false,
            'name' => 'message_set_wire_format',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::NO_STANDARD_DESCRIPTOR_ACCESSOR => array(
            'default' => false,
            'name' => 'no_standard_descriptor_accessor',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::DEPRECATED => array(
            'default' => false,
            'name' => 'deprecated',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::MAP_ENTRY => array(
            'name' => 'map_entry',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::UNINTERPRETED_OPTION => array(
            'name' => 'uninterpreted_option',
            'repeated' => true,
            'type' => '\Google\Protobuf\UninterpretedOption'
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
        $this->values[self::MESSAGE_SET_WIRE_FORMAT] = self::$fields[self::MESSAGE_SET_WIRE_FORMAT]['default'];
        $this->values[self::NO_STANDARD_DESCRIPTOR_ACCESSOR] = self::$fields[self::NO_STANDARD_DESCRIPTOR_ACCESSOR]['default'];
        $this->values[self::DEPRECATED] = self::$fields[self::DEPRECATED]['default'];
        $this->values[self::MAP_ENTRY] = null;
        $this->values[self::UNINTERPRETED_OPTION] = array();
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
     * Sets value of 'message_set_wire_format' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setMessageSetWireFormat($value)
    {
        return $this->set(self::MESSAGE_SET_WIRE_FORMAT, $value);
    }

    /**
     * Returns value of 'message_set_wire_format' property
     *
     * @return boolean
     */
    public function getMessageSetWireFormat()
    {
        return $this->get(self::MESSAGE_SET_WIRE_FORMAT);
    }

    /**
     * Sets value of 'no_standard_descriptor_accessor' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setNoStandardDescriptorAccessor($value)
    {
        return $this->set(self::NO_STANDARD_DESCRIPTOR_ACCESSOR, $value);
    }

    /**
     * Returns value of 'no_standard_descriptor_accessor' property
     *
     * @return boolean
     */
    public function getNoStandardDescriptorAccessor()
    {
        return $this->get(self::NO_STANDARD_DESCRIPTOR_ACCESSOR);
    }

    /**
     * Sets value of 'deprecated' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setDeprecated($value)
    {
        return $this->set(self::DEPRECATED, $value);
    }

    /**
     * Returns value of 'deprecated' property
     *
     * @return boolean
     */
    public function getDeprecated()
    {
        return $this->get(self::DEPRECATED);
    }

    /**
     * Sets value of 'map_entry' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setMapEntry($value)
    {
        return $this->set(self::MAP_ENTRY, $value);
    }

    /**
     * Returns value of 'map_entry' property
     *
     * @return boolean
     */
    public function getMapEntry()
    {
        return $this->get(self::MAP_ENTRY);
    }

    /**
     * Appends value to 'uninterpreted_option' list
     *
     * @param \Google\Protobuf\UninterpretedOption $value Value to append
     *
     * @return null
     */
    public function appendUninterpretedOption(\Google\Protobuf\UninterpretedOption $value)
    {
        return $this->append(self::UNINTERPRETED_OPTION, $value);
    }

    /**
     * Clears 'uninterpreted_option' list
     *
     * @return null
     */
    public function clearUninterpretedOption()
    {
        return $this->clear(self::UNINTERPRETED_OPTION);
    }

    /**
     * Returns 'uninterpreted_option' list
     *
     * @return \Google\Protobuf\UninterpretedOption[]
     */
    public function getUninterpretedOption()
    {
        return $this->get(self::UNINTERPRETED_OPTION);
    }

    /**
     * Returns 'uninterpreted_option' iterator
     *
     * @return \ArrayIterator
     */
    public function getUninterpretedOptionIterator()
    {
        return new \ArrayIterator($this->get(self::UNINTERPRETED_OPTION));
    }

    /**
     * Returns element from 'uninterpreted_option' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Google\Protobuf\UninterpretedOption
     */
    public function getUninterpretedOptionAt($offset)
    {
        return $this->get(self::UNINTERPRETED_OPTION, $offset);
    }

    /**
     * Returns count of 'uninterpreted_option' list
     *
     * @return int
     */
    public function getUninterpretedOptionCount()
    {
        return $this->count(self::UNINTERPRETED_OPTION);
    }
}
}