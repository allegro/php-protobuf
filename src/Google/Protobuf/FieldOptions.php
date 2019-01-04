<?php
/**
 * Auto generated from descriptor.proto at 2019-01-07 11:34:00
 *
 * google.protobuf package
 */

namespace Google\Protobuf {
/**
 * FieldOptions message
 */
class FieldOptions extends \ProtobufMessage
{
    /* Field index constants */
    const CTYPE = 1;
    const PACKED = 2;
    const JSTYPE = 6;
    const LAZY = 5;
    const DEPRECATED = 3;
    const WEAK = 10;
    const UNINTERPRETED_OPTION = 999;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::CTYPE => array(
            'default' => \Google\Protobuf\FieldOptions_CType::STRING,
            'name' => 'ctype',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PACKED => array(
            'name' => 'packed',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::JSTYPE => array(
            'default' => \Google\Protobuf\FieldOptions_JSType::JS_NORMAL,
            'name' => 'jstype',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LAZY => array(
            'default' => false,
            'name' => 'lazy',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::DEPRECATED => array(
            'default' => false,
            'name' => 'deprecated',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::WEAK => array(
            'default' => false,
            'name' => 'weak',
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
        $this->values[self::CTYPE] = self::$fields[self::CTYPE]['default'];
        $this->values[self::PACKED] = null;
        $this->values[self::JSTYPE] = self::$fields[self::JSTYPE]['default'];
        $this->values[self::LAZY] = self::$fields[self::LAZY]['default'];
        $this->values[self::DEPRECATED] = self::$fields[self::DEPRECATED]['default'];
        $this->values[self::WEAK] = self::$fields[self::WEAK]['default'];
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
     * Sets value of 'ctype' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setCtype($value)
    {
        return $this->set(self::CTYPE, $value);
    }

    /**
     * Returns value of 'ctype' property
     *
     * @return integer
     */
    public function getCtype()
    {
        $value = $this->get(self::CTYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'ctype' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasCtype()
    {
        return $this->get(self::CTYPE) !== null;
    }

    /**
     * Sets value of 'packed' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setPacked($value)
    {
        return $this->set(self::PACKED, $value);
    }

    /**
     * Returns value of 'packed' property
     *
     * @return boolean
     */
    public function getPacked()
    {
        $value = $this->get(self::PACKED);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'packed' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPacked()
    {
        return $this->get(self::PACKED) !== null;
    }

    /**
     * Sets value of 'jstype' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setJstype($value)
    {
        return $this->set(self::JSTYPE, $value);
    }

    /**
     * Returns value of 'jstype' property
     *
     * @return integer
     */
    public function getJstype()
    {
        $value = $this->get(self::JSTYPE);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'jstype' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasJstype()
    {
        return $this->get(self::JSTYPE) !== null;
    }

    /**
     * Sets value of 'lazy' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setLazy($value)
    {
        return $this->set(self::LAZY, $value);
    }

    /**
     * Returns value of 'lazy' property
     *
     * @return boolean
     */
    public function getLazy()
    {
        $value = $this->get(self::LAZY);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'lazy' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasLazy()
    {
        return $this->get(self::LAZY) !== null;
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
     * Sets value of 'weak' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setWeak($value)
    {
        return $this->set(self::WEAK, $value);
    }

    /**
     * Returns value of 'weak' property
     *
     * @return boolean
     */
    public function getWeak()
    {
        $value = $this->get(self::WEAK);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'weak' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasWeak()
    {
        return $this->get(self::WEAK) !== null;
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
}