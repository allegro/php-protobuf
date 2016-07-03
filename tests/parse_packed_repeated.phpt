--TEST--
Protocol Buffers packed repeated field parsing
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'test.inc';

$expected = new Foo();
$expected->appendRepeatedField(1);
$expected->appendRepeatedField(2);
$expected->appendRepeatedField(3);

$actual = new Foo();
$actual->parseFromString("\x82\x01\x03\x01\x02\x03");

var_dump($expected == $actual);
?>
--EXPECT--
bool(true)
