<?php
/**
 * Auto generated from descriptor.proto at 2016-07-08 14:22:37
 *
 * google.protobuf package
 */

namespace Google\Protobuf {
/**
 * FieldDescriptorProto message
 */
class FieldDescriptorProto extends \ProtobufMessage
{
    /* Field index constants */
    const NAME = 1;
    const NUMBER = 3;
    const LABEL = 4;
    const TYPE = 5;
    const TYPE_NAME = 6;
    const EXTENDEE = 2;
    const DEFAULT_VALUE = 7;
    const ONEOF_INDEX = 9;
    const JSON_NAME = 10;
    const OPTIONS = 8;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::NUMBER => array(
            'name' => 'number',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::LABEL => array(
            'name' => 'label',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TYPE => array(
            'name' => 'type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::TYPE_NAME => array(
            'name' => 'type_name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::EXTENDEE => array(
            'name' => 'extendee',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::DEFAULT_VALUE => array(
            'name' => 'default_value',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::ONEOF_INDEX => array(
            'name' => 'oneof_index',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::JSON_NAME => array(
            'name' => 'json_name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::OPTIONS => array(
            'name' => 'options',
            'required' => false,
            'type' => '\Google\Protobuf\FieldOptions'
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
        $this->values[self::LABEL] = null;
        $this->values[self::TYPE] = null;
        $this->values[self::TYPE_NAME] = null;
        $this->values[self::EXTENDEE] = null;
        $this->values[self::DEFAULT_VALUE] = null;
        $this->values[self::ONEOF_INDEX] = null;
        $this->values[self::JSON_NAME] = null;
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
     * Sets value of 'label' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setLabel($value)
    {
        return $this->set(self::LABEL, $value);
    }

    /**
     * Returns value of 'label' property
     *
     * @return integer
     */
    public function getLabel()
    {
        return $this->get(self::LABEL);
    }

    /**
     * Sets value of 'type' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setType($value)
    {
        return $this->set(self::TYPE, $value);
    }

    /**
     * Returns value of 'type' property
     *
     * @return integer
     */
    public function getType()
    {
        return $this->get(self::TYPE);
    }

    /**
     * Sets value of 'type_name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setTypeName($value)
    {
        return $this->set(self::TYPE_NAME, $value);
    }

    /**
     * Returns value of 'type_name' property
     *
     * @return string
     */
    public function getTypeName()
    {
        return $this->get(self::TYPE_NAME);
    }

    /**
     * Sets value of 'extendee' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setExtendee($value)
    {
        return $this->set(self::EXTENDEE, $value);
    }

    /**
     * Returns value of 'extendee' property
     *
     * @return string
     */
    public function getExtendee()
    {
        return $this->get(self::EXTENDEE);
    }

    /**
     * Sets value of 'default_value' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setDefaultValue($value)
    {
        return $this->set(self::DEFAULT_VALUE, $value);
    }

    /**
     * Returns value of 'default_value' property
     *
     * @return string
     */
    public function getDefaultValue()
    {
        return $this->get(self::DEFAULT_VALUE);
    }

    /**
     * Sets value of 'oneof_index' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setOneofIndex($value)
    {
        return $this->set(self::ONEOF_INDEX, $value);
    }

    /**
     * Returns value of 'oneof_index' property
     *
     * @return integer
     */
    public function getOneofIndex()
    {
        return $this->get(self::ONEOF_INDEX);
    }

    /**
     * Sets value of 'json_name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setJsonName($value)
    {
        return $this->set(self::JSON_NAME, $value);
    }

    /**
     * Returns value of 'json_name' property
     *
     * @return string
     */
    public function getJsonName()
    {
        return $this->get(self::JSON_NAME);
    }

    /**
     * Sets value of 'options' property
     *
     * @param \Google\Protobuf\FieldOptions $value Property value
     *
     * @return null
     */
    public function setOptions(\Google\Protobuf\FieldOptions $value)
    {
        return $this->set(self::OPTIONS, $value);
    }

    /**
     * Returns value of 'options' property
     *
     * @return \Google\Protobuf\FieldOptions
     */
    public function getOptions()
    {
        return $this->get(self::OPTIONS);
    }
}
}