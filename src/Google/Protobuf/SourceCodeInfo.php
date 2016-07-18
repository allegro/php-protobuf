<?php
/**
 * Auto generated from descriptor.proto at 2016-07-08 14:22:37
 *
 * google.protobuf package
 */

namespace Google\Protobuf {
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
            'type' => '\Google\Protobuf\SourceCodeInfo_Location'
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
     * @param \Google\Protobuf\SourceCodeInfo_Location $value Value to append
     *
     * @return null
     */
    public function appendLocation(\Google\Protobuf\SourceCodeInfo_Location $value)
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
     * @return \Google\Protobuf\SourceCodeInfo_Location[]
     */
    public function getLocation()
    {
        return $this->get(self::LOCATION);
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
     * @return \Google\Protobuf\SourceCodeInfo_Location
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
}