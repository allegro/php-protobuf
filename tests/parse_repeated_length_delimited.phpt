--TEST--
Protocol Buffers repeated field of length delimited items parsing
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';

$expected = new Foo();
$expected->appendRepeatedField('baz');
$expected->appendRepeatedField('bar');

$actual = new Foo();
$actual->parseFromString("\x80\x01\x00\x80\x01\x00");

var_dump($expected == $actual);
?>
--EXPECT--
bool(true)
