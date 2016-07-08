<?php
/**
 * Auto generated from descriptor.proto at 2016-06-26 19:19:31
 */

namespace Google\Protobuf\Compiler {
/**
 * MethodOptions message
 */
class MethodOptions extends \ProtobufMessage
{
    /* Field index constants */
    const DEPRECATED = 33;
    const UNINTERPRETED_OPTION = 999;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::DEPRECATED => array(
            'default' => false,
            'name' => 'deprecated',
            'required' => false,
            'type' => 8,
        ),
        self::UNINTERPRETED_OPTION => array(
            'name' => 'uninterpreted_option',
            'repeated' => true,
            'type' => '\Google\Protobuf\Compiler\UninterpretedOption'
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
        $this->values[self::DEPRECATED] = self::$fields[self::DEPRECATED]['default'];
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
     * Appends value to 'uninterpreted_option' list
     *
     * @param \Google\Protobuf\Compiler\UninterpretedOption $value Value to append
     *
     * @return null
     */
    public function appendUninterpretedOption(\Google\Protobuf\Compiler\UninterpretedOption $value)
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
     * @return \Google\Protobuf\Compiler\UninterpretedOption[]
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
     * @return \Google\Protobuf\Compiler\UninterpretedOption
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