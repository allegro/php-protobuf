<?php
/**
 * Auto generated from foo.proto at 2013-11-20 11:12:53
 */

/**
 * Foo message
 */
class Foo extends \ProtobufMessage
{
    /* Field index constants */
    const BAR = 1;
    const BAZ = 2;
    const SPAM = 3;

    /* @var array Field descriptors */
    protected static $fields = array(
        self::BAR => array(
            'name' => 'bar',
            'required' => true,
            'type' => 5,
        ),
        self::BAZ => array(
            'name' => 'baz',
            'required' => false,
            'type' => 7,
        ),
        self::SPAM => array(
            'name' => 'spam',
            'repeated' => true,
            'type' => 4,
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
        $this->values[self::BAR] = null;
        $this->values[self::BAZ] = null;
        $this->values[self::SPAM] = array();
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
     * Sets value of 'bar' property
     *
     * @param int $value Property value
     *
     * @return null
     */
    public function setBar($value)
    {
        return $this->set(self::BAR, $value);
    }

    /**
     * Returns value of 'bar' property
     *
     * @return int
     */
    public function getBar()
    {
        return $this->get(self::BAR);
    }

    /**
     * Sets value of 'baz' property
     *
     * @param string $value Property value
     *
     * @return null
     */
    public function setBaz($value)
    {
        return $this->set(self::BAZ, $value);
    }

    /**
     * Returns value of 'baz' property
     *
     * @return string
     */
    public function getBaz()
    {
        return $this->get(self::BAZ);
    }

    /**
     * Appends value to 'spam' list
     *
     * @param float $value Value to append
     *
     * @return null
     */
    public function appendSpam($value)
    {
        return $this->append(self::SPAM, $value);
    }

    /**
     * Clears 'spam' list
     *
     * @return null
     */
    public function clearSpam()
    {
        return $this->clear(self::SPAM);
    }

    /**
     * Returns 'spam' list
     *
     * @return float[]
     */
    public function getSpam()
    {
        return $this->get(self::SPAM);
    }

    /**
     * Returns 'spam' iterator
     *
     * @return ArrayIterator
     */
    public function getSpamIterator()
    {
        return new \ArrayIterator($this->get(self::SPAM));
    }

    /**
     * Returns element from 'spam' list at given offset
     *
     * @param int $offset Position in list
     *
     * @return float
     */
    public function getSpamAt($offset)
    {
        return $this->get(self::SPAM, $offset);
    }

    /**
     * Returns count of 'spam' list
     *
     * @return int
     */
    public function getSpamCount()
    {
        return $this->count(self::SPAM);
    }
}
