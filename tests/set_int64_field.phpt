--TEST--
Protocol Buffers setting int64 values
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'test.inc';

$expected = new Foo();

$expected->setInt64Field(2147483650);
$expected->setSint64Field(2147483650);

$actual = new Foo();                    
$actual->parseFromString(base64_decode('IIKAgIAIQISAgIAQ'));

var_dump($expected == $actual);
?>
--EXPECT--
bool(true)
