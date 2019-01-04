<?php
/**
 * Auto generated from plugin.proto at 2019-01-07 11:34:00
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
    const COMPILER_VERSION = 3;

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
        self::COMPILER_VERSION => array(
            'name' => 'compiler_version',
            'required' => false,
            'type' => '\Google\Protobuf\Compiler\Version'
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
        $this->values[self::COMPILER_VERSION] = null;
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
     * Returns true if 'file_to_generate' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasFileToGenerate()
    {
        return count($this->get(self::FILE_TO_GENERATE)) !== 0;
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
        $value = $this->get(self::PARAMETER);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'parameter' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasParameter()
    {
        return $this->get(self::PARAMETER) !== null;
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
     * Returns true if 'proto_file' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasProtoFile()
    {
        return count($this->get(self::PROTO_FILE)) !== 0;
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

    /**
     * Sets value of 'compiler_version' property
     *
     * @param \Google\Protobuf\Compiler\Version $value Property value
     *
     * @return null
     */
    public function setCompilerVersion(\Google\Protobuf\Compiler\Version $value=null)
    {
        return $this->set(self::COMPILER_VERSION, $value);
    }

    /**
     * Returns value of 'compiler_version' property
     *
     * @return \Google\Protobuf\Compiler\Version
     */
    public function getCompilerVersion()
    {
        return $this->get(self::COMPILER_VERSION);
    }

    /**
     * Returns true if 'compiler_version' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasCompilerVersion()
    {
        return $this->get(self::COMPILER_VERSION) !== null;
    }
}
}