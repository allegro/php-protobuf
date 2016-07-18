<?php
/**
 * Auto generated from plugin.proto at 2016-07-08 14:22:37
 *
 * google.protobuf.compiler package
 */

namespace Google\Protobuf\Compiler {
/**
 * CodeGeneratorResponse message
 */
class CodeGeneratorResponse extends \ProtobufMessage
{
    /* Field index constants */
    const ERROR = 1;
    const FILE = 15;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ERROR => array(
            'name' => 'error',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::FILE => array(
            'name' => 'file',
            'repeated' => true,
            'type' => '\Google\Protobuf\Compiler\CodeGeneratorResponse_File'
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
        $this->values[self::ERROR] = null;
        $this->values[self::FILE] = array();
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
     * Sets value of 'error' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setError($value)
    {
        return $this->set(self::ERROR, $value);
    }

    /**
     * Returns value of 'error' property
     *
     * @return string
     */
    public function getError()
    {
        return $this->get(self::ERROR);
    }

    /**
     * Appends value to 'file' list
     *
     * @param \Google\Protobuf\Compiler\CodeGeneratorResponse_File $value Value to append
     *
     * @return null
     */
    public function appendFile(\Google\Protobuf\Compiler\CodeGeneratorResponse_File $value)
    {
        return $this->append(self::FILE, $value);
    }

    /**
     * Clears 'file' list
     *
     * @return null
     */
    public function clearFile()
    {
        return $this->clear(self::FILE);
    }

    /**
     * Returns 'file' list
     *
     * @return \Google\Protobuf\Compiler\CodeGeneratorResponse_File[]
     */
    public function getFile()
    {
        return $this->get(self::FILE);
    }

    /**
     * Returns 'file' iterator
     *
     * @return \ArrayIterator
     */
    public function getFileIterator()
    {
        return new \ArrayIterator($this->get(self::FILE));
    }

    /**
     * Returns element from 'file' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Google\Protobuf\Compiler\CodeGeneratorResponse_File
     */
    public function getFileAt($offset)
    {
        return $this->get(self::FILE, $offset);
    }

    /**
     * Returns count of 'file' list
     *
     * @return int
     */
    public function getFileCount()
    {
        return $this->count(self::FILE);
    }
}
}