--TEST--
Protocol Buffers repeated field parsing
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';

$expected = new Foo();
$expected->appendRepeatedField(2);
$expected->appendRepeatedField(3);

$actual = new Foo();
$actual->parseFromString("\x80\x1\x2\x80\x1\x3");

var_dump($expected == $actual);
?>
--EXPECT--
bool(true)
