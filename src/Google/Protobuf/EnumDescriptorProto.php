<?php
/**
 * Auto generated from descriptor.proto at 2019-01-07 11:34:00
 *
 * google.protobuf package
 */

namespace Google\Protobuf {
/**
 * EnumDescriptorProto message
 */
class EnumDescriptorProto extends \ProtobufMessage
{
    /* Field index constants */
    const NAME = 1;
    const VALUE = 2;
    const OPTIONS = 3;
    const RESERVED_RANGE = 4;
    const RESERVED_NAME = 5;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::VALUE => array(
            'name' => 'value',
            'repeated' => true,
            'type' => '\Google\Protobuf\EnumValueDescriptorProto'
        ),
        self::OPTIONS => array(
            'name' => 'options',
            'required' => false,
            'type' => '\Google\Protobuf\EnumOptions'
        ),
        self::RESERVED_RANGE => array(
            'name' => 'reserved_range',
            'repeated' => true,
            'type' => '\Google\Protobuf\EnumDescriptorProto_EnumReservedRange'
        ),
        self::RESERVED_NAME => array(
            'name' => 'reserved_name',
            'repeated' => true,
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
        $this->values[self::NAME] = null;
        $this->values[self::VALUE] = array();
        $this->values[self::OPTIONS] = null;
        $this->values[self::RESERVED_RANGE] = array();
        $this->values[self::RESERVED_NAME] = array();
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
     * Sets value of 'name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setName($value)
    {
        return $this->set(self::NAME, $value);
    }

    /**
     * Returns value of 'name' property
     *
     * @return string
     */
    public function getName()
    {
        $value = $this->get(self::NAME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'name' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasName()
    {
        return $this->get(self::NAME) !== null;
    }

    /**
     * Appends value to 'value' list
     *
     * @param \Google\Protobuf\EnumValueDescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendValue(\Google\Protobuf\EnumValueDescriptorProto $value)
    {
        return $this->append(self::VALUE, $value);
    }

    /**
     * Clears 'value' list
     *
     * @return null
     */
    public function clearValue()
    {
        return $this->clear(self::VALUE);
    }

    /**
     * Returns 'value' list
     *
     * @return \Google\Protobuf\EnumValueDescriptorProto[]
     */
    public function getValue()
    {
        return $this->get(self::VALUE);
    }

    /**
     * Returns true if 'value' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasValue()
    {
        return count($this->get(self::VALUE)) !== 0;
    }

    /**
     * Returns 'value' iterator
     *
     * @return \ArrayIterator
     */
    public function getValueIterator()
    {
        return new \ArrayIterator($this->get(self::VALUE));
    }

    /**
     * Returns element from 'value' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Google\Protobuf\EnumValueDescriptorProto
     */
    public function getValueAt($offset)
    {
        return $this->get(self::VALUE, $offset);
    }

    /**
     * Returns count of 'value' list
     *
     * @return int
     */
    public function getValueCount()
    {
        return $this->count(self::VALUE);
    }

    /**
     * Sets value of 'options' property
     *
     * @param \Google\Protobuf\EnumOptions $value Property value
     *
     * @return null
     */
    public function setOptions(\Google\Protobuf\EnumOptions $value=null)
    {
        return $this->set(self::OPTIONS, $value);
    }

    /**
     * Returns value of 'options' property
     *
     * @return \Google\Protobuf\EnumOptions
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

    /**
     * Appends value to 'reserved_range' list
     *
     * @param \Google\Protobuf\EnumDescriptorProto_EnumReservedRange $value Value to append
     *
     * @return null
     */
    public function appendReservedRange(\Google\Protobuf\EnumDescriptorProto_EnumReservedRange $value)
    {
        return $this->append(self::RESERVED_RANGE, $value);
    }

    /**
     * Clears 'reserved_range' list
     *
     * @return null
     */
    public function clearReservedRange()
    {
        return $this->clear(self::RESERVED_RANGE);
    }

    /**
     * Returns 'reserved_range' list
     *
     * @return \Google\Protobuf\EnumDescriptorProto_EnumReservedRange[]
     */
    public function getReservedRange()
    {
        return $this->get(self::RESERVED_RANGE);
    }

    /**
     * Returns true if 'reserved_range' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasReservedRange()
    {
        return count($this->get(self::RESERVED_RANGE)) !== 0;
    }

    /**
     * Returns 'reserved_range' iterator
     *
     * @return \ArrayIterator
     */
    public function getReservedRangeIterator()
    {
        return new \ArrayIterator($this->get(self::RESERVED_RANGE));
    }

    /**
     * Returns element from 'reserved_range' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Google\Protobuf\EnumDescriptorProto_EnumReservedRange
     */
    public function getReservedRangeAt($offset)
    {
        return $this->get(self::RESERVED_RANGE, $offset);
    }

    /**
     * Returns count of 'reserved_range' list
     *
     * @return int
     */
    public function getReservedRangeCount()
    {
        return $this->count(self::RESERVED_RANGE);
    }

    /**
     * Appends value to 'reserved_name' list
     *
     * @param string $value Value to append
     *
     * @return null
     */
    public function appendReservedName($value)
    {
        return $this->append(self::RESERVED_NAME, $value);
    }

    /**
     * Clears 'reserved_name' list
     *
     * @return null
     */
    public function clearReservedName()
    {
        return $this->clear(self::RESERVED_NAME);
    }

    /**
     * Returns 'reserved_name' list
     *
     * @return string[]
     */
    public function getReservedName()
    {
        return $this->get(self::RESERVED_NAME);
    }

    /**
     * Returns true if 'reserved_name' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasReservedName()
    {
        return count($this->get(self::RESERVED_NAME)) !== 0;
    }

    /**
     * Returns 'reserved_name' iterator
     *
     * @return \ArrayIterator
     */
    public function getReservedNameIterator()
    {
        return new \ArrayIterator($this->get(self::RESERVED_NAME));
    }

    /**
     * Returns element from 'reserved_name' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return string
     */
    public function getReservedNameAt($offset)
    {
        return $this->get(self::RESERVED_NAME, $offset);
    }

    /**
     * Returns count of 'reserved_name' list
     *
     * @return int
     */
    public function getReservedNameCount()
    {
        return $this->count(self::RESERVED_NAME);
    }
}
}