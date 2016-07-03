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
$foo->setInt32Field(3.0);
var_dump($foo->getInt32Field());

/* from string type */
$foo->setInt32Field('4');
var_dump($foo->getInt32Field());
?>
--EXPECT--
int(2)
int(3)
int(4)
