--TEST--
Protocol Buffers setting integer value
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';

$foo = new Foo();

/* from int type */
$foo->setInt32Field(2);
var_dump($foo->getInt32Field());

/* from float type */
$floatValue = 3.0;
$foo->setInt32Field($floatValue);
var_dump($floatValue);
var_dump($foo->getInt32Field());

/* from string type */
$stringValue = '4';
$foo->setInt32Field($stringValue);
var_dump($stringValue);
var_dump($foo->getInt32Field());
?>
--EXPECT--
int(2)
float(3)
int(3)
string(1) "4"
int(4)
