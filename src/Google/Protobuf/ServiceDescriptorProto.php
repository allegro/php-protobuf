<?php
/**
 * Auto generated from descriptor.proto at 2016-07-08 14:22:37
 *
 * google.protobuf package
 */

namespace Google\Protobuf {
/**
 * ServiceDescriptorProto message
 */
class ServiceDescriptorProto extends \ProtobufMessage
{
    /* Field index constants */
    const NAME = 1;
    const METHOD = 2;
    const OPTIONS = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::METHOD => array(
            'name' => 'method',
            'repeated' => true,
            'type' => '\Google\Protobuf\MethodDescriptorProto'
        ),
        self::OPTIONS => array(
            'name' => 'options',
            'required' => false,
            'type' => '\Google\Protobuf\ServiceOptions'
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
        $this->values[self::METHOD] = array();
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
     * Appends value to 'method' list
     *
     * @param \Google\Protobuf\MethodDescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendMethod(\Google\Protobuf\MethodDescriptorProto $value)
    {
        return $this->append(self::METHOD, $value);
    }

    /**
     * Clears 'method' list
     *
     * @return null
     */
    public function clearMethod()
    {
        return $this->clear(self::METHOD);
    }

    /**
     * Returns 'method' list
     *
     * @return \Google\Protobuf\MethodDescriptorProto[]
     */
    public function getMethod()
    {
        return $this->get(self::METHOD);
    }

    /**
     * Returns 'method' iterator
     *
     * @return \ArrayIterator
     */
    public function getMethodIterator()
    {
        return new \ArrayIterator($this->get(self::METHOD));
    }

    /**
     * Returns element from 'method' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Google\Protobuf\MethodDescriptorProto
     */
    public function getMethodAt($offset)
    {
        return $this->get(self::METHOD, $offset);
    }

    /**
     * Returns count of 'method' list
     *
     * @return int
     */
    public function getMethodCount()
    {
        return $this->count(self::METHOD);
    }

    /**
     * Sets value of 'options' property
     *
     * @param \Google\Protobuf\ServiceOptions $value Property value
     *
     * @return null
     */
    public function setOptions(\Google\Protobuf\ServiceOptions $value)
    {
        return $this->set(self::OPTIONS, $value);
    }

    /**
     * Returns value of 'options' property
     *
     * @return \Google\Protobuf\ServiceOptions
     */
    public function getOptions()
    {
        return $this->get(self::OPTIONS);
    }
}
}