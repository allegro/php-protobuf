<?php
/**
 * Auto generated from descriptor.proto at 2019-01-07 11:34:00
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
    const PHP_GENERIC_SERVICES = 42;
    const DEPRECATED = 23;
    const CC_ENABLE_ARENAS = 31;
    const OBJC_CLASS_PREFIX = 36;
    const CSHARP_NAMESPACE = 37;
    const SWIFT_PREFIX = 39;
    const PHP_CLASS_PREFIX = 40;
    const PHP_NAMESPACE = 41;
    const PHP_METADATA_NAMESPACE = 44;
    const RUBY_PACKAGE = 45;
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
        self::PHP_GENERIC_SERVICES => array(
            'default' => false,
            'name' => 'php_generic_services',
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
        self::SWIFT_PREFIX => array(
            'name' => 'swift_prefix',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::PHP_CLASS_PREFIX => array(
            'name' => 'php_class_prefix',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::PHP_NAMESPACE => array(
            'name' => 'php_namespace',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::PHP_METADATA_NAMESPACE => array(
            'name' => 'php_metadata_namespace',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::RUBY_PACKAGE => array(
            'name' => 'ruby_package',
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
        $this->values[self::JAVA_GENERATE_EQUALS_AND_HASH] = null;
        $this->values[self::JAVA_STRING_CHECK_UTF8] = self::$fields[self::JAVA_STRING_CHECK_UTF8]['default'];
        $this->values[self::OPTIMIZE_FOR] = self::$fields[self::OPTIMIZE_FOR]['default'];
        $this->values[self::GO_PACKAGE] = null;
        $this->values[self::CC_GENERIC_SERVICES] = self::$fields[self::CC_GENERIC_SERVICES]['default'];
        $this->values[self::JAVA_GENERIC_SERVICES] = self::$fields[self::JAVA_GENERIC_SERVICES]['default'];
        $this->values[self::PY_GENERIC_SERVICES] = self::$fields[self::PY_GENERIC_SERVICES]['default'];
        $this->values[self::PHP_GENERIC_SERVICES] = self::$fields[self::PHP_GENERIC_SERVICES]['default'];
        $this->values[self::DEPRECATED] = self::$fields[self::DEPRECATED]['default'];
        $this->values[self::CC_ENABLE_ARENAS] = self::$fields[self::CC_ENABLE_ARENAS]['default'];
        $this->values[self::OBJC_CLASS_PREFIX] = null;
        $this->values[self::CSHARP_NAMESPACE] = null;
        $this->values[self::SWIFT_PREFIX] = null;
        $this->values[self::PHP_CLASS_PREFIX] = null;
        $this->values[self::PHP_NAMESPACE] = null;
        $this->values[self::PHP_METADATA_NAMESPACE] = null;
        $this->values[self::RUBY_PACKAGE] = null;
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
        $value = $this->get(self::JAVA_PACKAGE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'java_package' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasJavaPackage()
    {
        return $this->get(self::JAVA_PACKAGE) !== null;
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
        $value = $this->get(self::JAVA_OUTER_CLASSNAME);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'java_outer_classname' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasJavaOuterClassname()
    {
        return $this->get(self::JAVA_OUTER_CLASSNAME) !== null;
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
        $value = $this->get(self::JAVA_MULTIPLE_FILES);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'java_multiple_files' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasJavaMultipleFiles()
    {
        return $this->get(self::JAVA_MULTIPLE_FILES) !== null;
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
        $value = $this->get(self::JAVA_GENERATE_EQUALS_AND_HASH);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'java_generate_equals_and_hash' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasJavaGenerateEqualsAndHash()
    {
        return $this->get(self::JAVA_GENERATE_EQUALS_AND_HASH) !== null;
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
        $value = $this->get(self::JAVA_STRING_CHECK_UTF8);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'java_string_check_utf8' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasJavaStringCheckUtf8()
    {
        return $this->get(self::JAVA_STRING_CHECK_UTF8) !== null;
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
        $value = $this->get(self::OPTIMIZE_FOR);
        return $value === null ? (integer)$value : $value;
    }

    /**
     * Returns true if 'optimize_for' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasOptimizeFor()
    {
        return $this->get(self::OPTIMIZE_FOR) !== null;
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
        $value = $this->get(self::GO_PACKAGE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'go_package' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasGoPackage()
    {
        return $this->get(self::GO_PACKAGE) !== null;
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
        $value = $this->get(self::CC_GENERIC_SERVICES);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'cc_generic_services' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasCcGenericServices()
    {
        return $this->get(self::CC_GENERIC_SERVICES) !== null;
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
        $value = $this->get(self::JAVA_GENERIC_SERVICES);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'java_generic_services' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasJavaGenericServices()
    {
        return $this->get(self::JAVA_GENERIC_SERVICES) !== null;
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
        $value = $this->get(self::PY_GENERIC_SERVICES);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'py_generic_services' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPyGenericServices()
    {
        return $this->get(self::PY_GENERIC_SERVICES) !== null;
    }

    /**
     * Sets value of 'php_generic_services' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setPhpGenericServices($value)
    {
        return $this->set(self::PHP_GENERIC_SERVICES, $value);
    }

    /**
     * Returns value of 'php_generic_services' property
     *
     * @return boolean
     */
    public function getPhpGenericServices()
    {
        $value = $this->get(self::PHP_GENERIC_SERVICES);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'php_generic_services' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPhpGenericServices()
    {
        return $this->get(self::PHP_GENERIC_SERVICES) !== null;
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
        $value = $this->get(self::DEPRECATED);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'deprecated' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasDeprecated()
    {
        return $this->get(self::DEPRECATED) !== null;
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
        $value = $this->get(self::CC_ENABLE_ARENAS);
        return $value === null ? (boolean)$value : $value;
    }

    /**
     * Returns true if 'cc_enable_arenas' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasCcEnableArenas()
    {
        return $this->get(self::CC_ENABLE_ARENAS) !== null;
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
        $value = $this->get(self::OBJC_CLASS_PREFIX);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'objc_class_prefix' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasObjcClassPrefix()
    {
        return $this->get(self::OBJC_CLASS_PREFIX) !== null;
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
        $value = $this->get(self::CSHARP_NAMESPACE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'csharp_namespace' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasCsharpNamespace()
    {
        return $this->get(self::CSHARP_NAMESPACE) !== null;
    }

    /**
     * Sets value of 'swift_prefix' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setSwiftPrefix($value)
    {
        return $this->set(self::SWIFT_PREFIX, $value);
    }

    /**
     * Returns value of 'swift_prefix' property
     *
     * @return string
     */
    public function getSwiftPrefix()
    {
        $value = $this->get(self::SWIFT_PREFIX);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'swift_prefix' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasSwiftPrefix()
    {
        return $this->get(self::SWIFT_PREFIX) !== null;
    }

    /**
     * Sets value of 'php_class_prefix' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setPhpClassPrefix($value)
    {
        return $this->set(self::PHP_CLASS_PREFIX, $value);
    }

    /**
     * Returns value of 'php_class_prefix' property
     *
     * @return string
     */
    public function getPhpClassPrefix()
    {
        $value = $this->get(self::PHP_CLASS_PREFIX);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'php_class_prefix' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPhpClassPrefix()
    {
        return $this->get(self::PHP_CLASS_PREFIX) !== null;
    }

    /**
     * Sets value of 'php_namespace' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setPhpNamespace($value)
    {
        return $this->set(self::PHP_NAMESPACE, $value);
    }

    /**
     * Returns value of 'php_namespace' property
     *
     * @return string
     */
    public function getPhpNamespace()
    {
        $value = $this->get(self::PHP_NAMESPACE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'php_namespace' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPhpNamespace()
    {
        return $this->get(self::PHP_NAMESPACE) !== null;
    }

    /**
     * Sets value of 'php_metadata_namespace' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setPhpMetadataNamespace($value)
    {
        return $this->set(self::PHP_METADATA_NAMESPACE, $value);
    }

    /**
     * Returns value of 'php_metadata_namespace' property
     *
     * @return string
     */
    public function getPhpMetadataNamespace()
    {
        $value = $this->get(self::PHP_METADATA_NAMESPACE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'php_metadata_namespace' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasPhpMetadataNamespace()
    {
        return $this->get(self::PHP_METADATA_NAMESPACE) !== null;
    }

    /**
     * Sets value of 'ruby_package' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setRubyPackage($value)
    {
        return $this->set(self::RUBY_PACKAGE, $value);
    }

    /**
     * Returns value of 'ruby_package' property
     *
     * @return string
     */
    public function getRubyPackage()
    {
        $value = $this->get(self::RUBY_PACKAGE);
        return $value === null ? (string)$value : $value;
    }

    /**
     * Returns true if 'ruby_package' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasRubyPackage()
    {
        return $this->get(self::RUBY_PACKAGE) !== null;
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
     * Returns true if 'uninterpreted_option' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasUninterpretedOption()
    {
        return count($this->get(self::UNINTERPRETED_OPTION)) !== 0;
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