--TEST--
Protocol Buffers repeated field serialization
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';

$foo = new Foo();
$foo->appendRepeatedField(2);
$foo->appendRepeatedField(3);

var_dump($foo->serializeToString());
?>
--EXPECTREGEX--
string\(6\) \"\x80\x1\x2\x80\x1\x3\"
