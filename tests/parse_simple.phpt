--TEST--
Protocol Buffers simple field parsing
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';

function parse_field($field, $value, $packed)
{
	$expected = new Foo();
	$setter = 'set' . ucfirst($field) . 'Field';
	$expected->{$setter}($value);

	$actual = new Foo();
	$actual->parseFromString($packed);

	var_dump($expected == $actual);
}

parse_field('double', 2.0, "\x9\x0\x0\x0\x0\x0\x0\x0\x40");
parse_field('float', 3.0, "\x15\x0\x0\x40\x40");
parse_field('int32', 4, "\x18\x4");
parse_field('int64', 5, "\x20\x5");
parse_field('uint32', 6, "\x28\x6");
parse_field('uint64', 7, "\x30\x7");
parse_field('sint32', 8, "\x38\x10");
parse_field('sint64', 9, "\x40\x12");
parse_field('fixed32', 10, "\x4D\xA\x0\x0\x0");
parse_field('fixed64', 11, "\x51\xB\x0\x0\x0\x0\x0\x0\x0");
parse_field('sfixed32', 12, "\x5D\xC\x0\x0\x0");
parse_field('sfixed64', 13, "\x61\xD\x0\x0\x0\x0\x0\x0\x0");
parse_field('bool', True, "\x68\x1");
parse_field('string', '15', "\x72\x2\x31\x35");
parse_field('bytes', '16', "\x7A\x2\x31\x36");
?>
--EXPECT--
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
