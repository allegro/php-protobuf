<?php
/**
 * Auto generated from descriptor.proto at 2016-06-20 09:51:55
 */

/**
 * FileDescriptorSet message
 */
class FileDescriptorSet extends \ProtobufMessage
{
    /* Field index constants */
    const FILE = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::FILE => array(
            'name' => 'file',
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
     * Appends value to 'file' list
     *
     * @param FileDescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendFile(FileDescriptorProto $value)
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
     * @return FileDescriptorProto[]
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
     * @return FileDescriptorProto
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

/**
 * FileDescriptorProto message
 */
class FileDescriptorProto extends \ProtobufMessage
{
    /* Field index constants */
    const NAME = 1;
    const PACKAGE = 2;
    const DEPENDENCY = 3;
    const PUBLIC_DEPENDENCY = 10;
    const WEAK_DEPENDENCY = 11;
    const MESSAGE_TYPE = 4;
    const ENUM_TYPE = 5;
    const SERVICE = 6;
    const EXTENSION = 7;
    const OPTIONS = 8;
    const SOURCE_CODE_INFO = 9;
    const SYNTAX = 12;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => 7,
        ),
        self::PACKAGE => array(
            'name' => 'package',
            'required' => false,
            'type' => 7,
        ),
        self::DEPENDENCY => array(
            'name' => 'dependency',
            'repeated' => true,
            'type' => 7,
        ),
        self::PUBLIC_DEPENDENCY => array(
            'name' => 'public_dependency',
            'repeated' => true,
            'type' => 5,
        ),
        self::WEAK_DEPENDENCY => array(
            'name' => 'weak_dependency',
            'repeated' => true,
            'type' => 5,
        ),
        self::MESSAGE_TYPE => array(
            'name' => 'message_type',
            'repeated' => true,
            'type' => 'DescriptorProto'
        ),
        self::ENUM_TYPE => array(
            'name' => 'enum_type',
            'repeated' => true,
            'type' => 'EnumDescriptorProto'
        ),
        self::SERVICE => array(
            'name' => 'service',
            'repeated' => true,
            'type' => 'ServiceDescriptorProto'
        ),
        self::EXTENSION => array(
            'name' => 'extension',
            'repeated' => true,
            'type' => 'FieldDescriptorProto'
        ),
        self::OPTIONS => array(
            'name' => 'options',
            'required' => false,
            'type' => 'FileOptions'
        ),
        self::SOURCE_CODE_INFO => array(
            'name' => 'source_code_info',
            'required' => false,
            'type' => 'SourceCodeInfo'
        ),
        self::SYNTAX => array(
            'name' => 'syntax',
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
        $this->values[self::PACKAGE] = null;
        $this->values[self::DEPENDENCY] = array();
        $this->values[self::PUBLIC_DEPENDENCY] = array();
        $this->values[self::WEAK_DEPENDENCY] = array();
        $this->values[self::MESSAGE_TYPE] = array();
        $this->values[self::ENUM_TYPE] = array();
        $this->values[self::SERVICE] = array();
        $this->values[self::EXTENSION] = array();
        $this->values[self::OPTIONS] = null;
        $this->values[self::SOURCE_CODE_INFO] = null;
        $this->values[self::SYNTAX] = null;
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
     * Sets value of 'package' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setPackage($value)
    {
        return $this->set(self::PACKAGE, $value);
    }

    /**
     * Returns value of 'package' property
     *
     * @return string
     */
    public function getPackage()
    {
        return $this->get(self::PACKAGE);
    }

    /**
     * Appends value to 'dependency' list
     *
     * @param string $value Value to append
     *
     * @return null
     */
    public function appendDependency($value)
    {
        return $this->append(self::DEPENDENCY, $value);
    }

    /**
     * Clears 'dependency' list
     *
     * @return null
     */
    public function clearDependency()
    {
        return $this->clear(self::DEPENDENCY);
    }

    /**
     * Returns 'dependency' list
     *
     * @return string[]
     */
    public function getDependency()
    {
        return $this->get(self::DEPENDENCY);
    }

    /**
     * Returns 'dependency' iterator
     *
     * @return ArrayIterator
     */
    public function getDependencyIterator()
    {
        return new \ArrayIterator($this->get(self::DEPENDENCY));
    }

    /**
     * Returns element from 'dependency' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return string
     */
    public function getDependencyAt($offset)
    {
        return $this->get(self::DEPENDENCY, $offset);
    }

    /**
     * Returns count of 'dependency' list
     *
     * @return int
     */
    public function getDependencyCount()
    {
        return $this->count(self::DEPENDENCY);
    }

    /**
     * Appends value to 'public_dependency' list
     *
     * @param int $value Value to append
     *
     * @return null
     */
    public function appendPublicDependency($value)
    {
        return $this->append(self::PUBLIC_DEPENDENCY, $value);
    }

    /**
     * Clears 'public_dependency' list
     *
     * @return null
     */
    public function clearPublicDependency()
    {
        return $this->clear(self::PUBLIC_DEPENDENCY);
    }

    /**
     * Returns 'public_dependency' list
     *
     * @return int[]
     */
    public function getPublicDependency()
    {
        return $this->get(self::PUBLIC_DEPENDENCY);
    }

    /**
     * Returns 'public_dependency' iterator
     *
     * @return ArrayIterator
     */
    public function getPublicDependencyIterator()
    {
        return new \ArrayIterator($this->get(self::PUBLIC_DEPENDENCY));
    }

    /**
     * Returns element from 'public_dependency' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return int
     */
    public function getPublicDependencyAt($offset)
    {
        return $this->get(self::PUBLIC_DEPENDENCY, $offset);
    }

    /**
     * Returns count of 'public_dependency' list
     *
     * @return int
     */
    public function getPublicDependencyCount()
    {
        return $this->count(self::PUBLIC_DEPENDENCY);
    }

    /**
     * Appends value to 'weak_dependency' list
     *
     * @param int $value Value to append
     *
     * @return null
     */
    public function appendWeakDependency($value)
    {
        return $this->append(self::WEAK_DEPENDENCY, $value);
    }

    /**
     * Clears 'weak_dependency' list
     *
     * @return null
     */
    public function clearWeakDependency()
    {
        return $this->clear(self::WEAK_DEPENDENCY);
    }

    /**
     * Returns 'weak_dependency' list
     *
     * @return int[]
     */
    public function getWeakDependency()
    {
        return $this->get(self::WEAK_DEPENDENCY);
    }

    /**
     * Returns 'weak_dependency' iterator
     *
     * @return ArrayIterator
     */
    public function getWeakDependencyIterator()
    {
        return new \ArrayIterator($this->get(self::WEAK_DEPENDENCY));
    }

    /**
     * Returns element from 'weak_dependency' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return int
     */
    public function getWeakDependencyAt($offset)
    {
        return $this->get(self::WEAK_DEPENDENCY, $offset);
    }

    /**
     * Returns count of 'weak_dependency' list
     *
     * @return int
     */
    public function getWeakDependencyCount()
    {
        return $this->count(self::WEAK_DEPENDENCY);
    }

    /**
     * Appends value to 'message_type' list
     *
     * @param DescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendMessageType(DescriptorProto $value)
    {
        return $this->append(self::MESSAGE_TYPE, $value);
    }

    /**
     * Clears 'message_type' list
     *
     * @return null
     */
    public function clearMessageType()
    {
        return $this->clear(self::MESSAGE_TYPE);
    }

    /**
     * Returns 'message_type' list
     *
     * @return DescriptorProto[]
     */
    public function getMessageType()
    {
        return $this->get(self::MESSAGE_TYPE);
    }

    /**
     * Returns 'message_type' iterator
     *
     * @return ArrayIterator
     */
    public function getMessageTypeIterator()
    {
        return new \ArrayIterator($this->get(self::MESSAGE_TYPE));
    }

    /**
     * Returns element from 'message_type' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return DescriptorProto
     */
    public function getMessageTypeAt($offset)
    {
        return $this->get(self::MESSAGE_TYPE, $offset);
    }

    /**
     * Returns count of 'message_type' list
     *
     * @return int
     */
    public function getMessageTypeCount()
    {
        return $this->count(self::MESSAGE_TYPE);
    }

    /**
     * Appends value to 'enum_type' list
     *
     * @param EnumDescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendEnumType(EnumDescriptorProto $value)
    {
        return $this->append(self::ENUM_TYPE, $value);
    }

    /**
     * Clears 'enum_type' list
     *
     * @return null
     */
    public function clearEnumType()
    {
        return $this->clear(self::ENUM_TYPE);
    }

    /**
     * Returns 'enum_type' list
     *
     * @return EnumDescriptorProto[]
     */
    public function getEnumType()
    {
        return $this->get(self::ENUM_TYPE);
    }

    /**
     * Returns 'enum_type' iterator
     *
     * @return ArrayIterator
     */
    public function getEnumTypeIterator()
    {
        return new \ArrayIterator($this->get(self::ENUM_TYPE));
    }

    /**
     * Returns element from 'enum_type' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return EnumDescriptorProto
     */
    public function getEnumTypeAt($offset)
    {
        return $this->get(self::ENUM_TYPE, $offset);
    }

    /**
     * Returns count of 'enum_type' list
     *
     * @return int
     */
    public function getEnumTypeCount()
    {
        return $this->count(self::ENUM_TYPE);
    }

    /**
     * Appends value to 'service' list
     *
     * @param ServiceDescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendService(ServiceDescriptorProto $value)
    {
        return $this->append(self::SERVICE, $value);
    }

    /**
     * Clears 'service' list
     *
     * @return null
     */
    public function clearService()
    {
        return $this->clear(self::SERVICE);
    }

    /**
     * Returns 'service' list
     *
     * @return ServiceDescriptorProto[]
     */
    public function getService()
    {
        return $this->get(self::SERVICE);
    }

    /**
     * Returns 'service' iterator
     *
     * @return ArrayIterator
     */
    public function getServiceIterator()
    {
        return new \ArrayIterator($this->get(self::SERVICE));
    }

    /**
     * Returns element from 'service' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return ServiceDescriptorProto
     */
    public function getServiceAt($offset)
    {
        return $this->get(self::SERVICE, $offset);
    }

    /**
     * Returns count of 'service' list
     *
     * @return int
     */
    public function getServiceCount()
    {
        return $this->count(self::SERVICE);
    }

    /**
     * Appends value to 'extension' list
     *
     * @param FieldDescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendExtension(FieldDescriptorProto $value)
    {
        return $this->append(self::EXTENSION, $value);
    }

    /**
     * Clears 'extension' list
     *
     * @return null
     */
    public function clearExtension()
    {
        return $this->clear(self::EXTENSION);
    }

    /**
     * Returns 'extension' list
     *
     * @return FieldDescriptorProto[]
     */
    public function getExtension()
    {
        return $this->get(self::EXTENSION);
    }

    /**
     * Returns 'extension' iterator
     *
     * @return ArrayIterator
     */
    public function getExtensionIterator()
    {
        return new \ArrayIterator($this->get(self::EXTENSION));
    }

    /**
     * Returns element from 'extension' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return FieldDescriptorProto
     */
    public function getExtensionAt($offset)
    {
        return $this->get(self::EXTENSION, $offset);
    }

    /**
     * Returns count of 'extension' list
     *
     * @return int
     */
    public function getExtensionCount()
    {
        return $this->count(self::EXTENSION);
    }

    /**
     * Sets value of 'options' property
     *
     * @param FileOptions $value Property value
     *
     * @return null
     */
    public function setOptions(FileOptions $value)
    {
        return $this->set(self::OPTIONS, $value);
    }

    /**
     * Returns value of 'options' property
     *
     * @return FileOptions
     */
    public function getOptions()
    {
        return $this->get(self::OPTIONS);
    }

    /**
     * Sets value of 'source_code_info' property
     *
     * @param SourceCodeInfo $value Property value
     *
     * @return null
     */
    public function setSourceCodeInfo(SourceCodeInfo $value)
    {
        return $this->set(self::SOURCE_CODE_INFO, $value);
    }

    /**
     * Returns value of 'source_code_info' property
     *
     * @return SourceCodeInfo
     */
    public function getSourceCodeInfo()
    {
        return $this->get(self::SOURCE_CODE_INFO);
    }

    /**
     * Sets value of 'syntax' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setSyntax($value)
    {
        return $this->set(self::SYNTAX, $value);
    }

    /**
     * Returns value of 'syntax' property
     *
     * @return string
     */
    public function getSyntax()
    {
        return $this->get(self::SYNTAX);
    }
}

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
     * @param int $value Property value
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
     * @return int
     */
    public function getStart()
    {
        return $this->get(self::START);
    }

    /**
     * Sets value of 'end' property
     *
     * @param int $value Property value
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
     * @return int
     */
    public function getEnd()
    {
        return $this->get(self::END);
    }
}

/**
 * ReservedRange message embedded in DescriptorProto message
 */
class DescriptorProto_ReservedRange extends \ProtobufMessage
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
     * @param int $value Property value
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
     * @return int
     */
    public function getStart()
    {
        return $this->get(self::START);
    }

    /**
     * Sets value of 'end' property
     *
     * @param int $value Property value
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
     * @return int
     */
    public function getEnd()
    {
        return $this->get(self::END);
    }
}

/**
 * DescriptorProto message
 */
class DescriptorProto extends \ProtobufMessage
{
    /* Field index constants */
    const NAME = 1;
    const FIELD = 2;
    const EXTENSION = 6;
    const NESTED_TYPE = 3;
    const ENUM_TYPE = 4;
    const EXTENSION_RANGE = 5;
    const ONEOF_DECL = 8;
    const OPTIONS = 7;
    const RESERVED_RANGE = 9;
    const RESERVED_NAME = 10;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => 7,
        ),
        self::FIELD => array(
            'name' => 'field',
            'repeated' => true,
            'type' => 'FieldDescriptorProto'
        ),
        self::EXTENSION => array(
            'name' => 'extension',
            'repeated' => true,
            'type' => 'FieldDescriptorProto'
        ),
        self::NESTED_TYPE => array(
            'name' => 'nested_type',
            'repeated' => true,
            'type' => 'DescriptorProto'
        ),
        self::ENUM_TYPE => array(
            'name' => 'enum_type',
            'repeated' => true,
            'type' => 'EnumDescriptorProto'
        ),
        self::EXTENSION_RANGE => array(
            'name' => 'extension_range',
            'repeated' => true,
            'type' => 'DescriptorProto_ExtensionRange'
        ),
        self::ONEOF_DECL => array(
            'name' => 'oneof_decl',
            'repeated' => true,
            'type' => 'OneofDescriptorProto'
        ),
        self::OPTIONS => array(
            'name' => 'options',
            'required' => false,
            'type' => 'MessageOptions'
        ),
        self::RESERVED_RANGE => array(
            'name' => 'reserved_range',
            'repeated' => true,
            'type' => 'DescriptorProto_ReservedRange'
        ),
        self::RESERVED_NAME => array(
            'name' => 'reserved_name',
            'repeated' => true,
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
        $this->values[self::FIELD] = array();
        $this->values[self::EXTENSION] = array();
        $this->values[self::NESTED_TYPE] = array();
        $this->values[self::ENUM_TYPE] = array();
        $this->values[self::EXTENSION_RANGE] = array();
        $this->values[self::ONEOF_DECL] = array();
        $this->values[self::OPTIONS] = null;
        $this->values[self::RESERVED_RANGE] = array();
        $this->values[self::RESERVED_NAME] = array();
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
     * Appends value to 'field' list
     *
     * @param FieldDescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendField(FieldDescriptorProto $value)
    {
        return $this->append(self::FIELD, $value);
    }

    /**
     * Clears 'field' list
     *
     * @return null
     */
    public function clearField()
    {
        return $this->clear(self::FIELD);
    }

    /**
     * Returns 'field' list
     *
     * @return FieldDescriptorProto[]
     */
    public function getField()
    {
        return $this->get(self::FIELD);
    }

    /**
     * Returns 'field' iterator
     *
     * @return ArrayIterator
     */
    public function getFieldIterator()
    {
        return new \ArrayIterator($this->get(self::FIELD));
    }

    /**
     * Returns element from 'field' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return FieldDescriptorProto
     */
    public function getFieldAt($offset)
    {
        return $this->get(self::FIELD, $offset);
    }

    /**
     * Returns count of 'field' list
     *
     * @return int
     */
    public function getFieldCount()
    {
        return $this->count(self::FIELD);
    }

    /**
     * Appends value to 'extension' list
     *
     * @param FieldDescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendExtension(FieldDescriptorProto $value)
    {
        return $this->append(self::EXTENSION, $value);
    }

    /**
     * Clears 'extension' list
     *
     * @return null
     */
    public function clearExtension()
    {
        return $this->clear(self::EXTENSION);
    }

    /**
     * Returns 'extension' list
     *
     * @return FieldDescriptorProto[]
     */
    public function getExtension()
    {
        return $this->get(self::EXTENSION);
    }

    /**
     * Returns 'extension' iterator
     *
     * @return ArrayIterator
     */
    public function getExtensionIterator()
    {
        return new \ArrayIterator($this->get(self::EXTENSION));
    }

    /**
     * Returns element from 'extension' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return FieldDescriptorProto
     */
    public function getExtensionAt($offset)
    {
        return $this->get(self::EXTENSION, $offset);
    }

    /**
     * Returns count of 'extension' list
     *
     * @return int
     */
    public function getExtensionCount()
    {
        return $this->count(self::EXTENSION);
    }

    /**
     * Appends value to 'nested_type' list
     *
     * @param DescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendNestedType(DescriptorProto $value)
    {
        return $this->append(self::NESTED_TYPE, $value);
    }

    /**
     * Clears 'nested_type' list
     *
     * @return null
     */
    public function clearNestedType()
    {
        return $this->clear(self::NESTED_TYPE);
    }

    /**
     * Returns 'nested_type' list
     *
     * @return DescriptorProto[]
     */
    public function getNestedType()
    {
        return $this->get(self::NESTED_TYPE);
    }

    /**
     * Returns 'nested_type' iterator
     *
     * @return ArrayIterator
     */
    public function getNestedTypeIterator()
    {
        return new \ArrayIterator($this->get(self::NESTED_TYPE));
    }

    /**
     * Returns element from 'nested_type' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return DescriptorProto
     */
    public function getNestedTypeAt($offset)
    {
        return $this->get(self::NESTED_TYPE, $offset);
    }

    /**
     * Returns count of 'nested_type' list
     *
     * @return int
     */
    public function getNestedTypeCount()
    {
        return $this->count(self::NESTED_TYPE);
    }

    /**
     * Appends value to 'enum_type' list
     *
     * @param EnumDescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendEnumType(EnumDescriptorProto $value)
    {
        return $this->append(self::ENUM_TYPE, $value);
    }

    /**
     * Clears 'enum_type' list
     *
     * @return null
     */
    public function clearEnumType()
    {
        return $this->clear(self::ENUM_TYPE);
    }

    /**
     * Returns 'enum_type' list
     *
     * @return EnumDescriptorProto[]
     */
    public function getEnumType()
    {
        return $this->get(self::ENUM_TYPE);
    }

    /**
     * Returns 'enum_type' iterator
     *
     * @return ArrayIterator
     */
    public function getEnumTypeIterator()
    {
        return new \ArrayIterator($this->get(self::ENUM_TYPE));
    }

    /**
     * Returns element from 'enum_type' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return EnumDescriptorProto
     */
    public function getEnumTypeAt($offset)
    {
        return $this->get(self::ENUM_TYPE, $offset);
    }

    /**
     * Returns count of 'enum_type' list
     *
     * @return int
     */
    public function getEnumTypeCount()
    {
        return $this->count(self::ENUM_TYPE);
    }

    /**
     * Appends value to 'extension_range' list
     *
     * @param DescriptorProto_ExtensionRange $value Value to append
     *
     * @return null
     */
    public function appendExtensionRange(DescriptorProto_ExtensionRange $value)
    {
        return $this->append(self::EXTENSION_RANGE, $value);
    }

    /**
     * Clears 'extension_range' list
     *
     * @return null
     */
    public function clearExtensionRange()
    {
        return $this->clear(self::EXTENSION_RANGE);
    }

    /**
     * Returns 'extension_range' list
     *
     * @return DescriptorProto_ExtensionRange[]
     */
    public function getExtensionRange()
    {
        return $this->get(self::EXTENSION_RANGE);
    }

    /**
     * Returns 'extension_range' iterator
     *
     * @return ArrayIterator
     */
    public function getExtensionRangeIterator()
    {
        return new \ArrayIterator($this->get(self::EXTENSION_RANGE));
    }

    /**
     * Returns element from 'extension_range' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return DescriptorProto_ExtensionRange
     */
    public function getExtensionRangeAt($offset)
    {
        return $this->get(self::EXTENSION_RANGE, $offset);
    }

    /**
     * Returns count of 'extension_range' list
     *
     * @return int
     */
    public function getExtensionRangeCount()
    {
        return $this->count(self::EXTENSION_RANGE);
    }

    /**
     * Appends value to 'oneof_decl' list
     *
     * @param OneofDescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendOneofDecl(OneofDescriptorProto $value)
    {
        return $this->append(self::ONEOF_DECL, $value);
    }

    /**
     * Clears 'oneof_decl' list
     *
     * @return null
     */
    public function clearOneofDecl()
    {
        return $this->clear(self::ONEOF_DECL);
    }

    /**
     * Returns 'oneof_decl' list
     *
     * @return OneofDescriptorProto[]
     */
    public function getOneofDecl()
    {
        return $this->get(self::ONEOF_DECL);
    }

    /**
     * Returns 'oneof_decl' iterator
     *
     * @return ArrayIterator
     */
    public function getOneofDeclIterator()
    {
        return new \ArrayIterator($this->get(self::ONEOF_DECL));
    }

    /**
     * Returns element from 'oneof_decl' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return OneofDescriptorProto
     */
    public function getOneofDeclAt($offset)
    {
        return $this->get(self::ONEOF_DECL, $offset);
    }

    /**
     * Returns count of 'oneof_decl' list
     *
     * @return int
     */
    public function getOneofDeclCount()
    {
        return $this->count(self::ONEOF_DECL);
    }

    /**
     * Sets value of 'options' property
     *
     * @param MessageOptions $value Property value
     *
     * @return null
     */
    public function setOptions(MessageOptions $value)
    {
        return $this->set(self::OPTIONS, $value);
    }

    /**
     * Returns value of 'options' property
     *
     * @return MessageOptions
     */
    public function getOptions()
    {
        return $this->get(self::OPTIONS);
    }

    /**
     * Appends value to 'reserved_range' list
     *
     * @param DescriptorProto_ReservedRange $value Value to append
     *
     * @return null
     */
    public function appendReservedRange(DescriptorProto_ReservedRange $value)
    {
        return $this->append(self::RESERVED_RANGE, $value);
    }

    /**
     * Clears 'reserved_range' list
     *
     * @return null
     */
    public function clearReservedRange()
    {
        return $this->clear(self::RESERVED_RANGE);
    }

    /**
     * Returns 'reserved_range' list
     *
     * @return DescriptorProto_ReservedRange[]
     */
    public function getReservedRange()
    {
        return $this->get(self::RESERVED_RANGE);
    }

    /**
     * Returns 'reserved_range' iterator
     *
     * @return ArrayIterator
     */
    public function getReservedRangeIterator()
    {
        return new \ArrayIterator($this->get(self::RESERVED_RANGE));
    }

    /**
     * Returns element from 'reserved_range' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return DescriptorProto_ReservedRange
     */
    public function getReservedRangeAt($offset)
    {
        return $this->get(self::RESERVED_RANGE, $offset);
    }

    /**
     * Returns count of 'reserved_range' list
     *
     * @return int
     */
    public function getReservedRangeCount()
    {
        return $this->count(self::RESERVED_RANGE);
    }

    /**
     * Appends value to 'reserved_name' list
     *
     * @param string $value Value to append
     *
     * @return null
     */
    public function appendReservedName($value)
    {
        return $this->append(self::RESERVED_NAME, $value);
    }

    /**
     * Clears 'reserved_name' list
     *
     * @return null
     */
    public function clearReservedName()
    {
        return $this->clear(self::RESERVED_NAME);
    }

    /**
     * Returns 'reserved_name' list
     *
     * @return string[]
     */
    public function getReservedName()
    {
        return $this->get(self::RESERVED_NAME);
    }

    /**
     * Returns 'reserved_name' iterator
     *
     * @return ArrayIterator
     */
    public function getReservedNameIterator()
    {
        return new \ArrayIterator($this->get(self::RESERVED_NAME));
    }

    /**
     * Returns element from 'reserved_name' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return string
     */
    public function getReservedNameAt($offset)
    {
        return $this->get(self::RESERVED_NAME, $offset);
    }

    /**
     * Returns count of 'reserved_name' list
     *
     * @return int
     */
    public function getReservedNameCount()
    {
        return $this->count(self::RESERVED_NAME);
    }
}

/**
 * Type enum embedded in FieldDescriptorProto message
 */
final class FieldDescriptorProto_Type
{
    const TYPE_DOUBLE = 1;
    const TYPE_FLOAT = 2;
    const TYPE_INT64 = 3;
    const TYPE_UINT64 = 4;
    const TYPE_INT32 = 5;
    const TYPE_FIXED64 = 6;
    const TYPE_FIXED32 = 7;
    const TYPE_BOOL = 8;
    const TYPE_STRING = 9;
    const TYPE_GROUP = 10;
    const TYPE_MESSAGE = 11;
    const TYPE_BYTES = 12;
    const TYPE_UINT32 = 13;
    const TYPE_ENUM = 14;
    const TYPE_SFIXED32 = 15;
    const TYPE_SFIXED64 = 16;
    const TYPE_SINT32 = 17;
    const TYPE_SINT64 = 18;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'TYPE_DOUBLE' => self::TYPE_DOUBLE,
            'TYPE_FLOAT' => self::TYPE_FLOAT,
            'TYPE_INT64' => self::TYPE_INT64,
            'TYPE_UINT64' => self::TYPE_UINT64,
            'TYPE_INT32' => self::TYPE_INT32,
            'TYPE_FIXED64' => self::TYPE_FIXED64,
            'TYPE_FIXED32' => self::TYPE_FIXED32,
            'TYPE_BOOL' => self::TYPE_BOOL,
            'TYPE_STRING' => self::TYPE_STRING,
            'TYPE_GROUP' => self::TYPE_GROUP,
            'TYPE_MESSAGE' => self::TYPE_MESSAGE,
            'TYPE_BYTES' => self::TYPE_BYTES,
            'TYPE_UINT32' => self::TYPE_UINT32,
            'TYPE_ENUM' => self::TYPE_ENUM,
            'TYPE_SFIXED32' => self::TYPE_SFIXED32,
            'TYPE_SFIXED64' => self::TYPE_SFIXED64,
            'TYPE_SINT32' => self::TYPE_SINT32,
            'TYPE_SINT64' => self::TYPE_SINT64,
        );
    }
}

/**
 * Label enum embedded in FieldDescriptorProto message
 */
final class FieldDescriptorProto_Label
{
    const LABEL_OPTIONAL = 1;
    const LABEL_REQUIRED = 2;
    const LABEL_REPEATED = 3;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'LABEL_OPTIONAL' => self::LABEL_OPTIONAL,
            'LABEL_REQUIRED' => self::LABEL_REQUIRED,
            'LABEL_REPEATED' => self::LABEL_REPEATED,
        );
    }
}

/**
 * FieldDescriptorProto message
 */
class FieldDescriptorProto extends \ProtobufMessage
{
    /* Field index constants */
    const NAME = 1;
    const NUMBER = 3;
    const LABEL = 4;
    const TYPE = 5;
    const TYPE_NAME = 6;
    const EXTENDEE = 2;
    const DEFAULT_VALUE = 7;
    const ONEOF_INDEX = 9;
    const JSON_NAME = 10;
    const OPTIONS = 8;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => 7,
        ),
        self::NUMBER => array(
            'name' => 'number',
            'required' => false,
            'type' => 5,
        ),
        self::LABEL => array(
            'name' => 'label',
            'required' => false,
            'type' => 5,
        ),
        self::TYPE => array(
            'name' => 'type',
            'required' => false,
            'type' => 5,
        ),
        self::TYPE_NAME => array(
            'name' => 'type_name',
            'required' => false,
            'type' => 7,
        ),
        self::EXTENDEE => array(
            'name' => 'extendee',
            'required' => false,
            'type' => 7,
        ),
        self::DEFAULT_VALUE => array(
            'name' => 'default_value',
            'required' => false,
            'type' => 7,
        ),
        self::ONEOF_INDEX => array(
            'name' => 'oneof_index',
            'required' => false,
            'type' => 5,
        ),
        self::JSON_NAME => array(
            'name' => 'json_name',
            'required' => false,
            'type' => 7,
        ),
        self::OPTIONS => array(
            'name' => 'options',
            'required' => false,
            'type' => 'FieldOptions'
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
        $this->values[self::NUMBER] = null;
        $this->values[self::LABEL] = null;
        $this->values[self::TYPE] = null;
        $this->values[self::TYPE_NAME] = null;
        $this->values[self::EXTENDEE] = null;
        $this->values[self::DEFAULT_VALUE] = null;
        $this->values[self::ONEOF_INDEX] = null;
        $this->values[self::JSON_NAME] = null;
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
     * Sets value of 'number' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setNumber($value)
    {
        return $this->set(self::NUMBER, $value);
    }

    /**
     * Returns value of 'number' property
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->get(self::NUMBER);
    }

    /**
     * Sets value of 'label' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setLabel($value)
    {
        return $this->set(self::LABEL, $value);
    }

    /**
     * Returns value of 'label' property
     *
     * @return int
     */
    public function getLabel()
    {
        return $this->get(self::LABEL);
    }

    /**
     * Sets value of 'type' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setType($value)
    {
        return $this->set(self::TYPE, $value);
    }

    /**
     * Returns value of 'type' property
     *
     * @return int
     */
    public function getType()
    {
        return $this->get(self::TYPE);
    }

    /**
     * Sets value of 'type_name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setTypeName($value)
    {
        return $this->set(self::TYPE_NAME, $value);
    }

    /**
     * Returns value of 'type_name' property
     *
     * @return string
     */
    public function getTypeName()
    {
        return $this->get(self::TYPE_NAME);
    }

    /**
     * Sets value of 'extendee' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setExtendee($value)
    {
        return $this->set(self::EXTENDEE, $value);
    }

    /**
     * Returns value of 'extendee' property
     *
     * @return string
     */
    public function getExtendee()
    {
        return $this->get(self::EXTENDEE);
    }

    /**
     * Sets value of 'default_value' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setDefaultValue($value)
    {
        return $this->set(self::DEFAULT_VALUE, $value);
    }

    /**
     * Returns value of 'default_value' property
     *
     * @return string
     */
    public function getDefaultValue()
    {
        return $this->get(self::DEFAULT_VALUE);
    }

    /**
     * Sets value of 'oneof_index' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setOneofIndex($value)
    {
        return $this->set(self::ONEOF_INDEX, $value);
    }

    /**
     * Returns value of 'oneof_index' property
     *
     * @return int
     */
    public function getOneofIndex()
    {
        return $this->get(self::ONEOF_INDEX);
    }

    /**
     * Sets value of 'json_name' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setJsonName($value)
    {
        return $this->set(self::JSON_NAME, $value);
    }

    /**
     * Returns value of 'json_name' property
     *
     * @return string
     */
    public function getJsonName()
    {
        return $this->get(self::JSON_NAME);
    }

    /**
     * Sets value of 'options' property
     *
     * @param FieldOptions $value Property value
     *
     * @return null
     */
    public function setOptions(FieldOptions $value)
    {
        return $this->set(self::OPTIONS, $value);
    }

    /**
     * Returns value of 'options' property
     *
     * @return FieldOptions
     */
    public function getOptions()
    {
        return $this->get(self::OPTIONS);
    }
}

/**
 * OneofDescriptorProto message
 */
class OneofDescriptorProto extends \ProtobufMessage
{
    /* Field index constants */
    const NAME = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NAME => array(
            'name' => 'name',
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
}

/**
 * EnumDescriptorProto message
 */
class EnumDescriptorProto extends \ProtobufMessage
{
    /* Field index constants */
    const NAME = 1;
    const VALUE = 2;
    const OPTIONS = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => 7,
        ),
        self::VALUE => array(
            'name' => 'value',
            'repeated' => true,
            'type' => 'EnumValueDescriptorProto'
        ),
        self::OPTIONS => array(
            'name' => 'options',
            'required' => false,
            'type' => 'EnumOptions'
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
        $this->values[self::VALUE] = array();
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
     * Appends value to 'value' list
     *
     * @param EnumValueDescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendValue(EnumValueDescriptorProto $value)
    {
        return $this->append(self::VALUE, $value);
    }

    /**
     * Clears 'value' list
     *
     * @return null
     */
    public function clearValue()
    {
        return $this->clear(self::VALUE);
    }

    /**
     * Returns 'value' list
     *
     * @return EnumValueDescriptorProto[]
     */
    public function getValue()
    {
        return $this->get(self::VALUE);
    }

    /**
     * Returns 'value' iterator
     *
     * @return ArrayIterator
     */
    public function getValueIterator()
    {
        return new \ArrayIterator($this->get(self::VALUE));
    }

    /**
     * Returns element from 'value' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return EnumValueDescriptorProto
     */
    public function getValueAt($offset)
    {
        return $this->get(self::VALUE, $offset);
    }

    /**
     * Returns count of 'value' list
     *
     * @return int
     */
    public function getValueCount()
    {
        return $this->count(self::VALUE);
    }

    /**
     * Sets value of 'options' property
     *
     * @param EnumOptions $value Property value
     *
     * @return null
     */
    public function setOptions(EnumOptions $value)
    {
        return $this->set(self::OPTIONS, $value);
    }

    /**
     * Returns value of 'options' property
     *
     * @return EnumOptions
     */
    public function getOptions()
    {
        return $this->get(self::OPTIONS);
    }
}

/**
 * EnumValueDescriptorProto message
 */
class EnumValueDescriptorProto extends \ProtobufMessage
{
    /* Field index constants */
    const NAME = 1;
    const NUMBER = 2;
    const OPTIONS = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NAME => array(
            'name' => 'name',
            'required' => false,
            'type' => 7,
        ),
        self::NUMBER => array(
            'name' => 'number',
            'required' => false,
            'type' => 5,
        ),
        self::OPTIONS => array(
            'name' => 'options',
            'required' => false,
            'type' => 'EnumValueOptions'
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
        $this->values[self::NUMBER] = null;
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
     * Sets value of 'number' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setNumber($value)
    {
        return $this->set(self::NUMBER, $value);
    }

    /**
     * Returns value of 'number' property
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->get(self::NUMBER);
    }

    /**
     * Sets value of 'options' property
     *
     * @param EnumValueOptions $value Property value
     *
     * @return null
     */
    public function setOptions(EnumValueOptions $value)
    {
        return $this->set(self::OPTIONS, $value);
    }

    /**
     * Returns value of 'options' property
     *
     * @return EnumValueOptions
     */
    public function getOptions()
    {
        return $this->get(self::OPTIONS);
    }
}

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
            'type' => 7,
        ),
        self::METHOD => array(
            'name' => 'method',
            'repeated' => true,
            'type' => 'MethodDescriptorProto'
        ),
        self::OPTIONS => array(
            'name' => 'options',
            'required' => false,
            'type' => 'ServiceOptions'
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
     * @param MethodDescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendMethod(MethodDescriptorProto $value)
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
     * @return MethodDescriptorProto[]
     */
    public function getMethod()
    {
        return $this->get(self::METHOD);
    }

    /**
     * Returns 'method' iterator
     *
     * @return ArrayIterator
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
     * @return MethodDescriptorProto
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
     * @param ServiceOptions $value Property value
     *
     * @return null
     */
    public function setOptions(ServiceOptions $value)
    {
        return $this->set(self::OPTIONS, $value);
    }

    /**
     * Returns value of 'options' property
     *
     * @return ServiceOptions
     */
    public function getOptions()
    {
        return $this->get(self::OPTIONS);
    }
}

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
            'type' => 7,
        ),
        self::INPUT_TYPE => array(
            'name' => 'input_type',
            'required' => false,
            'type' => 7,
        ),
        self::OUTPUT_TYPE => array(
            'name' => 'output_type',
            'required' => false,
            'type' => 7,
        ),
        self::OPTIONS => array(
            'name' => 'options',
            'required' => false,
            'type' => 'MethodOptions'
        ),
        self::CLIENT_STREAMING => array(
            'default' => false, 
            'name' => 'client_streaming',
            'required' => false,
            'type' => 8,
        ),
        self::SERVER_STREAMING => array(
            'default' => false, 
            'name' => 'server_streaming',
            'required' => false,
            'type' => 8,
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
        $this->values[self::INPUT_TYPE] = null;
        $this->values[self::OUTPUT_TYPE] = null;
        $this->values[self::OPTIONS] = null;
        $this->values[self::CLIENT_STREAMING] = false;
        $this->values[self::SERVER_STREAMING] = false;
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
        return $this->get(self::INPUT_TYPE);
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
        return $this->get(self::OUTPUT_TYPE);
    }

    /**
     * Sets value of 'options' property
     *
     * @param MethodOptions $value Property value
     *
     * @return null
     */
    public function setOptions(MethodOptions $value)
    {
        return $this->set(self::OPTIONS, $value);
    }

    /**
     * Returns value of 'options' property
     *
     * @return MethodOptions
     */
    public function getOptions()
    {
        return $this->get(self::OPTIONS);
    }

    /**
     * Sets value of 'client_streaming' property
     *
     * @param bool $value Property value
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
     * @return bool
     */
    public function getClientStreaming()
    {
        return $this->get(self::CLIENT_STREAMING);
    }

    /**
     * Sets value of 'server_streaming' property
     *
     * @param bool $value Property value
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
     * @return bool
     */
    public function getServerStreaming()
    {
        return $this->get(self::SERVER_STREAMING);
    }
}

/**
 * OptimizeMode enum embedded in FileOptions message
 */
final class FileOptions_OptimizeMode
{
    const SPEED = 1;
    const CODE_SIZE = 2;
    const LITE_RUNTIME = 3;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'SPEED' => self::SPEED,
            'CODE_SIZE' => self::CODE_SIZE,
            'LITE_RUNTIME' => self::LITE_RUNTIME,
        );
    }
}

/**
 * FileOptions message
 */
class FileOptions extends \ProtobufMessage
{
    /* Field index constants */
    const JAVA_PACKAGE = 1;
    const JAVA_OUTER_CLASSNAME = 8;
    const JAVA_MULTIPLE_FILES = 10;
    const JAVA_GENERATE_EQUALS_AND_HASH = 20;
    const JAVA_STRING_CHECK_UTF8 = 27;
    const OPTIMIZE_FOR = 9;
    const GO_PACKAGE = 11;
    const CC_GENERIC_SERVICES = 16;
    const JAVA_GENERIC_SERVICES = 17;
    const PY_GENERIC_SERVICES = 18;
    const DEPRECATED = 23;
    const CC_ENABLE_ARENAS = 31;
    const OBJC_CLASS_PREFIX = 36;
    const CSHARP_NAMESPACE = 37;
    const UNINTERPRETED_OPTION = 999;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::JAVA_PACKAGE => array(
            'name' => 'java_package',
            'required' => false,
            'type' => 7,
        ),
        self::JAVA_OUTER_CLASSNAME => array(
            'name' => 'java_outer_classname',
            'required' => false,
            'type' => 7,
        ),
        self::JAVA_MULTIPLE_FILES => array(
            'default' => false, 
            'name' => 'java_multiple_files',
            'required' => false,
            'type' => 8,
        ),
        self::JAVA_GENERATE_EQUALS_AND_HASH => array(
            'default' => false, 
            'name' => 'java_generate_equals_and_hash',
            'required' => false,
            'type' => 8,
        ),
        self::JAVA_STRING_CHECK_UTF8 => array(
            'default' => false, 
            'name' => 'java_string_check_utf8',
            'required' => false,
            'type' => 8,
        ),
        self::OPTIMIZE_FOR => array(
            'default' => FileOptions_OptimizeMode::SPEED, 
            'name' => 'optimize_for',
            'required' => false,
            'type' => 5,
        ),
        self::GO_PACKAGE => array(
            'name' => 'go_package',
            'required' => false,
            'type' => 7,
        ),
        self::CC_GENERIC_SERVICES => array(
            'default' => false, 
            'name' => 'cc_generic_services',
            'required' => false,
            'type' => 8,
        ),
        self::JAVA_GENERIC_SERVICES => array(
            'default' => false, 
            'name' => 'java_generic_services',
            'required' => false,
            'type' => 8,
        ),
        self::PY_GENERIC_SERVICES => array(
            'default' => false, 
            'name' => 'py_generic_services',
            'required' => false,
            'type' => 8,
        ),
        self::DEPRECATED => array(
            'default' => false, 
            'name' => 'deprecated',
            'required' => false,
            'type' => 8,
        ),
        self::CC_ENABLE_ARENAS => array(
            'default' => false, 
            'name' => 'cc_enable_arenas',
            'required' => false,
            'type' => 8,
        ),
        self::OBJC_CLASS_PREFIX => array(
            'name' => 'objc_class_prefix',
            'required' => false,
            'type' => 7,
        ),
        self::CSHARP_NAMESPACE => array(
            'name' => 'csharp_namespace',
            'required' => false,
            'type' => 7,
        ),
        self::UNINTERPRETED_OPTION => array(
            'name' => 'uninterpreted_option',
            'repeated' => true,
            'type' => 'UninterpretedOption'
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
        $this->values[self::JAVA_PACKAGE] = null;
        $this->values[self::JAVA_OUTER_CLASSNAME] = null;
        $this->values[self::JAVA_MULTIPLE_FILES] = false;
        $this->values[self::JAVA_GENERATE_EQUALS_AND_HASH] = false;
        $this->values[self::JAVA_STRING_CHECK_UTF8] = false;
        $this->values[self::OPTIMIZE_FOR] = FileOptions_OptimizeMode::SPEED;
        $this->values[self::GO_PACKAGE] = null;
        $this->values[self::CC_GENERIC_SERVICES] = false;
        $this->values[self::JAVA_GENERIC_SERVICES] = false;
        $this->values[self::PY_GENERIC_SERVICES] = false;
        $this->values[self::DEPRECATED] = false;
        $this->values[self::CC_ENABLE_ARENAS] = false;
        $this->values[self::OBJC_CLASS_PREFIX] = null;
        $this->values[self::CSHARP_NAMESPACE] = null;
        $this->values[self::UNINTERPRETED_OPTION] = array();
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
     * Sets value of 'java_package' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setJavaPackage($value)
    {
        return $this->set(self::JAVA_PACKAGE, $value);
    }

    /**
     * Returns value of 'java_package' property
     *
     * @return string
     */
    public function getJavaPackage()
    {
        return $this->get(self::JAVA_PACKAGE);
    }

    /**
     * Sets value of 'java_outer_classname' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setJavaOuterClassname($value)
    {
        return $this->set(self::JAVA_OUTER_CLASSNAME, $value);
    }

    /**
     * Returns value of 'java_outer_classname' property
     *
     * @return string
     */
    public function getJavaOuterClassname()
    {
        return $this->get(self::JAVA_OUTER_CLASSNAME);
    }

    /**
     * Sets value of 'java_multiple_files' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setJavaMultipleFiles($value)
    {
        return $this->set(self::JAVA_MULTIPLE_FILES, $value);
    }

    /**
     * Returns value of 'java_multiple_files' property
     *
     * @return bool
     */
    public function getJavaMultipleFiles()
    {
        return $this->get(self::JAVA_MULTIPLE_FILES);
    }

    /**
     * Sets value of 'java_generate_equals_and_hash' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setJavaGenerateEqualsAndHash($value)
    {
        return $this->set(self::JAVA_GENERATE_EQUALS_AND_HASH, $value);
    }

    /**
     * Returns value of 'java_generate_equals_and_hash' property
     *
     * @return bool
     */
    public function getJavaGenerateEqualsAndHash()
    {
        return $this->get(self::JAVA_GENERATE_EQUALS_AND_HASH);
    }

    /**
     * Sets value of 'java_string_check_utf8' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setJavaStringCheckUtf8($value)
    {
        return $this->set(self::JAVA_STRING_CHECK_UTF8, $value);
    }

    /**
     * Returns value of 'java_string_check_utf8' property
     *
     * @return bool
     */
    public function getJavaStringCheckUtf8()
    {
        return $this->get(self::JAVA_STRING_CHECK_UTF8);
    }

    /**
     * Sets value of 'optimize_for' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setOptimizeFor($value)
    {
        return $this->set(self::OPTIMIZE_FOR, $value);
    }

    /**
     * Returns value of 'optimize_for' property
     *
     * @return int
     */
    public function getOptimizeFor()
    {
        return $this->get(self::OPTIMIZE_FOR);
    }

    /**
     * Sets value of 'go_package' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setGoPackage($value)
    {
        return $this->set(self::GO_PACKAGE, $value);
    }

    /**
     * Returns value of 'go_package' property
     *
     * @return string
     */
    public function getGoPackage()
    {
        return $this->get(self::GO_PACKAGE);
    }

    /**
     * Sets value of 'cc_generic_services' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setCcGenericServices($value)
    {
        return $this->set(self::CC_GENERIC_SERVICES, $value);
    }

    /**
     * Returns value of 'cc_generic_services' property
     *
     * @return bool
     */
    public function getCcGenericServices()
    {
        return $this->get(self::CC_GENERIC_SERVICES);
    }

    /**
     * Sets value of 'java_generic_services' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setJavaGenericServices($value)
    {
        return $this->set(self::JAVA_GENERIC_SERVICES, $value);
    }

    /**
     * Returns value of 'java_generic_services' property
     *
     * @return bool
     */
    public function getJavaGenericServices()
    {
        return $this->get(self::JAVA_GENERIC_SERVICES);
    }

    /**
     * Sets value of 'py_generic_services' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setPyGenericServices($value)
    {
        return $this->set(self::PY_GENERIC_SERVICES, $value);
    }

    /**
     * Returns value of 'py_generic_services' property
     *
     * @return bool
     */
    public function getPyGenericServices()
    {
        return $this->get(self::PY_GENERIC_SERVICES);
    }

    /**
     * Sets value of 'deprecated' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setDeprecated($value)
    {
        return $this->set(self::DEPRECATED, $value);
    }

    /**
     * Returns value of 'deprecated' property
     *
     * @return bool
     */
    public function getDeprecated()
    {
        return $this->get(self::DEPRECATED);
    }

    /**
     * Sets value of 'cc_enable_arenas' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setCcEnableArenas($value)
    {
        return $this->set(self::CC_ENABLE_ARENAS, $value);
    }

    /**
     * Returns value of 'cc_enable_arenas' property
     *
     * @return bool
     */
    public function getCcEnableArenas()
    {
        return $this->get(self::CC_ENABLE_ARENAS);
    }

    /**
     * Sets value of 'objc_class_prefix' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setObjcClassPrefix($value)
    {
        return $this->set(self::OBJC_CLASS_PREFIX, $value);
    }

    /**
     * Returns value of 'objc_class_prefix' property
     *
     * @return string
     */
    public function getObjcClassPrefix()
    {
        return $this->get(self::OBJC_CLASS_PREFIX);
    }

    /**
     * Sets value of 'csharp_namespace' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setCsharpNamespace($value)
    {
        return $this->set(self::CSHARP_NAMESPACE, $value);
    }

    /**
     * Returns value of 'csharp_namespace' property
     *
     * @return string
     */
    public function getCsharpNamespace()
    {
        return $this->get(self::CSHARP_NAMESPACE);
    }

    /**
     * Appends value to 'uninterpreted_option' list
     *
     * @param UninterpretedOption $value Value to append
     *
     * @return null
     */
    public function appendUninterpretedOption(UninterpretedOption $value)
    {
        return $this->append(self::UNINTERPRETED_OPTION, $value);
    }

    /**
     * Clears 'uninterpreted_option' list
     *
     * @return null
     */
    public function clearUninterpretedOption()
    {
        return $this->clear(self::UNINTERPRETED_OPTION);
    }

    /**
     * Returns 'uninterpreted_option' list
     *
     * @return UninterpretedOption[]
     */
    public function getUninterpretedOption()
    {
        return $this->get(self::UNINTERPRETED_OPTION);
    }

    /**
     * Returns 'uninterpreted_option' iterator
     *
     * @return ArrayIterator
     */
    public function getUninterpretedOptionIterator()
    {
        return new \ArrayIterator($this->get(self::UNINTERPRETED_OPTION));
    }

    /**
     * Returns element from 'uninterpreted_option' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return UninterpretedOption
     */
    public function getUninterpretedOptionAt($offset)
    {
        return $this->get(self::UNINTERPRETED_OPTION, $offset);
    }

    /**
     * Returns count of 'uninterpreted_option' list
     *
     * @return int
     */
    public function getUninterpretedOptionCount()
    {
        return $this->count(self::UNINTERPRETED_OPTION);
    }
}

/**
 * MessageOptions message
 */
class MessageOptions extends \ProtobufMessage
{
    /* Field index constants */
    const MESSAGE_SET_WIRE_FORMAT = 1;
    const NO_STANDARD_DESCRIPTOR_ACCESSOR = 2;
    const DEPRECATED = 3;
    const MAP_ENTRY = 7;
    const UNINTERPRETED_OPTION = 999;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::MESSAGE_SET_WIRE_FORMAT => array(
            'default' => false, 
            'name' => 'message_set_wire_format',
            'required' => false,
            'type' => 8,
        ),
        self::NO_STANDARD_DESCRIPTOR_ACCESSOR => array(
            'default' => false, 
            'name' => 'no_standard_descriptor_accessor',
            'required' => false,
            'type' => 8,
        ),
        self::DEPRECATED => array(
            'default' => false, 
            'name' => 'deprecated',
            'required' => false,
            'type' => 8,
        ),
        self::MAP_ENTRY => array(
            'name' => 'map_entry',
            'required' => false,
            'type' => 8,
        ),
        self::UNINTERPRETED_OPTION => array(
            'name' => 'uninterpreted_option',
            'repeated' => true,
            'type' => 'UninterpretedOption'
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
        $this->values[self::MESSAGE_SET_WIRE_FORMAT] = false;
        $this->values[self::NO_STANDARD_DESCRIPTOR_ACCESSOR] = false;
        $this->values[self::DEPRECATED] = false;
        $this->values[self::MAP_ENTRY] = null;
        $this->values[self::UNINTERPRETED_OPTION] = array();
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
     * Sets value of 'message_set_wire_format' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setMessageSetWireFormat($value)
    {
        return $this->set(self::MESSAGE_SET_WIRE_FORMAT, $value);
    }

    /**
     * Returns value of 'message_set_wire_format' property
     *
     * @return bool
     */
    public function getMessageSetWireFormat()
    {
        return $this->get(self::MESSAGE_SET_WIRE_FORMAT);
    }

    /**
     * Sets value of 'no_standard_descriptor_accessor' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setNoStandardDescriptorAccessor($value)
    {
        return $this->set(self::NO_STANDARD_DESCRIPTOR_ACCESSOR, $value);
    }

    /**
     * Returns value of 'no_standard_descriptor_accessor' property
     *
     * @return bool
     */
    public function getNoStandardDescriptorAccessor()
    {
        return $this->get(self::NO_STANDARD_DESCRIPTOR_ACCESSOR);
    }

    /**
     * Sets value of 'deprecated' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setDeprecated($value)
    {
        return $this->set(self::DEPRECATED, $value);
    }

    /**
     * Returns value of 'deprecated' property
     *
     * @return bool
     */
    public function getDeprecated()
    {
        return $this->get(self::DEPRECATED);
    }

    /**
     * Sets value of 'map_entry' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setMapEntry($value)
    {
        return $this->set(self::MAP_ENTRY, $value);
    }

    /**
     * Returns value of 'map_entry' property
     *
     * @return bool
     */
    public function getMapEntry()
    {
        return $this->get(self::MAP_ENTRY);
    }

    /**
     * Appends value to 'uninterpreted_option' list
     *
     * @param UninterpretedOption $value Value to append
     *
     * @return null
     */
    public function appendUninterpretedOption(UninterpretedOption $value)
    {
        return $this->append(self::UNINTERPRETED_OPTION, $value);
    }

    /**
     * Clears 'uninterpreted_option' list
     *
     * @return null
     */
    public function clearUninterpretedOption()
    {
        return $this->clear(self::UNINTERPRETED_OPTION);
    }

    /**
     * Returns 'uninterpreted_option' list
     *
     * @return UninterpretedOption[]
     */
    public function getUninterpretedOption()
    {
        return $this->get(self::UNINTERPRETED_OPTION);
    }

    /**
     * Returns 'uninterpreted_option' iterator
     *
     * @return ArrayIterator
     */
    public function getUninterpretedOptionIterator()
    {
        return new \ArrayIterator($this->get(self::UNINTERPRETED_OPTION));
    }

    /**
     * Returns element from 'uninterpreted_option' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return UninterpretedOption
     */
    public function getUninterpretedOptionAt($offset)
    {
        return $this->get(self::UNINTERPRETED_OPTION, $offset);
    }

    /**
     * Returns count of 'uninterpreted_option' list
     *
     * @return int
     */
    public function getUninterpretedOptionCount()
    {
        return $this->count(self::UNINTERPRETED_OPTION);
    }
}

/**
 * CType enum embedded in FieldOptions message
 */
final class FieldOptions_CType
{
    const STRING = 0;
    const CORD = 1;
    const STRING_PIECE = 2;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'STRING' => self::STRING,
            'CORD' => self::CORD,
            'STRING_PIECE' => self::STRING_PIECE,
        );
    }
}

/**
 * JSType enum embedded in FieldOptions message
 */
final class FieldOptions_JSType
{
    const JS_NORMAL = 0;
    const JS_STRING = 1;
    const JS_NUMBER = 2;

    /**
     * Returns defined enum values
     *
     * @return int[]
     */
    public function getEnumValues()
    {
        return array(
            'JS_NORMAL' => self::JS_NORMAL,
            'JS_STRING' => self::JS_STRING,
            'JS_NUMBER' => self::JS_NUMBER,
        );
    }
}

/**
 * FieldOptions message
 */
class FieldOptions extends \ProtobufMessage
{
    /* Field index constants */
    const CTYPE = 1;
    const PACKED = 2;
    const JSTYPE = 6;
    const LAZY = 5;
    const DEPRECATED = 3;
    const WEAK = 10;
    const UNINTERPRETED_OPTION = 999;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::CTYPE => array(
            'default' => FieldOptions_CType::STRING, 
            'name' => 'ctype',
            'required' => false,
            'type' => 5,
        ),
        self::PACKED => array(
            'name' => 'packed',
            'required' => false,
            'type' => 8,
        ),
        self::JSTYPE => array(
            'default' => FieldOptions_JSType::JS_NORMAL, 
            'name' => 'jstype',
            'required' => false,
            'type' => 5,
        ),
        self::LAZY => array(
            'default' => false, 
            'name' => 'lazy',
            'required' => false,
            'type' => 8,
        ),
        self::DEPRECATED => array(
            'default' => false, 
            'name' => 'deprecated',
            'required' => false,
            'type' => 8,
        ),
        self::WEAK => array(
            'default' => false, 
            'name' => 'weak',
            'required' => false,
            'type' => 8,
        ),
        self::UNINTERPRETED_OPTION => array(
            'name' => 'uninterpreted_option',
            'repeated' => true,
            'type' => 'UninterpretedOption'
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
        $this->values[self::CTYPE] = FieldOptions_CType::STRING;
        $this->values[self::PACKED] = null;
        $this->values[self::JSTYPE] = FieldOptions_JSType::JS_NORMAL;
        $this->values[self::LAZY] = false;
        $this->values[self::DEPRECATED] = false;
        $this->values[self::WEAK] = false;
        $this->values[self::UNINTERPRETED_OPTION] = array();
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
     * Sets value of 'ctype' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setCtype($value)
    {
        return $this->set(self::CTYPE, $value);
    }

    /**
     * Returns value of 'ctype' property
     *
     * @return int
     */
    public function getCtype()
    {
        return $this->get(self::CTYPE);
    }

    /**
     * Sets value of 'packed' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setPacked($value)
    {
        return $this->set(self::PACKED, $value);
    }

    /**
     * Returns value of 'packed' property
     *
     * @return bool
     */
    public function getPacked()
    {
        return $this->get(self::PACKED);
    }

    /**
     * Sets value of 'jstype' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setJstype($value)
    {
        return $this->set(self::JSTYPE, $value);
    }

    /**
     * Returns value of 'jstype' property
     *
     * @return int
     */
    public function getJstype()
    {
        return $this->get(self::JSTYPE);
    }

    /**
     * Sets value of 'lazy' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setLazy($value)
    {
        return $this->set(self::LAZY, $value);
    }

    /**
     * Returns value of 'lazy' property
     *
     * @return bool
     */
    public function getLazy()
    {
        return $this->get(self::LAZY);
    }

    /**
     * Sets value of 'deprecated' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setDeprecated($value)
    {
        return $this->set(self::DEPRECATED, $value);
    }

    /**
     * Returns value of 'deprecated' property
     *
     * @return bool
     */
    public function getDeprecated()
    {
        return $this->get(self::DEPRECATED);
    }

    /**
     * Sets value of 'weak' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setWeak($value)
    {
        return $this->set(self::WEAK, $value);
    }

    /**
     * Returns value of 'weak' property
     *
     * @return bool
     */
    public function getWeak()
    {
        return $this->get(self::WEAK);
    }

    /**
     * Appends value to 'uninterpreted_option' list
     *
     * @param UninterpretedOption $value Value to append
     *
     * @return null
     */
    public function appendUninterpretedOption(UninterpretedOption $value)
    {
        return $this->append(self::UNINTERPRETED_OPTION, $value);
    }

    /**
     * Clears 'uninterpreted_option' list
     *
     * @return null
     */
    public function clearUninterpretedOption()
    {
        return $this->clear(self::UNINTERPRETED_OPTION);
    }

    /**
     * Returns 'uninterpreted_option' list
     *
     * @return UninterpretedOption[]
     */
    public function getUninterpretedOption()
    {
        return $this->get(self::UNINTERPRETED_OPTION);
    }

    /**
     * Returns 'uninterpreted_option' iterator
     *
     * @return ArrayIterator
     */
    public function getUninterpretedOptionIterator()
    {
        return new \ArrayIterator($this->get(self::UNINTERPRETED_OPTION));
    }

    /**
     * Returns element from 'uninterpreted_option' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return UninterpretedOption
     */
    public function getUninterpretedOptionAt($offset)
    {
        return $this->get(self::UNINTERPRETED_OPTION, $offset);
    }

    /**
     * Returns count of 'uninterpreted_option' list
     *
     * @return int
     */
    public function getUninterpretedOptionCount()
    {
        return $this->count(self::UNINTERPRETED_OPTION);
    }
}

/**
 * EnumOptions message
 */
class EnumOptions extends \ProtobufMessage
{
    /* Field index constants */
    const ALLOW_ALIAS = 2;
    const DEPRECATED = 3;
    const UNINTERPRETED_OPTION = 999;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ALLOW_ALIAS => array(
            'name' => 'allow_alias',
            'required' => false,
            'type' => 8,
        ),
        self::DEPRECATED => array(
            'default' => false, 
            'name' => 'deprecated',
            'required' => false,
            'type' => 8,
        ),
        self::UNINTERPRETED_OPTION => array(
            'name' => 'uninterpreted_option',
            'repeated' => true,
            'type' => 'UninterpretedOption'
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
        $this->values[self::ALLOW_ALIAS] = null;
        $this->values[self::DEPRECATED] = false;
        $this->values[self::UNINTERPRETED_OPTION] = array();
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
     * Sets value of 'allow_alias' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setAllowAlias($value)
    {
        return $this->set(self::ALLOW_ALIAS, $value);
    }

    /**
     * Returns value of 'allow_alias' property
     *
     * @return bool
     */
    public function getAllowAlias()
    {
        return $this->get(self::ALLOW_ALIAS);
    }

    /**
     * Sets value of 'deprecated' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setDeprecated($value)
    {
        return $this->set(self::DEPRECATED, $value);
    }

    /**
     * Returns value of 'deprecated' property
     *
     * @return bool
     */
    public function getDeprecated()
    {
        return $this->get(self::DEPRECATED);
    }

    /**
     * Appends value to 'uninterpreted_option' list
     *
     * @param UninterpretedOption $value Value to append
     *
     * @return null
     */
    public function appendUninterpretedOption(UninterpretedOption $value)
    {
        return $this->append(self::UNINTERPRETED_OPTION, $value);
    }

    /**
     * Clears 'uninterpreted_option' list
     *
     * @return null
     */
    public function clearUninterpretedOption()
    {
        return $this->clear(self::UNINTERPRETED_OPTION);
    }

    /**
     * Returns 'uninterpreted_option' list
     *
     * @return UninterpretedOption[]
     */
    public function getUninterpretedOption()
    {
        return $this->get(self::UNINTERPRETED_OPTION);
    }

    /**
     * Returns 'uninterpreted_option' iterator
     *
     * @return ArrayIterator
     */
    public function getUninterpretedOptionIterator()
    {
        return new \ArrayIterator($this->get(self::UNINTERPRETED_OPTION));
    }

    /**
     * Returns element from 'uninterpreted_option' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return UninterpretedOption
     */
    public function getUninterpretedOptionAt($offset)
    {
        return $this->get(self::UNINTERPRETED_OPTION, $offset);
    }

    /**
     * Returns count of 'uninterpreted_option' list
     *
     * @return int
     */
    public function getUninterpretedOptionCount()
    {
        return $this->count(self::UNINTERPRETED_OPTION);
    }
}

/**
 * EnumValueOptions message
 */
class EnumValueOptions extends \ProtobufMessage
{
    /* Field index constants */
    const DEPRECATED = 1;
    const UNINTERPRETED_OPTION = 999;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::DEPRECATED => array(
            'default' => false, 
            'name' => 'deprecated',
            'required' => false,
            'type' => 8,
        ),
        self::UNINTERPRETED_OPTION => array(
            'name' => 'uninterpreted_option',
            'repeated' => true,
            'type' => 'UninterpretedOption'
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
        $this->values[self::DEPRECATED] = false;
        $this->values[self::UNINTERPRETED_OPTION] = array();
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
     * Sets value of 'deprecated' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setDeprecated($value)
    {
        return $this->set(self::DEPRECATED, $value);
    }

    /**
     * Returns value of 'deprecated' property
     *
     * @return bool
     */
    public function getDeprecated()
    {
        return $this->get(self::DEPRECATED);
    }

    /**
     * Appends value to 'uninterpreted_option' list
     *
     * @param UninterpretedOption $value Value to append
     *
     * @return null
     */
    public function appendUninterpretedOption(UninterpretedOption $value)
    {
        return $this->append(self::UNINTERPRETED_OPTION, $value);
    }

    /**
     * Clears 'uninterpreted_option' list
     *
     * @return null
     */
    public function clearUninterpretedOption()
    {
        return $this->clear(self::UNINTERPRETED_OPTION);
    }

    /**
     * Returns 'uninterpreted_option' list
     *
     * @return UninterpretedOption[]
     */
    public function getUninterpretedOption()
    {
        return $this->get(self::UNINTERPRETED_OPTION);
    }

    /**
     * Returns 'uninterpreted_option' iterator
     *
     * @return ArrayIterator
     */
    public function getUninterpretedOptionIterator()
    {
        return new \ArrayIterator($this->get(self::UNINTERPRETED_OPTION));
    }

    /**
     * Returns element from 'uninterpreted_option' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return UninterpretedOption
     */
    public function getUninterpretedOptionAt($offset)
    {
        return $this->get(self::UNINTERPRETED_OPTION, $offset);
    }

    /**
     * Returns count of 'uninterpreted_option' list
     *
     * @return int
     */
    public function getUninterpretedOptionCount()
    {
        return $this->count(self::UNINTERPRETED_OPTION);
    }
}

/**
 * ServiceOptions message
 */
class ServiceOptions extends \ProtobufMessage
{
    /* Field index constants */
    const DEPRECATED = 33;
    const UNINTERPRETED_OPTION = 999;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::DEPRECATED => array(
            'default' => false, 
            'name' => 'deprecated',
            'required' => false,
            'type' => 8,
        ),
        self::UNINTERPRETED_OPTION => array(
            'name' => 'uninterpreted_option',
            'repeated' => true,
            'type' => 'UninterpretedOption'
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
        $this->values[self::DEPRECATED] = false;
        $this->values[self::UNINTERPRETED_OPTION] = array();
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
     * Sets value of 'deprecated' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setDeprecated($value)
    {
        return $this->set(self::DEPRECATED, $value);
    }

    /**
     * Returns value of 'deprecated' property
     *
     * @return bool
     */
    public function getDeprecated()
    {
        return $this->get(self::DEPRECATED);
    }

    /**
     * Appends value to 'uninterpreted_option' list
     *
     * @param UninterpretedOption $value Value to append
     *
     * @return null
     */
    public function appendUninterpretedOption(UninterpretedOption $value)
    {
        return $this->append(self::UNINTERPRETED_OPTION, $value);
    }

    /**
     * Clears 'uninterpreted_option' list
     *
     * @return null
     */
    public function clearUninterpretedOption()
    {
        return $this->clear(self::UNINTERPRETED_OPTION);
    }

    /**
     * Returns 'uninterpreted_option' list
     *
     * @return UninterpretedOption[]
     */
    public function getUninterpretedOption()
    {
        return $this->get(self::UNINTERPRETED_OPTION);
    }

    /**
     * Returns 'uninterpreted_option' iterator
     *
     * @return ArrayIterator
     */
    public function getUninterpretedOptionIterator()
    {
        return new \ArrayIterator($this->get(self::UNINTERPRETED_OPTION));
    }

    /**
     * Returns element from 'uninterpreted_option' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return UninterpretedOption
     */
    public function getUninterpretedOptionAt($offset)
    {
        return $this->get(self::UNINTERPRETED_OPTION, $offset);
    }

    /**
     * Returns count of 'uninterpreted_option' list
     *
     * @return int
     */
    public function getUninterpretedOptionCount()
    {
        return $this->count(self::UNINTERPRETED_OPTION);
    }
}

/**
 * MethodOptions message
 */
class MethodOptions extends \ProtobufMessage
{
    /* Field index constants */
    const DEPRECATED = 33;
    const UNINTERPRETED_OPTION = 999;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::DEPRECATED => array(
            'default' => false, 
            'name' => 'deprecated',
            'required' => false,
            'type' => 8,
        ),
        self::UNINTERPRETED_OPTION => array(
            'name' => 'uninterpreted_option',
            'repeated' => true,
            'type' => 'UninterpretedOption'
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
        $this->values[self::DEPRECATED] = false;
        $this->values[self::UNINTERPRETED_OPTION] = array();
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
     * Sets value of 'deprecated' property
     *
     * @param bool $value Property value
     *
     * @return null
     */
    public function setDeprecated($value)
    {
        return $this->set(self::DEPRECATED, $value);
    }

    /**
     * Returns value of 'deprecated' property
     *
     * @return bool
     */
    public function getDeprecated()
    {
        return $this->get(self::DEPRECATED);
    }

    /**
     * Appends value to 'uninterpreted_option' list
     *
     * @param UninterpretedOption $value Value to append
     *
     * @return null
     */
    public function appendUninterpretedOption(UninterpretedOption $value)
    {
        return $this->append(self::UNINTERPRETED_OPTION, $value);
    }

    /**
     * Clears 'uninterpreted_option' list
     *
     * @return null
     */
    public function clearUninterpretedOption()
    {
        return $this->clear(self::UNINTERPRETED_OPTION);
    }

    /**
     * Returns 'uninterpreted_option' list
     *
     * @return UninterpretedOption[]
     */
    public function getUninterpretedOption()
    {
        return $this->get(self::UNINTERPRETED_OPTION);
    }

    /**
     * Returns 'uninterpreted_option' iterator
     *
     * @return ArrayIterator
     */
    public function getUninterpretedOptionIterator()
    {
        return new \ArrayIterator($this->get(self::UNINTERPRETED_OPTION));
    }

    /**
     * Returns element from 'uninterpreted_option' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return UninterpretedOption
     */
    public function getUninterpretedOptionAt($offset)
    {
        return $this->get(self::UNINTERPRETED_OPTION, $offset);
    }

    /**
     * Returns count of 'uninterpreted_option' list
     *
     * @return int
     */
    public function getUninterpretedOptionCount()
    {
        return $this->count(self::UNINTERPRETED_OPTION);
    }
}

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
            'type' => 7,
        ),
        self::IS_EXTENSION => array(
            'name' => 'is_extension',
            'required' => true,
            'type' => 8,
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
     * @param bool $value Property value
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
     * @return bool
     */
    public function getIsExtension()
    {
        return $this->get(self::IS_EXTENSION);
    }
}

/**
 * UninterpretedOption message
 */
class UninterpretedOption extends \ProtobufMessage
{
    /* Field index constants */
    const NAME = 2;
    const IDENTIFIER_VALUE = 3;
    const POSITIVE_INT_VALUE = 4;
    const NEGATIVE_INT_VALUE = 5;
    const DOUBLE_VALUE = 6;
    const STRING_VALUE = 7;
    const AGGREGATE_VALUE = 8;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::NAME => array(
            'name' => 'name',
            'repeated' => true,
            'type' => 'UninterpretedOption_NamePart'
        ),
        self::IDENTIFIER_VALUE => array(
            'name' => 'identifier_value',
            'required' => false,
            'type' => 7,
        ),
        self::POSITIVE_INT_VALUE => array(
            'name' => 'positive_int_value',
            'required' => false,
            'type' => 5,
        ),
        self::NEGATIVE_INT_VALUE => array(
            'name' => 'negative_int_value',
            'required' => false,
            'type' => 5,
        ),
        self::DOUBLE_VALUE => array(
            'name' => 'double_value',
            'required' => false,
            'type' => 1,
        ),
        self::STRING_VALUE => array(
            'name' => 'string_value',
            'required' => false,
            'type' => 7,
        ),
        self::AGGREGATE_VALUE => array(
            'name' => 'aggregate_value',
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
        $this->values[self::NAME] = array();
        $this->values[self::IDENTIFIER_VALUE] = null;
        $this->values[self::POSITIVE_INT_VALUE] = null;
        $this->values[self::NEGATIVE_INT_VALUE] = null;
        $this->values[self::DOUBLE_VALUE] = null;
        $this->values[self::STRING_VALUE] = null;
        $this->values[self::AGGREGATE_VALUE] = null;
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
     * Appends value to 'name' list
     *
     * @param UninterpretedOption_NamePart $value Value to append
     *
     * @return null
     */
    public function appendName(UninterpretedOption_NamePart $value)
    {
        return $this->append(self::NAME, $value);
    }

    /**
     * Clears 'name' list
     *
     * @return null
     */
    public function clearName()
    {
        return $this->clear(self::NAME);
    }

    /**
     * Returns 'name' list
     *
     * @return UninterpretedOption_NamePart[]
     */
    public function getName()
    {
        return $this->get(self::NAME);
    }

    /**
     * Returns 'name' iterator
     *
     * @return ArrayIterator
     */
    public function getNameIterator()
    {
        return new \ArrayIterator($this->get(self::NAME));
    }

    /**
     * Returns element from 'name' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return UninterpretedOption_NamePart
     */
    public function getNameAt($offset)
    {
        return $this->get(self::NAME, $offset);
    }

    /**
     * Returns count of 'name' list
     *
     * @return int
     */
    public function getNameCount()
    {
        return $this->count(self::NAME);
    }

    /**
     * Sets value of 'identifier_value' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setIdentifierValue($value)
    {
        return $this->set(self::IDENTIFIER_VALUE, $value);
    }

    /**
     * Returns value of 'identifier_value' property
     *
     * @return string
     */
    public function getIdentifierValue()
    {
        return $this->get(self::IDENTIFIER_VALUE);
    }

    /**
     * Sets value of 'positive_int_value' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setPositiveIntValue($value)
    {
        return $this->set(self::POSITIVE_INT_VALUE, $value);
    }

    /**
     * Returns value of 'positive_int_value' property
     *
     * @return int
     */
    public function getPositiveIntValue()
    {
        return $this->get(self::POSITIVE_INT_VALUE);
    }

    /**
     * Sets value of 'negative_int_value' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setNegativeIntValue($value)
    {
        return $this->set(self::NEGATIVE_INT_VALUE, $value);
    }

    /**
     * Returns value of 'negative_int_value' property
     *
     * @return int
     */
    public function getNegativeIntValue()
    {
        return $this->get(self::NEGATIVE_INT_VALUE);
    }

    /**
     * Sets value of 'double_value' property
     *
     * @param float $value Property value
     *
     * @return null
     */
    public function setDoubleValue($value)
    {
        return $this->set(self::DOUBLE_VALUE, $value);
    }

    /**
     * Returns value of 'double_value' property
     *
     * @return float
     */
    public function getDoubleValue()
    {
        return $this->get(self::DOUBLE_VALUE);
    }

    /**
     * Sets value of 'string_value' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setStringValue($value)
    {
        return $this->set(self::STRING_VALUE, $value);
    }

    /**
     * Returns value of 'string_value' property
     *
     * @return string
     */
    public function getStringValue()
    {
        return $this->get(self::STRING_VALUE);
    }

    /**
     * Sets value of 'aggregate_value' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setAggregateValue($value)
    {
        return $this->set(self::AGGREGATE_VALUE, $value);
    }

    /**
     * Returns value of 'aggregate_value' property
     *
     * @return string
     */
    public function getAggregateValue()
    {
        return $this->get(self::AGGREGATE_VALUE);
    }
}

/**
 * Location message embedded in SourceCodeInfo message
 */
class SourceCodeInfo_Location extends \ProtobufMessage
{
    /* Field index constants */
    const LEADING_COMMENTS = 3;
    const TRAILING_COMMENTS = 4;
    const LEADING_DETACHED_COMMENTS = 6;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::LEADING_COMMENTS => array(
            'name' => 'leading_comments',
            'required' => false,
            'type' => 7,
        ),
        self::TRAILING_COMMENTS => array(
            'name' => 'trailing_comments',
            'required' => false,
            'type' => 7,
        ),
        self::LEADING_DETACHED_COMMENTS => array(
            'name' => 'leading_detached_comments',
            'repeated' => true,
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
        $this->values[self::LEADING_COMMENTS] = null;
        $this->values[self::TRAILING_COMMENTS] = null;
        $this->values[self::LEADING_DETACHED_COMMENTS] = array();
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
     * Sets value of 'leading_comments' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setLeadingComments($value)
    {
        return $this->set(self::LEADING_COMMENTS, $value);
    }

    /**
     * Returns value of 'leading_comments' property
     *
     * @return string
     */
    public function getLeadingComments()
    {
        return $this->get(self::LEADING_COMMENTS);
    }

    /**
     * Sets value of 'trailing_comments' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setTrailingComments($value)
    {
        return $this->set(self::TRAILING_COMMENTS, $value);
    }

    /**
     * Returns value of 'trailing_comments' property
     *
     * @return string
     */
    public function getTrailingComments()
    {
        return $this->get(self::TRAILING_COMMENTS);
    }

    /**
     * Appends value to 'leading_detached_comments' list
     *
     * @param string $value Value to append
     *
     * @return null
     */
    public function appendLeadingDetachedComments($value)
    {
        return $this->append(self::LEADING_DETACHED_COMMENTS, $value);
    }

    /**
     * Clears 'leading_detached_comments' list
     *
     * @return null
     */
    public function clearLeadingDetachedComments()
    {
        return $this->clear(self::LEADING_DETACHED_COMMENTS);
    }

    /**
     * Returns 'leading_detached_comments' list
     *
     * @return string[]
     */
    public function getLeadingDetachedComments()
    {
        return $this->get(self::LEADING_DETACHED_COMMENTS);
    }

    /**
     * Returns 'leading_detached_comments' iterator
     *
     * @return ArrayIterator
     */
    public function getLeadingDetachedCommentsIterator()
    {
        return new \ArrayIterator($this->get(self::LEADING_DETACHED_COMMENTS));
    }

    /**
     * Returns element from 'leading_detached_comments' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return string
     */
    public function getLeadingDetachedCommentsAt($offset)
    {
        return $this->get(self::LEADING_DETACHED_COMMENTS, $offset);
    }

    /**
     * Returns count of 'leading_detached_comments' list
     *
     * @return int
     */
    public function getLeadingDetachedCommentsCount()
    {
        return $this->count(self::LEADING_DETACHED_COMMENTS);
    }
}

/**
 * SourceCodeInfo message
 */
class SourceCodeInfo extends \ProtobufMessage
{
    /* Field index constants */
    const LOCATION = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::LOCATION => array(
            'name' => 'location',
            'repeated' => true,
            'type' => 'SourceCodeInfo_Location'
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
        $this->values[self::LOCATION] = array();
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
     * Appends value to 'location' list
     *
     * @param SourceCodeInfo_Location $value Value to append
     *
     * @return null
     */
    public function appendLocation(SourceCodeInfo_Location $value)
    {
        return $this->append(self::LOCATION, $value);
    }

    /**
     * Clears 'location' list
     *
     * @return null
     */
    public function clearLocation()
    {
        return $this->clear(self::LOCATION);
    }

    /**
     * Returns 'location' list
     *
     * @return SourceCodeInfo_Location[]
     */
    public function getLocation()
    {
        return $this->get(self::LOCATION);
    }

    /**
     * Returns 'location' iterator
     *
     * @return ArrayIterator
     */
    public function getLocationIterator()
    {
        return new \ArrayIterator($this->get(self::LOCATION));
    }

    /**
     * Returns element from 'location' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return SourceCodeInfo_Location
     */
    public function getLocationAt($offset)
    {
        return $this->get(self::LOCATION, $offset);
    }

    /**
     * Returns count of 'location' list
     *
     * @return int
     */
    public function getLocationCount()
    {
        return $this->count(self::LOCATION);
    }
}

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
     * @param int $value Property value
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
     * @return int
     */
    public function getBegin()
    {
        return $this->get(self::BEGIN);
    }

    /**
     * Sets value of 'end' property
     *
     * @param int $value Property value
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
     * @return int
     */
    public function getEnd()
    {
        return $this->get(self::END);
    }
}

/**
 * GeneratedCodeInfo message
 */
class GeneratedCodeInfo extends \ProtobufMessage
{
    /* Field index constants */
    const ANNOTATION = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::ANNOTATION => array(
            'name' => 'annotation',
            'repeated' => true,
            'type' => 'GeneratedCodeInfo_Annotation'
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
        $this->values[self::ANNOTATION] = array();
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
     * Appends value to 'annotation' list
     *
     * @param GeneratedCodeInfo_Annotation $value Value to append
     *
     * @return null
     */
    public function appendAnnotation(GeneratedCodeInfo_Annotation $value)
    {
        return $this->append(self::ANNOTATION, $value);
    }

    /**
     * Clears 'annotation' list
     *
     * @return null
     */
    public function clearAnnotation()
    {
        return $this->clear(self::ANNOTATION);
    }

    /**
     * Returns 'annotation' list
     *
     * @return GeneratedCodeInfo_Annotation[]
     */
    public function getAnnotation()
    {
        return $this->get(self::ANNOTATION);
    }

    /**
     * Returns 'annotation' iterator
     *
     * @return ArrayIterator
     */
    public function getAnnotationIterator()
    {
        return new \ArrayIterator($this->get(self::ANNOTATION));
    }

    /**
     * Returns element from 'annotation' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return GeneratedCodeInfo_Annotation
     */
    public function getAnnotationAt($offset)
    {
        return $this->get(self::ANNOTATION, $offset);
    }

    /**
     * Returns count of 'annotation' list
     *
     * @return int
     */
    public function getAnnotationCount()
    {
        return $this->count(self::ANNOTATION);
    }
}
