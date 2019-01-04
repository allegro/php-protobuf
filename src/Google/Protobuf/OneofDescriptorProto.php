<?php
/**
 * Auto generated from descriptor.proto at 2019-01-07 11:34:00
 *
 * google.protobuf package
 */

namespace Google\Protobuf {
/**
 * OneofDescriptorProto message
 */
class OneofDescriptorProto extends \ProtobufMessage
{
    /* Field index constants */
    const NAME = 1;
    const OPTIONS = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::OPTIONS => array(
            'name' => 'options',
            'required' => false,
            'type' => '\Google\Protobuf\OneofOptions'
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
     * Sets value of 'options' property
     *
     * @param \Google\Protobuf\OneofOptions $value Property value
     *
     * @return null
     */
    public function setOptions(\Google\Protobuf\OneofOptions $value=null)
    {
        return $this->set(self::OPTIONS, $value);
    }

    /**
     * Returns value of 'options' property
     *
     * @return \Google\Protobuf\OneofOptions
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
}