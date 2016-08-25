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
$intValue = 3;
$foo->setDoubleField($intValue);
var_dump($intValue);
var_dump($foo->getDoubleField());

/* from string type */
$stringValue = '4';
$foo->setDoubleField($stringValue);
var_dump($stringValue);
var_dump($foo->getDoubleField());
?>
--EXPECT--
float(2)
int(3)
float(3)
string(1) "4"
float(4)
