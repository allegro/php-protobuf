<?php
namespace Allegro\Protobuf\Compiler;

use Google\Protobuf\FieldDescriptorProto_Label;
use Google\Protobuf\FieldDescriptorProto_Type;

/**
 * Describes field
 */
class FieldDescriptor
{
    private static $_scalarInternalTypesByProtobufType = array(
        FieldDescriptorProto_Type::TYPE_DOUBLE   => '\ProtobufMessage::PB_TYPE_DOUBLE',
        FieldDescriptorProto_Type::TYPE_FLOAT    => '\ProtobufMessage::PB_TYPE_FLOAT',
        FieldDescriptorProto_Type::TYPE_INT32    => '\ProtobufMessage::PB_TYPE_INT',
        FieldDescriptorProto_Type::TYPE_INT64    => '\ProtobufMessage::PB_TYPE_INT',
        FieldDescriptorProto_Type::TYPE_UINT32   => '\ProtobufMessage::PB_TYPE_INT',
        FieldDescriptorProto_Type::TYPE_UINT64   => '\ProtobufMessage::PB_TYPE_INT',
        FieldDescriptorProto_Type::TYPE_SINT32   => '\ProtobufMessage::PB_TYPE_SIGNED_INT',
        FieldDescriptorProto_Type::TYPE_SINT64   => '\ProtobufMessage::PB_TYPE_SIGNED_INT',
        FieldDescriptorProto_Type::TYPE_FIXED32  => '\ProtobufMessage::PB_TYPE_FIXED32',
        FieldDescriptorProto_Type::TYPE_FIXED64  => '\ProtobufMessage::PB_TYPE_FIXED64',
        FieldDescriptorProto_Type::TYPE_SFIXED32 => '\ProtobufMessage::PB_TYPE_FIXED32',
        FieldDescriptorProto_Type::TYPE_SFIXED64 => '\ProtobufMessage::PB_TYPE_FIXED64',
        FieldDescriptorProto_Type::TYPE_BOOL     => '\ProtobufMessage::PB_TYPE_BOOL',
        FieldDescriptorProto_Type::TYPE_STRING   => '\ProtobufMessage::PB_TYPE_STRING',
        FieldDescriptorProto_Type::TYPE_BYTES    => '\ProtobufMessage::PB_TYPE_STRING',
        FieldDescriptorProto_Type::TYPE_ENUM     => '\ProtobufMessage::PB_TYPE_INT',
    );

    private static $_phpTypesByProtobufType = array(
        FieldDescriptorProto_Type::TYPE_DOUBLE   => 'double',
        FieldDescriptorProto_Type::TYPE_FLOAT    => 'double',
        FieldDescriptorProto_Type::TYPE_INT32    => 'integer',
        FieldDescriptorProto_Type::TYPE_INT64    => 'integer',
        FieldDescriptorProto_Type::TYPE_UINT32   => 'integer',
        FieldDescriptorProto_Type::TYPE_UINT64   => 'integer',
        FieldDescriptorProto_Type::TYPE_SINT32   => 'integer',
        FieldDescriptorProto_Type::TYPE_SINT64   => 'integer',
        FieldDescriptorProto_Type::TYPE_FIXED32  => 'integer',
        FieldDescriptorProto_Type::TYPE_FIXED64  => 'integer',
        FieldDescriptorProto_Type::TYPE_SFIXED32 => 'integer',
        FieldDescriptorProto_Type::TYPE_SFIXED64 => 'integer',
        FieldDescriptorProto_Type::TYPE_BOOL     => 'boolean',
        FieldDescriptorProto_Type::TYPE_STRING   => 'string',
        FieldDescriptorProto_Type::TYPE_BYTES    => 'string',
        FieldDescriptorProto_Type::TYPE_ENUM     => 'integer',
        FieldDescriptorProto_Type::TYPE_MESSAGE  => 'object'
    );

    private $_default;
    private $_label;
    private $_name;
    private $_number;
    private $_packed;
    private $_type;
    private $_typeDescriptor = null;
    private $_typeName = null;

    /**
     * Returns default value
     *
     * @return string
     */
    public function getDefault()
    {
        return $this->_default;
    }

    /**
     * Returns label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->_label;
    }

    /**
     * Returns name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Returns camel case name
     *
     * @return string
     */
    public function getCamelCaseName()
    {
        $chunks = preg_split('/[^a-z0-9]/is', $this->getName());
        return implode('', array_map('ucfirst', $chunks));
    }

    /**
     * Returns const name
     *
     * @return string
     */
    public function getConstName()
    {
        $chunks = preg_split('/[^a-z0-9]/is', $this->getName());
        return implode('_', array_map('strtoupper', $chunks));
    }

    /**
     * Returns number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->_number;
    }

    /**
     * Returns scalar type
     *
     * @return int
     */
    public function getScalarInternalType()
    {
        return self::$_scalarInternalTypesByProtobufType[$this->_type];
    }

    /**
     * @return bool
     */
    public function isPacked()
    {
        return $this->_packed;
    }

    /**
     * Returns PHP type
     *
     * @return string|null
     */
    public function getPhpType()
    {
        if (isset(self::$_phpTypesByProtobufType[$this->_type])) {
            return self::$_phpTypesByProtobufType[$this->_type];
        } else {
            return null;
        }
    }

    /**
     * Returns type descriptor
     *
     * @return DescriptorInterface
     */
    public function getTypeDescriptor()
    {
        return $this->_typeDescriptor;
    }

    /**
     * Returns type name
     *
     * @return string|null
     */
    public function getTypeName()
    {
        return $this->_typeName;
    }

    /**
     * Returns type
     *
     * @return int
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Returns true if field is repeated
     *
     * @return bool
     */
    public function isRepeated()
    {
        return $this->_label == FieldDescriptorProto_Label::LABEL_REPEATED;
    }

    /**
     * Returns true if is required
     *
     * @return bool
     */
    public function isRequired()
    {
        return $this->_label == FieldDescriptorProto_Label::LABEL_REQUIRED;
    }

    /**
     * Returns true if is optional
     *
     * @return bool
     */
    public function isOptional()
    {
        return $this->_label == FieldDescriptorProto_Label::LABEL_OPTIONAL;
    }

    /**
     * Returns true if a field is an enum
     */
    public function isEnum()
    {
        return $this->_type == FieldDescriptorProto_Type::TYPE_ENUM;
    }

    /**
     * Sets default value
     *
     * @param mixed $default Default value
     *
     * @return null
     */
    public function setDefault($default)
    {
        $this->_default = $default;
    }

    /**
     * Sets label
     *
     * @param string $label Label
     *
     * @return null
     */
    public function setLabel($label)
    {
        $this->_label = $label;
    }

    /**
     * Sets name
     *
     * @param string $name Name
     *
     * @return null
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * Sets number
     *
     * @param int $number Number
     *
     * @return null
     */
    public function setNumber($number)
    {
        $this->_number = $number;
    }

    /**
     * @param bool $packed
     *
     * @return null
     */
    public function setPacked($packed)
    {
        $this->_packed = $packed;
    }

    /**
     * Sets type
     *
     * @param int $type Type
     *
     * @return null
     */
    public function setType($type)
    {
        $this->_type = $type;
    }

    /**
     * Sets type descriptor
     *
     * @param DescriptorInterface $typeDescriptor
     *
     * @return null
     */
    public function setTypeDescriptor($typeDescriptor)
    {
        $this->_typeDescriptor = $typeDescriptor;
    }

    /**
     * Sets type name
     *
     * @param string $typeName Type name
     *
     * @return null
     */
    public function setTypeName($typeName)
    {
        $this->_typeName = $typeName;
    }
}
