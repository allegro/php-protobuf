<?php
/**
 * Auto generated from descriptor.proto at 2016-07-08 14:22:37
 *
 * google.protobuf package
 */

namespace Google\Protobuf {
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
            'type' => '\Google\Protobuf\GeneratedCodeInfo_Annotation'
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
     * @param \Google\Protobuf\GeneratedCodeInfo_Annotation $value Value to append
     *
     * @return null
     */
    public function appendAnnotation(\Google\Protobuf\GeneratedCodeInfo_Annotation $value)
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
     * @return \Google\Protobuf\GeneratedCodeInfo_Annotation[]
     */
    public function getAnnotation()
    {
        return $this->get(self::ANNOTATION);
    }

    /**
     * Returns 'annotation' iterator
     *
     * @return \ArrayIterator
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
     * @return \Google\Protobuf\GeneratedCodeInfo_Annotation
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
}