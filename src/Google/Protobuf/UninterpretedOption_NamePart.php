<?php
/**
 * Auto generated from descriptor.proto at 2016-07-08 14:22:37
 *
 * google.protobuf package
 */

namespace Google\Protobuf {
/**
 * NamePart message embedded in UninterpretedOption message
 */
class UninterpretedOption_NamePart extends \ProtobufMessage
{
    /* Field index constants */
    const NAME_PART = 1;
    const IS_EXTENSION = 2;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NAME_PART => array(
            'name' => 'name_part',
            'required' => true,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::IS_EXTENSION => array(
            'name' => 'is_extension',
            'required' => true,
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
        $this->values[self::NAME_PART] = null;
        $this->values[self::IS_EXTENSION] = null;
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
     * Sets value of 'name_part' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setNamePart($value)
    {
        return $this->set(self::NAME_PART, $value);
    }

    /**
     * Returns value of 'name_part' property
     *
     * @return string
     */
    public function getNamePart()
    {
        return $this->get(self::NAME_PART);
    }

    /**
     * Sets value of 'is_extension' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setIsExtension($value)
    {
        return $this->set(self::IS_EXTENSION, $value);
    }

    /**
     * Returns value of 'is_extension' property
     *
     * @return boolean
     */
    public function getIsExtension()
    {
        return $this->get(self::IS_EXTENSION);
    }
}
}