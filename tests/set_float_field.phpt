--TEST--
Protocol Buffers setting floating-point value
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';

$foo = new Foo();

/* from float type */
$foo->setDoubleField(2.0);
var_dump($foo->getDoubleField());

/* from int type */
$foo->setDoubleField(3);
var_dump($foo->getDoubleField());

/* from string type */
$foo->setDoubleField('4');
var_dump($foo->getDoubleField());
?>
--EXPECT--
float(2)
float(3)
float(4)
