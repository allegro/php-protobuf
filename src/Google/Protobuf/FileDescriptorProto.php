<?php
/**
 * Auto generated from descriptor.proto at 2016-07-08 14:22:37
 *
 * google.protobuf package
 */

namespace Google\Protobuf {
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
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::PACKAGE => array(
            'name' => 'package',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::DEPENDENCY => array(
            'name' => 'dependency',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::PUBLIC_DEPENDENCY => array(
            'name' => 'public_dependency',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::WEAK_DEPENDENCY => array(
            'name' => 'weak_dependency',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::MESSAGE_TYPE => array(
            'name' => 'message_type',
            'repeated' => true,
            'type' => '\Google\Protobuf\DescriptorProto'
        ),
        self::ENUM_TYPE => array(
            'name' => 'enum_type',
            'repeated' => true,
            'type' => '\Google\Protobuf\EnumDescriptorProto'
        ),
        self::SERVICE => array(
            'name' => 'service',
            'repeated' => true,
            'type' => '\Google\Protobuf\ServiceDescriptorProto'
        ),
        self::EXTENSION => array(
            'name' => 'extension',
            'repeated' => true,
            'type' => '\Google\Protobuf\FieldDescriptorProto'
        ),
        self::OPTIONS => array(
            'name' => 'options',
            'required' => false,
            'type' => '\Google\Protobuf\FileOptions'
        ),
        self::SOURCE_CODE_INFO => array(
            'name' => 'source_code_info',
            'required' => false,
            'type' => '\Google\Protobuf\SourceCodeInfo'
        ),
        self::SYNTAX => array(
            'name' => 'syntax',
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
     * @return \ArrayIterator
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
     * @param integer $value Value to append
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
     * @return integer[]
     */
    public function getPublicDependency()
    {
        return $this->get(self::PUBLIC_DEPENDENCY);
    }

    /**
     * Returns 'public_dependency' iterator
     *
     * @return \ArrayIterator
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
     * @return integer
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
     * @param integer $value Value to append
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
     * @return integer[]
     */
    public function getWeakDependency()
    {
        return $this->get(self::WEAK_DEPENDENCY);
    }

    /**
     * Returns 'weak_dependency' iterator
     *
     * @return \ArrayIterator
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
     * @return integer
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
     * @param \Google\Protobuf\DescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendMessageType(\Google\Protobuf\DescriptorProto $value)
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
     * @return \Google\Protobuf\DescriptorProto[]
     */
    public function getMessageType()
    {
        return $this->get(self::MESSAGE_TYPE);
    }

    /**
     * Returns 'message_type' iterator
     *
     * @return \ArrayIterator
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
     * @return \Google\Protobuf\DescriptorProto
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
     * @param \Google\Protobuf\EnumDescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendEnumType(\Google\Protobuf\EnumDescriptorProto $value)
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
     * @return \Google\Protobuf\EnumDescriptorProto[]
     */
    public function getEnumType()
    {
        return $this->get(self::ENUM_TYPE);
    }

    /**
     * Returns 'enum_type' iterator
     *
     * @return \ArrayIterator
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
     * @return \Google\Protobuf\EnumDescriptorProto
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
     * @param \Google\Protobuf\ServiceDescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendService(\Google\Protobuf\ServiceDescriptorProto $value)
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
     * @return \Google\Protobuf\ServiceDescriptorProto[]
     */
    public function getService()
    {
        return $this->get(self::SERVICE);
    }

    /**
     * Returns 'service' iterator
     *
     * @return \ArrayIterator
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
     * @return \Google\Protobuf\ServiceDescriptorProto
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
     * @param \Google\Protobuf\FieldDescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendExtension(\Google\Protobuf\FieldDescriptorProto $value)
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
     * @return \Google\Protobuf\FieldDescriptorProto[]
     */
    public function getExtension()
    {
        return $this->get(self::EXTENSION);
    }

    /**
     * Returns 'extension' iterator
     *
     * @return \ArrayIterator
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
     * @return \Google\Protobuf\FieldDescriptorProto
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
     * @param \Google\Protobuf\FileOptions $value Property value
     *
     * @return null
     */
    public function setOptions(\Google\Protobuf\FileOptions $value)
    {
        return $this->set(self::OPTIONS, $value);
    }

    /**
     * Returns value of 'options' property
     *
     * @return \Google\Protobuf\FileOptions
     */
    public function getOptions()
    {
        return $this->get(self::OPTIONS);
    }

    /**
     * Sets value of 'source_code_info' property
     *
     * @param \Google\Protobuf\SourceCodeInfo $value Property value
     *
     * @return null
     */
    public function setSourceCodeInfo(\Google\Protobuf\SourceCodeInfo $value)
    {
        return $this->set(self::SOURCE_CODE_INFO, $value);
    }

    /**
     * Returns value of 'source_code_info' property
     *
     * @return \Google\Protobuf\SourceCodeInfo
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
}