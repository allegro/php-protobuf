--TEST--
Protocol Buffers test empty object (object with default prop
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';
require 'Baz.php';

$embedded = new Baz();

$foo = new Foo();
$foo->setOptionalEmbeddedField($embedded);

$serialized = $foo->serializeToString();

$parsed_foo = new Foo();
$parsed_foo->parseFromString($serialized);

var_dump($foo == $parsed_foo);
$parsed_foo->dump();
?>
--EXPECT--
bool(true)
Foo {
  25: optional_embedded_field =>
  Baz {
  }
}
