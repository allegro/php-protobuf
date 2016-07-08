<?php
/**
 * Auto generated from descriptor.proto at 2016-06-26 19:19:31
 */

namespace Google\Protobuf\Compiler {
/**
 * Annotation message embedded in GeneratedCodeInfo message
 */
class GeneratedCodeInfo_Annotation extends \ProtobufMessage
{
    /* Field index constants */
    const SOURCE_FILE = 2;
    const BEGIN = 3;
    const END = 4;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::SOURCE_FILE => array(
            'name' => 'source_file',
            'required' => false,
            'type' => 7,
        ),
        self::BEGIN => array(
            'name' => 'begin',
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
        $this->values[self::SOURCE_FILE] = null;
        $this->values[self::BEGIN] = null;
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
     * Sets value of 'source_file' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setSourceFile($value)
    {
        return $this->set(self::SOURCE_FILE, $value);
    }

    /**
     * Returns value of 'source_file' property
     *
     * @return string
     */
    public function getSourceFile()
    {
        return $this->get(self::SOURCE_FILE);
    }

    /**
     * Sets value of 'begin' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setBegin($value)
    {
        return $this->set(self::BEGIN, $value);
    }

    /**
     * Returns value of 'begin' property
     *
     * @return integer
     */
    public function getBegin()
    {
        return $this->get(self::BEGIN);
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