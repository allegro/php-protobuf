--TEST--
Protocol Buffers should output subfields even if they encode to 0 bytes.
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'zerofield.inc';

$obj = new ObjectArray();
$s1 = new StringArray(); $s1->setData("one"); $obj->appendObject($s1);
$s2 = new StringArray(); $s2->setData("two"); $obj->appendObject($s2);
$s3 = new StringArray(); $obj->appendObject($s3);

var_dump($obj->getObjectCount());

$ser = $obj->serializeToString();

$test = new ObjectArray();
$test->parseFromString($ser);

var_dump($test->getObjectCount());

?>
--EXPECT--
int(3)
int(3)
