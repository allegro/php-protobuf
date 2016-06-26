<?php
/**
 * Auto generated from descriptor.proto at 2016-06-26 19:19:31
 */

namespace Google\Protobuf\Compiler {
/**
 * Location message embedded in SourceCodeInfo message
 */
class SourceCodeInfo_Location extends \ProtobufMessage
{
    /* Field index constants */
    const LEADING_COMMENTS = 3;
    const TRAILING_COMMENTS = 4;
    const LEADING_DETACHED_COMMENTS = 6;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::LEADING_COMMENTS => array(
            'name' => 'leading_comments',
            'required' => false,
            'type' => 7,
        ),
        self::TRAILING_COMMENTS => array(
            'name' => 'trailing_comments',
            'required' => false,
            'type' => 7,
        ),
        self::LEADING_DETACHED_COMMENTS => array(
            'name' => 'leading_detached_comments',
            'repeated' => true,
            'type' => 7,
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
        $this->values[self::LEADING_COMMENTS] = null;
        $this->values[self::TRAILING_COMMENTS] = null;
        $this->values[self::LEADING_DETACHED_COMMENTS] = array();
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
     * Sets value of 'leading_comments' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setLeadingComments($value)
    {
        return $this->set(self::LEADING_COMMENTS, $value);
    }

    /**
     * Returns value of 'leading_comments' property
     *
     * @return string
     */
    public function getLeadingComments()
    {
        return $this->get(self::LEADING_COMMENTS);
    }

    /**
     * Sets value of 'trailing_comments' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setTrailingComments($value)
    {
        return $this->set(self::TRAILING_COMMENTS, $value);
    }

    /**
     * Returns value of 'trailing_comments' property
     *
     * @return string
     */
    public function getTrailingComments()
    {
        return $this->get(self::TRAILING_COMMENTS);
    }

    /**
     * Appends value to 'leading_detached_comments' list
     *
     * @param string $value Value to append
     *
     * @return null
     */
    public function appendLeadingDetachedComments($value)
    {
        return $this->append(self::LEADING_DETACHED_COMMENTS, $value);
    }

    /**
     * Clears 'leading_detached_comments' list
     *
     * @return null
     */
    public function clearLeadingDetachedComments()
    {
        return $this->clear(self::LEADING_DETACHED_COMMENTS);
    }

    /**
     * Returns 'leading_detached_comments' list
     *
     * @return string[]
     */
    public function getLeadingDetachedComments()
    {
        return $this->get(self::LEADING_DETACHED_COMMENTS);
    }

    /**
     * Returns 'leading_detached_comments' iterator
     *
     * @return \ArrayIterator
     */
    public function getLeadingDetachedCommentsIterator()
    {
        return new \ArrayIterator($this->get(self::LEADING_DETACHED_COMMENTS));
    }

    /**
     * Returns element from 'leading_detached_comments' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return string
     */
    public function getLeadingDetachedCommentsAt($offset)
    {
        return $this->get(self::LEADING_DETACHED_COMMENTS, $offset);
    }

    /**
     * Returns count of 'leading_detached_comments' list
     *
     * @return int
     */
    public function getLeadingDetachedCommentsCount()
    {
        return $this->count(self::LEADING_DETACHED_COMMENTS);
    }
}
}