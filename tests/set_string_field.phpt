--TEST--
Protocol Buffers setting string value
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';

$foo = new Foo();

/* from string type */
$foo->setStringField('2');
var_dump($foo->getStringField());

/* from int type */
$foo->setStringField(3);
var_dump($foo->getStringField());

/* from float type */
$foo->setStringField(4.0);
var_dump($foo->getStringField());
?>
--EXPECT--
string(1) "2"
string(1) "3"
string(1) "4"
