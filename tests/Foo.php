<?php
/**
 * Auto generated from test.proto at 2016-08-15 23:40:08
 */

namespace {
/**
 * Foo message
 */
class Foo extends \ProtobufMessage
{
    /* Field index constants */
    const DOUBLE_FIELD = 1;
    const FLOAT_FIELD = 2;
    const INT32_FIELD = 3;
    const INT64_FIELD = 4;
    const UINT32_FIELD = 5;
    const UINT64_FIELD = 6;
    const SINT32_FIELD = 7;
    const SINT64_FIELD = 8;
    const FIXED32_FIELD = 9;
    const FIXED64_FIELD = 10;
    const SFIXED32_FIELD = 11;
    const SFIXED64_FIELD = 12;
    const BOOL_FIELD = 13;
    const STRING_FIELD = 14;
    const BYTES_FIELD = 15;
    const REPEATED_FIELD = 16;
    const EMBEDDED_FIELD = 17;
    const DOUBLE_PACKED_FIELD = 18;
    const FLOAT_PACKED_FIELD = 19;
    const FIXED32_PACKED_FIELD = 20;
    const FIXED64_PACKED_FIELD = 21;
    const INT32_PACKED_FIELD = 22;
    const SINT32_PACKED_FIELD = 23;
    const BOOL_PACKED_FIELD = 24;
    const OPTIONAL_EMBEDDED_FIELD = 25;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::DOUBLE_FIELD => array(
            'name' => 'double_field',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_DOUBLE,
        ),
        self::FLOAT_FIELD => array(
            'name' => 'float_field',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
        ),
        self::INT32_FIELD => array(
            'name' => 'int32_field',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::INT64_FIELD => array(
            'name' => 'int64_field',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::UINT32_FIELD => array(
            'name' => 'uint32_field',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::UINT64_FIELD => array(
            'name' => 'uint64_field',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::SINT32_FIELD => array(
            'name' => 'sint32_field',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_SIGNED_INT,
        ),
        self::SINT64_FIELD => array(
            'name' => 'sint64_field',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_SIGNED_INT,
        ),
        self::FIXED32_FIELD => array(
            'name' => 'fixed32_field',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FIXED32,
        ),
        self::FIXED64_FIELD => array(
            'name' => 'fixed64_field',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FIXED64,
        ),
        self::SFIXED32_FIELD => array(
            'name' => 'sfixed32_field',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FIXED32,
        ),
        self::SFIXED64_FIELD => array(
            'name' => 'sfixed64_field',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_FIXED64,
        ),
        self::BOOL_FIELD => array(
            'name' => 'bool_field',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
        ),
        self::STRING_FIELD => array(
            'name' => 'string_field',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::BYTES_FIELD => array(
            'name' => 'bytes_field',
            'required' => false,
            'type' => \ProtobufMessage::PB_TYPE_STRING,
        ),
        self::REPEATED_FIELD => array(
            'name' => 'repeated_field',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
        ),
        self::EMBEDDED_FIELD => array(
            'name' => 'embedded_field',
            'required' => false,
            'type' => '\Bar'
        ),
        self::DOUBLE_PACKED_FIELD => array(
            'name' => 'double_packed_field',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_DOUBLE,
            'packed' => true
        ),
        self::FLOAT_PACKED_FIELD => array(
            'name' => 'float_packed_field',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_FLOAT,
            'packed' => true
        ),
        self::FIXED32_PACKED_FIELD => array(
            'name' => 'fixed32_packed_field',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_FIXED32,
            'packed' => true
        ),
        self::FIXED64_PACKED_FIELD => array(
            'name' => 'fixed64_packed_field',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_FIXED64,
            'packed' => true
        ),
        self::INT32_PACKED_FIELD => array(
            'name' => 'int32_packed_field',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_INT,
            'packed' => true
        ),
        self::SINT32_PACKED_FIELD => array(
            'name' => 'sint32_packed_field',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_SIGNED_INT,
            'packed' => true
        ),
        self::BOOL_PACKED_FIELD => array(
            'name' => 'bool_packed_field',
            'repeated' => true,
            'type' => \ProtobufMessage::PB_TYPE_BOOL,
            'packed' => true
        ),
        self::OPTIONAL_EMBEDDED_FIELD => array(
            'name' => 'optional_embedded_field',
            'required' => false,
            'type' => '\Baz'
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
        $this->values[self::DOUBLE_FIELD] = null;
        $this->values[self::FLOAT_FIELD] = null;
        $this->values[self::INT32_FIELD] = null;
        $this->values[self::INT64_FIELD] = null;
        $this->values[self::UINT32_FIELD] = null;
        $this->values[self::UINT64_FIELD] = null;
        $this->values[self::SINT32_FIELD] = null;
        $this->values[self::SINT64_FIELD] = null;
        $this->values[self::FIXED32_FIELD] = null;
        $this->values[self::FIXED64_FIELD] = null;
        $this->values[self::SFIXED32_FIELD] = null;
        $this->values[self::SFIXED64_FIELD] = null;
        $this->values[self::BOOL_FIELD] = null;
        $this->values[self::STRING_FIELD] = null;
        $this->values[self::BYTES_FIELD] = null;
        $this->values[self::REPEATED_FIELD] = array();
        $this->values[self::EMBEDDED_FIELD] = null;
        $this->values[self::DOUBLE_PACKED_FIELD] = array();
        $this->values[self::FLOAT_PACKED_FIELD] = array();
        $this->values[self::FIXED32_PACKED_FIELD] = array();
        $this->values[self::FIXED64_PACKED_FIELD] = array();
        $this->values[self::INT32_PACKED_FIELD] = array();
        $this->values[self::SINT32_PACKED_FIELD] = array();
        $this->values[self::BOOL_PACKED_FIELD] = array();
        $this->values[self::OPTIONAL_EMBEDDED_FIELD] = null;
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
     * Sets value of 'double_field' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setDoubleField($value)
    {
        return $this->set(self::DOUBLE_FIELD, $value);
    }

    /**
     * Returns value of 'double_field' property
     *
     * @return double
     */
    public function getDoubleField()
    {
        return $this->get(self::DOUBLE_FIELD);
    }

    /**
     * Sets value of 'float_field' property
     *
     * @param double $value Property value
     *
     * @return null
     */
    public function setFloatField($value)
    {
        return $this->set(self::FLOAT_FIELD, $value);
    }

    /**
     * Returns value of 'float_field' property
     *
     * @return double
     */
    public function getFloatField()
    {
        return $this->get(self::FLOAT_FIELD);
    }

    /**
     * Sets value of 'int32_field' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setInt32Field($value)
    {
        return $this->set(self::INT32_FIELD, $value);
    }

    /**
     * Returns value of 'int32_field' property
     *
     * @return integer
     */
    public function getInt32Field()
    {
        return $this->get(self::INT32_FIELD);
    }

    /**
     * Sets value of 'int64_field' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setInt64Field($value)
    {
        return $this->set(self::INT64_FIELD, $value);
    }

    /**
     * Returns value of 'int64_field' property
     *
     * @return integer
     */
    public function getInt64Field()
    {
        return $this->get(self::INT64_FIELD);
    }

    /**
     * Sets value of 'uint32_field' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setUint32Field($value)
    {
        return $this->set(self::UINT32_FIELD, $value);
    }

    /**
     * Returns value of 'uint32_field' property
     *
     * @return integer
     */
    public function getUint32Field()
    {
        return $this->get(self::UINT32_FIELD);
    }

    /**
     * Sets value of 'uint64_field' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setUint64Field($value)
    {
        return $this->set(self::UINT64_FIELD, $value);
    }

    /**
     * Returns value of 'uint64_field' property
     *
     * @return integer
     */
    public function getUint64Field()
    {
        return $this->get(self::UINT64_FIELD);
    }

    /**
     * Sets value of 'sint32_field' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSint32Field($value)
    {
        return $this->set(self::SINT32_FIELD, $value);
    }

    /**
     * Returns value of 'sint32_field' property
     *
     * @return integer
     */
    public function getSint32Field()
    {
        return $this->get(self::SINT32_FIELD);
    }

    /**
     * Sets value of 'sint64_field' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSint64Field($value)
    {
        return $this->set(self::SINT64_FIELD, $value);
    }

    /**
     * Returns value of 'sint64_field' property
     *
     * @return integer
     */
    public function getSint64Field()
    {
        return $this->get(self::SINT64_FIELD);
    }

    /**
     * Sets value of 'fixed32_field' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setFixed32Field($value)
    {
        return $this->set(self::FIXED32_FIELD, $value);
    }

    /**
     * Returns value of 'fixed32_field' property
     *
     * @return integer
     */
    public function getFixed32Field()
    {
        return $this->get(self::FIXED32_FIELD);
    }

    /**
     * Sets value of 'fixed64_field' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setFixed64Field($value)
    {
        return $this->set(self::FIXED64_FIELD, $value);
    }

    /**
     * Returns value of 'fixed64_field' property
     *
     * @return integer
     */
    public function getFixed64Field()
    {
        return $this->get(self::FIXED64_FIELD);
    }

    /**
     * Sets value of 'sfixed32_field' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSfixed32Field($value)
    {
        return $this->set(self::SFIXED32_FIELD, $value);
    }

    /**
     * Returns value of 'sfixed32_field' property
     *
     * @return integer
     */
    public function getSfixed32Field()
    {
        return $this->get(self::SFIXED32_FIELD);
    }

    /**
     * Sets value of 'sfixed64_field' property
     *
     * @param integer $value Property value
     *
     * @return null
     */
    public function setSfixed64Field($value)
    {
        return $this->set(self::SFIXED64_FIELD, $value);
    }

    /**
     * Returns value of 'sfixed64_field' property
     *
     * @return integer
     */
    public function getSfixed64Field()
    {
        return $this->get(self::SFIXED64_FIELD);
    }

    /**
     * Sets value of 'bool_field' property
     *
     * @param boolean $value Property value
     *
     * @return null
     */
    public function setBoolField($value)
    {
        return $this->set(self::BOOL_FIELD, $value);
    }

    /**
     * Returns value of 'bool_field' property
     *
     * @return boolean
     */
    public function getBoolField()
    {
        return $this->get(self::BOOL_FIELD);
    }

    /**
     * Sets value of 'string_field' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setStringField($value)
    {
        return $this->set(self::STRING_FIELD, $value);
    }

    /**
     * Returns value of 'string_field' property
     *
     * @return string
     */
    public function getStringField()
    {
        return $this->get(self::STRING_FIELD);
    }

    /**
     * Sets value of 'bytes_field' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setBytesField($value)
    {
        return $this->set(self::BYTES_FIELD, $value);
    }

    /**
     * Returns value of 'bytes_field' property
     *
     * @return string
     */
    public function getBytesField()
    {
        return $this->get(self::BYTES_FIELD);
    }

    /**
     * Appends value to 'repeated_field' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendRepeatedField($value)
    {
        return $this->append(self::REPEATED_FIELD, $value);
    }

    /**
     * Clears 'repeated_field' list
     *
     * @return null
     */
    public function clearRepeatedField()
    {
        return $this->clear(self::REPEATED_FIELD);
    }

    /**
     * Returns 'repeated_field' list
     *
     * @return integer[]
     */
    public function getRepeatedField()
    {
        return $this->get(self::REPEATED_FIELD);
    }

    /**
     * Returns 'repeated_field' iterator
     *
     * @return \ArrayIterator
     */
    public function getRepeatedFieldIterator()
    {
        return new \ArrayIterator($this->get(self::REPEATED_FIELD));
    }

    /**
     * Returns element from 'repeated_field' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getRepeatedFieldAt($offset)
    {
        return $this->get(self::REPEATED_FIELD, $offset);
    }

    /**
     * Returns count of 'repeated_field' list
     *
     * @return int
     */
    public function getRepeatedFieldCount()
    {
        return $this->count(self::REPEATED_FIELD);
    }

    /**
     * Sets value of 'embedded_field' property
     *
     * @param \Bar $value Property value
     *
     * @return null
     */
    public function setEmbeddedField(\Bar $value=null)
    {
        return $this->set(self::EMBEDDED_FIELD, $value);
    }

    /**
     * Returns value of 'embedded_field' property
     *
     * @return \Bar
     */
    public function getEmbeddedField()
    {
        return $this->get(self::EMBEDDED_FIELD);
    }

    /**
     * Appends value to 'double_packed_field' list
     *
     * @param double $value Value to append
     *
     * @return null
     */
    public function appendDoublePackedField($value)
    {
        return $this->append(self::DOUBLE_PACKED_FIELD, $value);
    }

    /**
     * Clears 'double_packed_field' list
     *
     * @return null
     */
    public function clearDoublePackedField()
    {
        return $this->clear(self::DOUBLE_PACKED_FIELD);
    }

    /**
     * Returns 'double_packed_field' list
     *
     * @return double[]
     */
    public function getDoublePackedField()
    {
        return $this->get(self::DOUBLE_PACKED_FIELD);
    }

    /**
     * Returns 'double_packed_field' iterator
     *
     * @return \ArrayIterator
     */
    public function getDoublePackedFieldIterator()
    {
        return new \ArrayIterator($this->get(self::DOUBLE_PACKED_FIELD));
    }

    /**
     * Returns element from 'double_packed_field' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return double
     */
    public function getDoublePackedFieldAt($offset)
    {
        return $this->get(self::DOUBLE_PACKED_FIELD, $offset);
    }

    /**
     * Returns count of 'double_packed_field' list
     *
     * @return int
     */
    public function getDoublePackedFieldCount()
    {
        return $this->count(self::DOUBLE_PACKED_FIELD);
    }

    /**
     * Appends value to 'float_packed_field' list
     *
     * @param double $value Value to append
     *
     * @return null
     */
    public function appendFloatPackedField($value)
    {
        return $this->append(self::FLOAT_PACKED_FIELD, $value);
    }

    /**
     * Clears 'float_packed_field' list
     *
     * @return null
     */
    public function clearFloatPackedField()
    {
        return $this->clear(self::FLOAT_PACKED_FIELD);
    }

    /**
     * Returns 'float_packed_field' list
     *
     * @return double[]
     */
    public function getFloatPackedField()
    {
        return $this->get(self::FLOAT_PACKED_FIELD);
    }

    /**
     * Returns 'float_packed_field' iterator
     *
     * @return \ArrayIterator
     */
    public function getFloatPackedFieldIterator()
    {
        return new \ArrayIterator($this->get(self::FLOAT_PACKED_FIELD));
    }

    /**
     * Returns element from 'float_packed_field' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return double
     */
    public function getFloatPackedFieldAt($offset)
    {
        return $this->get(self::FLOAT_PACKED_FIELD, $offset);
    }

    /**
     * Returns count of 'float_packed_field' list
     *
     * @return int
     */
    public function getFloatPackedFieldCount()
    {
        return $this->count(self::FLOAT_PACKED_FIELD);
    }

    /**
     * Appends value to 'fixed32_packed_field' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendFixed32PackedField($value)
    {
        return $this->append(self::FIXED32_PACKED_FIELD, $value);
    }

    /**
     * Clears 'fixed32_packed_field' list
     *
     * @return null
     */
    public function clearFixed32PackedField()
    {
        return $this->clear(self::FIXED32_PACKED_FIELD);
    }

    /**
     * Returns 'fixed32_packed_field' list
     *
     * @return integer[]
     */
    public function getFixed32PackedField()
    {
        return $this->get(self::FIXED32_PACKED_FIELD);
    }

    /**
     * Returns 'fixed32_packed_field' iterator
     *
     * @return \ArrayIterator
     */
    public function getFixed32PackedFieldIterator()
    {
        return new \ArrayIterator($this->get(self::FIXED32_PACKED_FIELD));
    }

    /**
     * Returns element from 'fixed32_packed_field' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getFixed32PackedFieldAt($offset)
    {
        return $this->get(self::FIXED32_PACKED_FIELD, $offset);
    }

    /**
     * Returns count of 'fixed32_packed_field' list
     *
     * @return int
     */
    public function getFixed32PackedFieldCount()
    {
        return $this->count(self::FIXED32_PACKED_FIELD);
    }

    /**
     * Appends value to 'fixed64_packed_field' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendFixed64PackedField($value)
    {
        return $this->append(self::FIXED64_PACKED_FIELD, $value);
    }

    /**
     * Clears 'fixed64_packed_field' list
     *
     * @return null
     */
    public function clearFixed64PackedField()
    {
        return $this->clear(self::FIXED64_PACKED_FIELD);
    }

    /**
     * Returns 'fixed64_packed_field' list
     *
     * @return integer[]
     */
    public function getFixed64PackedField()
    {
        return $this->get(self::FIXED64_PACKED_FIELD);
    }

    /**
     * Returns 'fixed64_packed_field' iterator
     *
     * @return \ArrayIterator
     */
    public function getFixed64PackedFieldIterator()
    {
        return new \ArrayIterator($this->get(self::FIXED64_PACKED_FIELD));
    }

    /**
     * Returns element from 'fixed64_packed_field' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getFixed64PackedFieldAt($offset)
    {
        return $this->get(self::FIXED64_PACKED_FIELD, $offset);
    }

    /**
     * Returns count of 'fixed64_packed_field' list
     *
     * @return int
     */
    public function getFixed64PackedFieldCount()
    {
        return $this->count(self::FIXED64_PACKED_FIELD);
    }

    /**
     * Appends value to 'int32_packed_field' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendInt32PackedField($value)
    {
        return $this->append(self::INT32_PACKED_FIELD, $value);
    }

    /**
     * Clears 'int32_packed_field' list
     *
     * @return null
     */
    public function clearInt32PackedField()
    {
        return $this->clear(self::INT32_PACKED_FIELD);
    }

    /**
     * Returns 'int32_packed_field' list
     *
     * @return integer[]
     */
    public function getInt32PackedField()
    {
        return $this->get(self::INT32_PACKED_FIELD);
    }

    /**
     * Returns 'int32_packed_field' iterator
     *
     * @return \ArrayIterator
     */
    public function getInt32PackedFieldIterator()
    {
        return new \ArrayIterator($this->get(self::INT32_PACKED_FIELD));
    }

    /**
     * Returns element from 'int32_packed_field' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getInt32PackedFieldAt($offset)
    {
        return $this->get(self::INT32_PACKED_FIELD, $offset);
    }

    /**
     * Returns count of 'int32_packed_field' list
     *
     * @return int
     */
    public function getInt32PackedFieldCount()
    {
        return $this->count(self::INT32_PACKED_FIELD);
    }

    /**
     * Appends value to 'sint32_packed_field' list
     *
     * @param integer $value Value to append
     *
     * @return null
     */
    public function appendSint32PackedField($value)
    {
        return $this->append(self::SINT32_PACKED_FIELD, $value);
    }

    /**
     * Clears 'sint32_packed_field' list
     *
     * @return null
     */
    public function clearSint32PackedField()
    {
        return $this->clear(self::SINT32_PACKED_FIELD);
    }

    /**
     * Returns 'sint32_packed_field' list
     *
     * @return integer[]
     */
    public function getSint32PackedField()
    {
        return $this->get(self::SINT32_PACKED_FIELD);
    }

    /**
     * Returns 'sint32_packed_field' iterator
     *
     * @return \ArrayIterator
     */
    public function getSint32PackedFieldIterator()
    {
        return new \ArrayIterator($this->get(self::SINT32_PACKED_FIELD));
    }

    /**
     * Returns element from 'sint32_packed_field' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return integer
     */
    public function getSint32PackedFieldAt($offset)
    {
        return $this->get(self::SINT32_PACKED_FIELD, $offset);
    }

    /**
     * Returns count of 'sint32_packed_field' list
     *
     * @return int
     */
    public function getSint32PackedFieldCount()
    {
        return $this->count(self::SINT32_PACKED_FIELD);
    }

    /**
     * Appends value to 'bool_packed_field' list
     *
     * @param boolean $value Value to append
     *
     * @return null
     */
    public function appendBoolPackedField($value)
    {
        return $this->append(self::BOOL_PACKED_FIELD, $value);
    }

    /**
     * Clears 'bool_packed_field' list
     *
     * @return null
     */
    public function clearBoolPackedField()
    {
        return $this->clear(self::BOOL_PACKED_FIELD);
    }

    /**
     * Returns 'bool_packed_field' list
     *
     * @return boolean[]
     */
    public function getBoolPackedField()
    {
        return $this->get(self::BOOL_PACKED_FIELD);
    }

    /**
     * Returns 'bool_packed_field' iterator
     *
     * @return \ArrayIterator
     */
    public function getBoolPackedFieldIterator()
    {
        return new \ArrayIterator($this->get(self::BOOL_PACKED_FIELD));
    }

    /**
     * Returns element from 'bool_packed_field' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return boolean
     */
    public function getBoolPackedFieldAt($offset)
    {
        return $this->get(self::BOOL_PACKED_FIELD, $offset);
    }

    /**
     * Returns count of 'bool_packed_field' list
     *
     * @return int
     */
    public function getBoolPackedFieldCount()
    {
        return $this->count(self::BOOL_PACKED_FIELD);
    }

    /**
     * Sets value of 'optional_embedded_field' property
     *
     * @param \Baz $value Property value
     *
     * @return null
     */
    public function setOptionalEmbeddedField(\Baz $value=null)
    {
        return $this->set(self::OPTIONAL_EMBEDDED_FIELD, $value);
    }

    /**
     * Returns value of 'optional_embedded_field' property
     *
     * @return \Baz
     */
    public function getOptionalEmbeddedField()
    {
        return $this->get(self::OPTIONAL_EMBEDDED_FIELD);
    }
}
}