<?php
/**
 * Auto generated from descriptor.proto at 2019-01-07 11:34:00
 *
 * google.protobuf package
 */

namespace Google\Protobuf {
/**
 * MethodDescriptorProto message
 */
class MethodDescriptorProto extends \ProtobufMessage
{
    /* Field index constants */
    const NAME = 1;
    const INPUT_TYPE = 2;
    const OUTPUT_TYPE = 3;
    const OPTIONS = 4;
    const CLIENT_STREAMING = 5;
    const SERVER_STREAMING = 6;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::INPUT_TYPE => array(
            'name' => 'input_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::OUTPUT_TYPE => array(
            'name' => 'output_type',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::OPTIONS => array(
            'name' => 'options',
            'required' => false,
            'type' => '\Google\Protobuf\MethodOptions'
        ),
        self::CLIENT_STREAMING => array(
            'default' => false,
            'name' => 'client_streaming',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::SERVER_STREAMING => array(
            'default' => false,
            'name' => 'server_streaming',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
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
        $this->values[self::INPUT_TYPE] = null;
        $this->values[self::OUTPUT_TYPE] = null;
        $this->values[self::OPTIONS] = null;
        $this->values[self::CLIENT_STREAMING] = self::$fields[self::CLIENT_STREAMING]['default'];
        $this->values[self::SERVER_STREAMING] = self::$fields[self::SERVER_STREAMING]['default'];
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
     * Sets value of 'input_type' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setInputType($value)
    {
        return $this->set(self::INPUT_TYPE, $value);
    }

    /**
     * Returns value of 'input_type' property
     *
     * @return string
     */
    public function getInputType()
    {
        $value = $this->get(self::INPUT_TYPE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'input_type' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasInputType()
    {
        return $this->get(self::INPUT_TYPE) !== null;
    }

    /**
     * Sets value of 'output_type' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setOutputType($value)
    {
        return $this->set(self::OUTPUT_TYPE, $value);
    }

    /**
     * Returns value of 'output_type' property
     *
     * @return string
     */
    public function getOutputType()
    {
        $value = $this->get(self::OUTPUT_TYPE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'output_type' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasOutputType()
    {
        return $this->get(self::OUTPUT_TYPE) !== null;
    }

    /**
     * Sets value of 'options' property
     *
     * @param \Google\Protobuf\MethodOptions $value Property value
     *
     * @return null
     */
    public function setOptions(\Google\Protobuf\MethodOptions $value=null)
    {
        return $this->set(self::OPTIONS, $value);
    }

    /**
     * Returns value of 'options' property
     *
     * @return \Google\Protobuf\MethodOptions
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
     * Sets value of 'client_streaming' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setClientStreaming($value)
    {
        return $this->set(self::CLIENT_STREAMING, $value);
    }

    /**
     * Returns value of 'client_streaming' property
     *
     * @return boolean
     */
    public function getClientStreaming()
    {
        $value = $this->get(self::CLIENT_STREAMING);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'client_streaming' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasClientStreaming()
    {
        return $this->get(self::CLIENT_STREAMING) !== null;
    }

    /**
     * Sets value of 'server_streaming' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setServerStreaming($value)
    {
        return $this->set(self::SERVER_STREAMING, $value);
    }

    /**
     * Returns value of 'server_streaming' property
     *
     * @return boolean
     */
    public function getServerStreaming()
    {
        $value = $this->get(self::SERVER_STREAMING);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'server_streaming' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasServerStreaming()
    {
        return $this->get(self::SERVER_STREAMING) !== null;
    }
}
}