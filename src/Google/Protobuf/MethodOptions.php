<?php
/**
 * Generated from descriptor.proto by the protocol buffer compiler. DO NOT EDIT!
 */

namespace Google\Protobuf;

/**
 * MethodOptions message
 */
class MethodOptions extends \ProtobufMessage
{
    /* Field index constants */
    const DEPRECATED = 33;
    const IDEMPOTENCY_LEVEL = 34;
    const UNINTERPRETED_OPTION = 999;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::DEPRECATED => array(
            'default' => false,
            'name' => 'deprecated',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::IDEMPOTENCY_LEVEL => array(
            'default' => \Google\Protobuf\MethodOptions\IdempotencyLevel::IDEMPOTENCY_UNKNOWN,
            'name' => 'idempotency_level',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::UNINTERPRETED_OPTION => array(
            'name' => 'uninterpreted_option',
            'repeated' => true,
            'type' => '\Google\Protobuf\UninterpretedOption'
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
        $value = $this->get(self::DEPRECATED);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'deprecated' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasDeprecated()
    {
        return $this->get(self::DEPRECATED) !== null;
    }

    /**
     * Sets value of 'idempotency_level' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setIdempotencyLevel($value)
    {
        return $this->set(self::IDEMPOTENCY_LEVEL, $value);
    }

    /**
     * Returns value of 'idempotency_level' property
     *
     * @return integer
     */
    public function getIdempotencyLevel()
    {
        $value = $this->get(self::IDEMPOTENCY_LEVEL);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'idempotency_level' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasIdempotencyLevel()
    {
        return $this->get(self::IDEMPOTENCY_LEVEL) !== null;
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
     * Returns true if 'uninterpreted_option' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasUninterpretedOption()
    {
        return count($this->get(self::UNINTERPRETED_OPTION)) !== 0;
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