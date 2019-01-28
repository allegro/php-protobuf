<?php
/**
 * Generated from descriptor.proto by the protocol buffer compiler. DO NOT EDIT!
 */

namespace Google\Protobuf;

/**
 * SourceCodeInfo message
 */
class SourceCodeInfo extends \Allegro\Protobuf\Internal\Message
{
    /* Field index constants */
    const LOCATION = 1;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::LOCATION => array(
            'name' => 'location',
            'repeated' => true,
            'type' => '\Google\Protobuf\SourceCodeInfo\Location'
        ),
    );

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
     * @param \Google\Protobuf\SourceCodeInfo\Location $value Value to append
     *
     * @return null
     */
    public function appendLocation(\Google\Protobuf\SourceCodeInfo\Location $value)
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
     * @return \Google\Protobuf\SourceCodeInfo\Location[]
     */
    public function getLocation()
    {
        return $this->get(self::LOCATION);
    }

    /**
     * Returns true if 'location' property is set, false otherwise
     *
     * @return boolean
     */
    public function hasLocation()
    {
        return count($this->get(self::LOCATION)) !== 0;
    }

    /**
     * Returns 'location' iterator
     *
     * @return \ArrayIterator
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
     * @return \Google\Protobuf\SourceCodeInfo\Location
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