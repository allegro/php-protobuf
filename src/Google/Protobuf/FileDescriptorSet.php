<?php
/**
 * Auto generated from descriptor.proto at 2016-07-08 14:22:37
 *
 * google.protobuf package
 */

namespace Google\Protobuf {
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
            'type' => '\Google\Protobuf\FileDescriptorProto'
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
     * @param \Google\Protobuf\FileDescriptorProto $value Value to append
     *
     * @return null
     */
    public function appendFile(\Google\Protobuf\FileDescriptorProto $value)
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
     * @return \Google\Protobuf\FileDescriptorProto[]
     */
    public function getFile()
    {
        return $this->get(self::FILE);
    }

    /**
     * Returns 'file' iterator
     *
     * @return \ArrayIterator
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
     * @return \Google\Protobuf\FileDescriptorProto
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
}