--TEST--
Protocol Buffers unset field default values
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';

$foo = new Foo();
var_dump($foo->getDoubleField());
var_dump($foo->getFloatField());
var_dump($foo->getInt32Field());
var_dump($foo->getInt64Field());
var_dump($foo->getUint32Field());
var_dump($foo->getUint64Field());
var_dump($foo->getSint32Field());
var_dump($foo->getSint64Field());
var_dump($foo->getFixed32Field());
var_dump($foo->getFixed64Field());
var_dump($foo->getSfixed32Field());
var_dump($foo->getSfixed64Field());
var_dump($foo->getBoolField());
var_dump($foo->getStringField());
var_dump($foo->getBytesField());
var_dump($foo->getRepeatedField());
var_dump($foo->getEmbeddedField());
?>
--EXPECT--
float(0)
float(0)
int(0)
int(0)
int(0)
int(0)
int(0)
int(0)
int(0)
int(0)
int(0)
int(0)
bool(false)
string(0) ""
string(0) ""
array(0) {
}
NULL