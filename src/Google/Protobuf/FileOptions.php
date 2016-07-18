<?php
/**
 * Auto generated from descriptor.proto at 2016-07-08 14:22:37
 *
 * google.protobuf package
 */

namespace Google\Protobuf {
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
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::JAVA_OUTER_CLASSNAME => array(
            'name' => 'java_outer_classname',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::JAVA_MULTIPLE_FILES => array(
            'default' => false,
            'name' => 'java_multiple_files',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::JAVA_GENERATE_EQUALS_AND_HASH => array(
            'default' => false,
            'name' => 'java_generate_equals_and_hash',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::JAVA_STRING_CHECK_UTF8 => array(
            'default' => false,
            'name' => 'java_string_check_utf8',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::OPTIMIZE_FOR => array(
            'default' => \Google\Protobuf\FileOptions_OptimizeMode::SPEED,
            'name' => 'optimize_for',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::GO_PACKAGE => array(
            'name' => 'go_package',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::CC_GENERIC_SERVICES => array(
            'default' => false,
            'name' => 'cc_generic_services',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::JAVA_GENERIC_SERVICES => array(
            'default' => false,
            'name' => 'java_generic_services',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::PY_GENERIC_SERVICES => array(
            'default' => false,
            'name' => 'py_generic_services',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::DEPRECATED => array(
            'default' => false,
            'name' => 'deprecated',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::CC_ENABLE_ARENAS => array(
            'default' => false,
            'name' => 'cc_enable_arenas',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::OBJC_CLASS_PREFIX => array(
            'name' => 'objc_class_prefix',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::CSHARP_NAMESPACE => array(
            'name' => 'csharp_namespace',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::UNINTERPRETED_OPTION => array(
            'name' => 'uninterpreted_option',
            'repeated' => true,
            'type' => '\Google\Protobuf\UninterpretedOption'
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
        $this->values[self::JAVA_PACKAGE] = null;
        $this->values[self::JAVA_OUTER_CLASSNAME] = null;
        $this->values[self::JAVA_MULTIPLE_FILES] = self::$fields[self::JAVA_MULTIPLE_FILES]['default'];
        $this->values[self::JAVA_GENERATE_EQUALS_AND_HASH] = self::$fields[self::JAVA_GENERATE_EQUALS_AND_HASH]['default'];
        $this->values[self::JAVA_STRING_CHECK_UTF8] = self::$fields[self::JAVA_STRING_CHECK_UTF8]['default'];
        $this->values[self::OPTIMIZE_FOR] = self::$fields[self::OPTIMIZE_FOR]['default'];
        $this->values[self::GO_PACKAGE] = null;
        $this->values[self::CC_GENERIC_SERVICES] = self::$fields[self::CC_GENERIC_SERVICES]['default'];
        $this->values[self::JAVA_GENERIC_SERVICES] = self::$fields[self::JAVA_GENERIC_SERVICES]['default'];
        $this->values[self::PY_GENERIC_SERVICES] = self::$fields[self::PY_GENERIC_SERVICES]['default'];
        $this->values[self::DEPRECATED] = self::$fields[self::DEPRECATED]['default'];
        $this->values[self::CC_ENABLE_ARENAS] = self::$fields[self::CC_ENABLE_ARENAS]['default'];
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
     * @param boolean $value Property value
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
     * @return boolean
     */
    public function getJavaMultipleFiles()
    {
        return $this->get(self::JAVA_MULTIPLE_FILES);
    }

    /**
     * Sets value of 'java_generate_equals_and_hash' property
     *
     * @param boolean $value Property value
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
     * @return boolean
     */
    public function getJavaGenerateEqualsAndHash()
    {
        return $this->get(self::JAVA_GENERATE_EQUALS_AND_HASH);
    }

    /**
     * Sets value of 'java_string_check_utf8' property
     *
     * @param boolean $value Property value
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
     * @return boolean
     */
    public function getJavaStringCheckUtf8()
    {
        return $this->get(self::JAVA_STRING_CHECK_UTF8);
    }

    /**
     * Sets value of 'optimize_for' property
     *
     * @param integer $value Property value
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
     * @return integer
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
     * @param boolean $value Property value
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
     * @return boolean
     */
    public function getCcGenericServices()
    {
        return $this->get(self::CC_GENERIC_SERVICES);
    }

    /**
     * Sets value of 'java_generic_services' property
     *
     * @param boolean $value Property value
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
     * @return boolean
     */
    public function getJavaGenericServices()
    {
        return $this->get(self::JAVA_GENERIC_SERVICES);
    }

    /**
     * Sets value of 'py_generic_services' property
     *
     * @param boolean $value Property value
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
     * @return boolean
     */
    public function getPyGenericServices()
    {
        return $this->get(self::PY_GENERIC_SERVICES);
    }

    /**
     * Sets value of 'deprecated' property
     *
     * @param boolean $value Property value
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
     * @return boolean
     */
    public function getDeprecated()
    {
        return $this->get(self::DEPRECATED);
    }

    /**
     * Sets value of 'cc_enable_arenas' property
     *
     * @param boolean $value Property value
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
     * @return boolean
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
     * @param \Google\Protobuf\UninterpretedOption $value Value to append
     *
     * @return null
     */
    public function appendUninterpretedOption(\Google\Protobuf\UninterpretedOption $value)
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
     * @return \Google\Protobuf\UninterpretedOption[]
     */
    public function getUninterpretedOption()
    {
        return $this->get(self::UNINTERPRETED_OPTION);
    }

    /**
     * Returns 'uninterpreted_option' iterator
     *
     * @return \ArrayIterator
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
     * @return \Google\Protobuf\UninterpretedOption
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
}