--TEST--
Protocol Buffers parseFromString throws Exception if string is not protobuf-encoded message
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';

$foo = new Foo();

try {
	$foo->parseFromString("this is not protobuf-encoded message");
} catch (Exception $ex) {
	var_dump($ex->getMessage());
}
?>
--EXPECTF--
%s
