--TEST--
Protocol Buffers parse boolean false value
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';

$expected = new Foo();

$expected->setBoolField(false);

$tmp = new Foo();
$tmp->parseFromString(base64_decode('aAA='));

$actual = new Foo();
$actual->parseFromString($tmp->serializeToString());

var_dump($expected == $actual);
?>
--EXPECT--
bool(true)
