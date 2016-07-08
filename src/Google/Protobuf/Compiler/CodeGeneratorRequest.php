<?php
/**
 * Auto generated from plugin.proto at 2016-07-08 14:22:37
 *
 * google.protobuf.compiler package
 */

namespace Google\Protobuf\Compiler {
/**
 * CodeGeneratorRequest message
 */
class CodeGeneratorRequest extends \ProtobufMessage
{
    /* Field index constants */
    const FILE_TO_GENERATE = 1;
    const PARAMETER = 2;
    const PROTO_FILE = 15;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::FILE_TO_GENERATE => array(
            'name' => 'file_to_generate',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::PARAMETER => array(
            'name' => 'parameter',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::PROTO_FILE => array(
            'name' => 'proto_file',
            'repeated' => true,
            'type' => '\Google\Protobuf\FileDescriptorProto'
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
        $this->values[self::FILE_TO_GENERATE] = array();
        $this->values[self::PARAMETER] = null;
        $this->values[self::PROTO_FILE] = array();
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
     * Appends value to 'file_to_generate' list
     *
     * @param string $value Value to append
     *
     * @return null
     */
    public function appendFileToGenerate($value)
    {
        return $this->append(self::FILE_TO_GENERATE, $value);
    }

    /**
     * Clears 'file_to_generate' list
     *
     * @return null
     */
    public function clearFileToGenerate()
    {
        return $this->clear(self::FILE_TO_GENERATE);
    }

    /**
     * Returns 'file_to_generate' list
     *
     * @return string[]
     */
    public function getFileToGenerate()
    {
        return $this->get(self::FILE_TO_GENERATE);
    }

    /**
     * Returns 'file_to_generate' iterator
     *
     * @return \ArrayIterator
     */
    public function getFileToGenerateIterator()
    {
        return new \ArrayIterator($this->get(self::FILE_TO_GENERATE));
    }

    /**
     * Returns element from 'file_to_generate' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return string
     */
    public function getFileToGenerateAt($offset)
    {
        return $this->get(self::FILE_TO_GENERATE, $offset);
    }

    /**
     * Returns count of 'file_to_generate' list
     *
     * @return int
     */
    public function getFileToGenerateCount()
    {
        return $this->count(self::FILE_TO_GENERATE);
    }

    /**
     * Sets value of 'parameter' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setParameter($value)
    {
        return $this->set(self::PARAMETER, $value);
    }

    /**
     * Returns value of 'parameter' property
     *
     * @return string
     */
    public function getParameter()
    {
        return $this->get(self::PARAMETER);
    }

    /**
     * Appends value to 'proto_file' list
     *
     * @param \Google\Protobuf\FileDescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendProtoFile(\Google\Protobuf\FileDescriptorProto $value)
    {
        return $this->append(self::PROTO_FILE, $value);
    }

    /**
     * Clears 'proto_file' list
     *
     * @return null
     */
    public function clearProtoFile()
    {
        return $this->clear(self::PROTO_FILE);
    }

    /**
     * Returns 'proto_file' list
     *
     * @return \Google\Protobuf\FileDescriptorProto[]
     */
    public function getProtoFile()
    {
        return $this->get(self::PROTO_FILE);
    }

    /**
     * Returns 'proto_file' iterator
     *
     * @return \ArrayIterator
     */
    public function getProtoFileIterator()
    {
        return new \ArrayIterator($this->get(self::PROTO_FILE));
    }

    /**
     * Returns element from 'proto_file' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return \Google\Protobuf\FileDescriptorProto
     */
    public function getProtoFileAt($offset)
    {
        return $this->get(self::PROTO_FILE, $offset);
    }

    /**
     * Returns count of 'proto_file' list
     *
     * @return int
     */
    public function getProtoFileCount()
    {
        return $this->count(self::PROTO_FILE);
    }
}
}