<?php
/**
 * Auto generated from plugin.proto at 2019-01-07 11:34:00
 *
 * google.protobuf.compiler package
 */

namespace Google\Protobuf\Compiler {
/**
 * Version message
 */
class Version extends \ProtobufMessage
{
    /* Field index constants */
    const MAJOR = 1;
    const MINOR = 2;
    const PATCH = 3;
    const SUFFIX = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::MAJOR => array(
            'name' => 'major',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MINOR => array(
            'name' => 'minor',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::PATCH => array(
            'name' => 'patch',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SUFFIX => array(
            'name' => 'suffix',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
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
        $this->values[self::MAJOR] = null;
        $this->values[self::MINOR] = null;
        $this->values[self::PATCH] = null;
        $this->values[self::SUFFIX] = null;
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
     * Sets value of 'major' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMajor($value)
    {
        return $this->set(self::MAJOR, $value);
    }

    /**
     * Returns value of 'major' property
     *
     * @return integer
     */
    public function getMajor()
    {
        $value = $this->get(self::MAJOR);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'major' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasMajor()
    {
        return $this->get(self::MAJOR) !== null;
    }

    /**
     * Sets value of 'minor' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setMinor($value)
    {
        return $this->set(self::MINOR, $value);
    }

    /**
     * Returns value of 'minor' property
     *
     * @return integer
     */
    public function getMinor()
    {
        $value = $this->get(self::MINOR);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'minor' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasMinor()
    {
        return $this->get(self::MINOR) !== null;
    }

    /**
     * Sets value of 'patch' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setPatch($value)
    {
        return $this->set(self::PATCH, $value);
    }

    /**
     * Returns value of 'patch' property
     *
     * @return integer
     */
    public function getPatch()
    {
        $value = $this->get(self::PATCH);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'patch' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPatch()
    {
        return $this->get(self::PATCH) !== null;
    }

    /**
     * Sets value of 'suffix' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setSuffix($value)
    {
        return $this->set(self::SUFFIX, $value);
    }

    /**
     * Returns value of 'suffix' property
     *
     * @return string
     */
    public function getSuffix()
    {
        $value = $this->get(self::SUFFIX);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'suffix' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasSuffix()
    {
        return $this->get(self::SUFFIX) !== null;
    }
}
}