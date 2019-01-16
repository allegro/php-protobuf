--TEST--
Protocol Buffers default value
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';

$foo = new Foo();
var_dump($foo->getStringFieldWithDefault());

$foo->setStringFieldWithDefault("baz");
var_dump($foo->getStringFieldWithDefault());

$foo->setStringFieldWithDefault(null);
var_dump($foo->getStringFieldWithDefault());
?>
--EXPECT--

string(3) "foo"
string(3) "baz"
string(3) "foo"