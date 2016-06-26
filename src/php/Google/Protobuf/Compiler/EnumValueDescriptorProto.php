<?php
/**
 * Auto generated from descriptor.proto at 2016-06-26 19:19:31
 */

namespace Google\Protobuf\Compiler {
/**
 * EnumValueDescriptorProto message
 */
class EnumValueDescriptorProto extends \ProtobufMessage
{
    /* Field index constants */
    const NAME = 1;
    const NUMBER = 2;
    const OPTIONS = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => 7,
        ),
        self::NUMBER => array(
            'name' => 'number',
            'required' => false,
            'type' => 5,
        ),
        self::OPTIONS => array(
            'name' => 'options',
            'required' => false,
            'type' => '\Google\Protobuf\Compiler\EnumValueOptions'
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
        $this->values[self::NUMBER] = null;
        $this->values[self::OPTIONS] = null;
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
        return $this->get(self::NAME);
    }

    /**
     * Sets value of 'number' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setNumber($value)
    {
        return $this->set(self::NUMBER, $value);
    }

    /**
     * Returns value of 'number' property
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->get(self::NUMBER);
    }

    /**
     * Sets value of 'options' property
     *
     * @param \Google\Protobuf\Compiler\EnumValueOptions $value Property value
     *
     * @return null
     */
    public function setOptions(\Google\Protobuf\Compiler\EnumValueOptions $value)
    {
        return $this->set(self::OPTIONS, $value);
    }

    /**
     * Returns value of 'options' property
     *
     * @return \Google\Protobuf\Compiler\EnumValueOptions
     */
    public function getOptions()
    {
        return $this->get(self::OPTIONS);
    }
}
}