--TEST--
Protocol Buffers embedded message parsing
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'test.inc';

$embedded = new Foo();
$embedded->setDoubleField(2.0);

$expected = new Foo();
$expected->setEmbeddedField($embedded);

$actual = new Foo();
$actual->parseFromString("\x8A\x1\x9\x9\x0\x0\x0\x0\x0\x0\x0\x40");

var_dump($expected == $actual);
?>
--EXPECT--
bool(true)
