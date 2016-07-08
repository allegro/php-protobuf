<?php
/**
 * Auto generated from descriptor.proto at 2016-07-08 14:22:37
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
        return $this->get(self::CTYPE);
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
        return $this->get(self::PACKED);
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
        return $this->get(self::JSTYPE);
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
        return $this->get(self::LAZY);
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
        return $this->get(self::WEAK);
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