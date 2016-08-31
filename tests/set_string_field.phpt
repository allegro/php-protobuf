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
$intValue = 3;
$foo->setStringField($intValue);
var_dump($intValue);
var_dump($foo->getStringField());

/* from float type */
$floatValue = 4.0;
$foo->setStringField($floatValue);
var_dump($floatValue);
var_dump($foo->getStringField());
?>
--EXPECT--
string(1) "2"
int(3)
string(1) "3"
float(4)
string(1) "4"
