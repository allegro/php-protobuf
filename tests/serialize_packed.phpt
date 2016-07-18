--TEST--
Protocol Buffers packed field serialization
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';

// double
$foo = new Foo();
$foo->appendDoublePackedField(1.0);
$foo->appendDoublePackedField(2.0);
var_dump($foo->serializeToString());

// float
$foo = new Foo();
$foo->appendFloatPackedField(1.0);
$foo->appendFloatPackedField(2.0);
var_dump($foo->serializeToString());

// fixed32
$foo = new Foo();
$foo->appendFixed32PackedField(1);
$foo->appendFixed32PackedField(2);
var_dump($foo->serializeToString());

// fixed64
$foo = new Foo();
$foo->appendFixed64PackedField(1);
$foo->appendFixed64PackedField(2);
var_dump($foo->serializeToString());

// int32
$foo = new Foo();
$foo->appendInt32PackedField(1);
$foo->appendInt32PackedField(255);
var_dump($foo->serializeToString());

// bool
$foo = new Foo();
$foo->appendBoolPackedField(false);
$foo->appendBoolPackedField(true);
var_dump($foo->serializeToString());

// sint32
$foo = new Foo();
$foo->appendSint32PackedField(-1);
$foo->appendSint32PackedField(255);
var_dump($foo->serializeToString());

?>
--EXPECTREGEX--
string\(19\) "\x92\x01\x10\x00\x00\x00\x00\x00\x00\xf0\x3f\x00\x00\x00\x00\x00\x00\x00\x40"
string\(11\) "\x9a\x01\x08\x00\x00\x80\x3f\x00\x00\x00\x40"
string\(11\) "\xa2\x01\x08\x01\x00\x00\x00\x02\x00\x00\x00"
string\(19\) "\xaa\x01\x10\x01\x00\x00\x00\x00\x00\x00\x00\x02\x00\x00\x00\x00\x00\x00\x00"
string\(6\) "\xb2\x01\x03\x01\xff\x01"
string\(5\) "\xc2\x01\x02\x00\x01"
string\(6\) "\xba\x01\x03\x01\xfe\x03"
