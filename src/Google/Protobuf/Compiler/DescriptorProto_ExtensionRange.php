<?php
/**
 * Auto generated from descriptor.proto at 2016-06-26 19:19:31
 */

namespace Google\Protobuf\Compiler {
/**
 * ExtensionRange message embedded in DescriptorProto message
 */
class DescriptorProto_ExtensionRange extends \ProtobufMessage
{
    /* Field index constants */
    const START = 1;
    const END = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::START => array(
            'name' => 'start',
            'required' => false,
            'type' => 5,
        ),
        self::END => array(
            'name' => 'end',
            'required' => false,
            'type' => 5,
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
        $this->values[self::START] = null;
        $this->values[self::END] = null;
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
     * Sets value of 'start' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setStart($value)
    {
        return $this->set(self::START, $value);
    }

    /**
     * Returns value of 'start' property
     *
     * @return integer
     */
    public function getStart()
    {
        return $this->get(self::START);
    }

    /**
     * Sets value of 'end' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setEnd($value)
    {
        return $this->set(self::END, $value);
    }

    /**
     * Returns value of 'end' property
     *
     * @return integer
     */
    public function getEnd()
    {
        return $this->get(self::END);
    }
}
}