--TEST--
Protocol Buffers setting object value
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';
require 'Bar.php';

$embedded = new Bar();
$embedded->setDoubleField(2.0);

$foo = new Foo();
$foo->setEmbeddedField($embedded);

var_dump($embedded == $foo->getEmbeddedField());
?>
--EXPECT--
bool(true)
