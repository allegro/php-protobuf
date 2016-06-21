<?php
/**
 * Auto generated from plugin.proto at 2016-06-20 09:51:55
 */

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
            'type' => 7,
        ),
        self::PARAMETER => array(
            'name' => 'parameter',
            'required' => false,
            'type' => 7,
        ),
        self::PROTO_FILE => array(
            'name' => 'proto_file',
            'repeated' => true,
            'type' => 'FileDescriptorProto'
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     *
     * @return null
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
     * @return ArrayIterator
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
     * @param FileDescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendProtoFile(FileDescriptorProto $value)
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
     * @return FileDescriptorProto[]
     */
    public function getProtoFile()
    {
        return $this->get(self::PROTO_FILE);
    }

    /**
     * Returns 'proto_file' iterator
     *
     * @return ArrayIterator
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
     * @return FileDescriptorProto
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

/**
 * File message embedded in CodeGeneratorResponse message
 */
class CodeGeneratorResponse_File extends \ProtobufMessage
{
    /* Field index constants */
    const NAME = 1;
    const INSERTION_POINT = 2;
    const CONTENT = 15;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => 7,
        ),
        self::INSERTION_POINT => array(
            'name' => 'insertion_point',
            'required' => false,
            'type' => 7,
        ),
        self::CONTENT => array(
            'name' => 'content',
            'required' => false,
            'type' => 7,
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     *
     * @return null
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
        $this->values[self::INSERTION_POINT] = null;
        $this->values[self::CONTENT] = null;
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
     * Sets value of 'insertion_point' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setInsertionPoint($value)
    {
        return $this->set(self::INSERTION_POINT, $value);
    }

    /**
     * Returns value of 'insertion_point' property
     *
     * @return string
     */
    public function getInsertionPoint()
    {
        return $this->get(self::INSERTION_POINT);
    }

    /**
     * Sets value of 'content' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setContent($value)
    {
        return $this->set(self::CONTENT, $value);
    }

    /**
     * Returns value of 'content' property
     *
     * @return string
     */
    public function getContent()
    {
        return $this->get(self::CONTENT);
    }
}

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
            'type' => 7,
        ),
        self::FILE => array(
            'name' => 'file',
            'repeated' => true,
            'type' => 'CodeGeneratorResponse_File'
        ),
    );

    /**
     * Constructs new message container and clears its internal state
     *
     * @return null
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
     * @param CodeGeneratorResponse_File $value Value to append
     *
     * @return null
     */
    public function appendFile(CodeGeneratorResponse_File $value)
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
     * @return CodeGeneratorResponse_File[]
     */
    public function getFile()
    {
        return $this->get(self::FILE);
    }

    /**
     * Returns 'file' iterator
     *
     * @return ArrayIterator
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
     * @return CodeGeneratorResponse_File
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
require_once 'pb_proto_descriptor.php';