<?php

die("This is a stub file for IDEs, don't use it directly!");

abstract class ProtobufMessage
{
    const PB_TYPE_DOUBLE     = 1;
    const PB_TYPE_FIXED32    = 2;
    const PB_TYPE_FIXED64    = 3;
    const PB_TYPE_FLOAT      = 4;
    const PB_TYPE_INT        = 5;
    const PB_TYPE_SIGNED_INT = 6;
    const PB_TYPE_STRING     = 7;
    const PB_TYPE_BOOL       = 8;
    
    protected $values = array();

    /**
     * @return null
     */
    abstract public function reset();

    /**
     * @param int   $position
     * @param mixed $value
     * 
     * @return null
     */
    public function append($position, $value) {}

    /**
     * @param int $position
     * 
     * @return null
     */
    public function clear($position) {}

    /**
     * @param bool $onlySet
     * 
     * @return null
     */
    public function dump($onlySet = true) {}

    /**
     *
     * @return null
     */
    public function printDebugString() {}

    /**
     * @param int $position
     * 
     * @return int
     */
    public function count($position) {}

    /**
     * @param int      $position
     * @param int|null $offset
     *
     * @return mixed
     */
    public function get($position = -1, $offset = null) {}

    /**
     * @param string $packed
     * 
     * @throws Exception
     * 
     * @return mixed
     */
    public function parseFromString($packed) {}

    /**
     * @throws Exception
     *
     * @return string
     */
    public function serializeToString() {}

    /**
     * @param int   $position
     * @param mixed $value
     * 
     * @return null
     */
    public function set($position = -1, $value) {}
}
