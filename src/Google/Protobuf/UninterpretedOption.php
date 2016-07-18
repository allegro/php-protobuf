<?php
/**
 * Auto generated from descriptor.proto at 2016-07-08 14:22:37
 *
 * google.protobuf package
 */

namespace Google\Protobuf {
/**
 * UninterpretedOption message
 */
class UninterpretedOption extends \ProtobufMessage
{
    /* Field index constants */
    const NAME = 2;
    const IDENTIFIER_VALUE = 3;
    const POSITIVE_INT_VALUE = 4;
    const NEGATIVE_INT_VALUE = 5;
    const DOUBLE_VALUE = 6;
    const STRING_VALUE = 7;
    const AGGREGATE_VALUE = 8;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NAME => array(
            'name' => 'name',
            'repeated' => true,
            'type' => '\Google\Protobuf\UninterpretedOption_NamePart'
        ),
        self::IDENTIFIER_VALUE => array(
            'name' => 'identifier_value',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::POSITIVE_INT_VALUE => array(
            'name' => 'positive_int_value',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::NEGATIVE_INT_VALUE => array(
            'name' => 'negative_int_value',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::DOUBLE_VALUE => array(
            'name' => 'double_value',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_DOUBLE,
        ),
        self::STRING_VALUE => array(
            'name' => 'string_value',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::AGGREGATE_VALUE => array(
            'name' => 'aggregate_value',
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
        $this->values[self::NAME] = array();
        $this->values[self::IDENTIFIER_VALUE] = null;
        $this->values[self::POSITIVE_INT_VALUE] = null;
        $this->values[self::NEGATIVE_INT_VALUE] = null;
        $this->values[self::DOUBLE_VALUE] = null;
        $this->values[self::STRING_VALUE] = null;
        $this->values[self::AGGREGATE_VALUE] = null;
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
     * Appends value to 'name' list
     *
     * @param \Google\Protobuf\UninterpretedOption_NamePart $value Value to append
     *
     * @return null
     */
    public function appendName(\Google\Protobuf\UninterpretedOption_NamePart $value)
    {
        return $this->append(self::NAME, $value);
    }

    /**
     * Clears 'name' list
     *
     * @return null
     */
    public function clearName()
    {
        return $this->clear(self::NAME);
    }

    /**
     * Returns 'name' list
     *
     * @return \Google\Protobuf\UninterpretedOption_NamePart[]
     */
    public function getName()
    {
        return $this->get(self::NAME);
    }

    /**
     * Returns 'name' iterator
     *
     * @return \ArrayIterator
     */
    public function getNameIterator()
    {
        return new \ArrayIterator($this->get(self::NAME));
    }

    /**
     * Returns element from 'name' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Google\Protobuf\UninterpretedOption_NamePart
     */
    public function getNameAt($offset)
    {
        return $this->get(self::NAME, $offset);
    }

    /**
     * Returns count of 'name' list
     *
     * @return int
     */
    public function getNameCount()
    {
        return $this->count(self::NAME);
    }

    /**
     * Sets value of 'identifier_value' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setIdentifierValue($value)
    {
        return $this->set(self::IDENTIFIER_VALUE, $value);
    }

    /**
     * Returns value of 'identifier_value' property
     *
     * @return string
     */
    public function getIdentifierValue()
    {
        return $this->get(self::IDENTIFIER_VALUE);
    }

    /**
     * Sets value of 'positive_int_value' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPositiveIntValue($value)
    {
        return $this->set(self::POSITIVE_INT_VALUE, $value);
    }

    /**
     * Returns value of 'positive_int_value' property
     *
     * @return integer
     */
    public function getPositiveIntValue()
    {
        return $this->get(self::POSITIVE_INT_VALUE);
    }

    /**
     * Sets value of 'negative_int_value' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setNegativeIntValue($value)
    {
        return $this->set(self::NEGATIVE_INT_VALUE, $value);
    }

    /**
     * Returns value of 'negative_int_value' property
     *
     * @return integer
     */
    public function getNegativeIntValue()
    {
        return $this->get(self::NEGATIVE_INT_VALUE);
    }

    /**
     * Sets value of 'double_value' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setDoubleValue($value)
    {
        return $this->set(self::DOUBLE_VALUE, $value);
    }

    /**
     * Returns value of 'double_value' property
     *
     * @return double
     */
    public function getDoubleValue()
    {
        return $this->get(self::DOUBLE_VALUE);
    }

    /**
     * Sets value of 'string_value' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setStringValue($value)
    {
        return $this->set(self::STRING_VALUE, $value);
    }

    /**
     * Returns value of 'string_value' property
     *
     * @return string
     */
    public function getStringValue()
    {
        return $this->get(self::STRING_VALUE);
    }

    /**
     * Sets value of 'aggregate_value' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setAggregateValue($value)
    {
        return $this->set(self::AGGREGATE_VALUE, $value);
    }

    /**
     * Returns value of 'aggregate_value' property
     *
     * @return string
     */
    public function getAggregateValue()
    {
        return $this->get(self::AGGREGATE_VALUE);
    }
}
}