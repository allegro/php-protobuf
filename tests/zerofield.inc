<?php
/**
 * Auto generated from example.proto at 2016-04-21 14:47:57
 */

/**
 * StringArray message
 */
class StringArray extends \ProtobufMessage
{
    /* Field index constants */
    const DATA = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::DATA => array(
            'name' => 'data',
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
        $this->values[self::DATA] = null;
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
     * Sets value of 'data' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setData($value)
    {
        return $this->set(self::DATA, $value);
    }

    /**
     * Returns value of 'data' property
     *
     * @return string
     */
    public function getData()
    {
        return $this->get(self::DATA);
    }
}

/**
 * ObjectArray message
 */
class ObjectArray extends \ProtobufMessage
{
    /* Field index constants */
    const OBJECT = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::OBJECT => array(
            'name' => 'object',
            'repeated' => true,
            'type' => 'StringArray'
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
        $this->values[self::OBJECT] = array();
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
     * Appends value to 'object' list
     *
     * @param StringArray $value Value to append
     *
     * @return null
     */
    public function appendObject(StringArray $value)
    {
        return $this->append(self::OBJECT, $value);
    }

    /**
     * Clears 'object' list
     *
     * @return null
     */
    public function clearObject()
    {
        return $this->clear(self::OBJECT);
    }

    /**
     * Returns 'object' list
     *
     * @return StringArray[]
     */
    public function getObject()
    {
        return $this->get(self::OBJECT);
    }

    /**
     * Returns 'object' iterator
     *
     * @return ArrayIterator
     */
    public function getObjectIterator()
    {
        return new \ArrayIterator($this->get(self::OBJECT));
    }

    /**
     * Returns element from 'object' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return StringArray
     */
    public function getObjectAt($offset)
    {
        return $this->get(self::OBJECT, $offset);
    }

    /**
     * Returns count of 'object' list
     *
     * @return int
     */
    public function getObjectCount()
    {
        return $this->count(self::OBJECT);
    }
}
