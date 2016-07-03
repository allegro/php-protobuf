--TEST--
Protocol Buffers simple field serialization
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';

function serialize_field($field, $value)
{
	$foo = new Foo();
	$setter = 'set' . ucfirst($field) . 'Field';
	$foo->{$setter}($value);

	var_dump($foo->serializeToString());
}

serialize_field('double', 2.0);
serialize_field('float', 3.0);
serialize_field('int32', 4);
serialize_field('int64', 5);
serialize_field('uint32', 6);
serialize_field('uint64', 7);
serialize_field('sint32', 8);
serialize_field('sint64', 9);
serialize_field('fixed32', 10);
serialize_field('fixed64', 11);
serialize_field('sfixed32', 12);
serialize_field('sfixed64', 13);
serialize_field('bool', True);
serialize_field('string', '15');
serialize_field('bytes', '16');
?>
--EXPECTREGEX--
string\(9\) \"\x9\x0\x0\x0\x0\x0\x0\x0\x40\"
string\(5\) \"\x15\x0\x0\x40\x40\"
string\(2\) \"\x18\x4\"
string\(2\) \"\x20\x5\"
string\(2\) \"\x28\x6\"
string\(2\) \"\x30\x7\"
string\(2\) \"\x38\x10\"
string\(2\) \"\x40\x12\"
string\(5\) \"\x4D\xA\x0\x0\x0\"
string\(9\) \"\x51\xB\x0\x0\x0\x0\x0\x0\x0\"
string\(5\) \"\x5D\xC\x0\x0\x0\"
string\(9\) \"\x61\xD\x0\x0\x0\x0\x0\x0\x0\"
string\(2\) \"\x68\x1\"
string\(4\) \"\x72\x2\x31\x35\"
string\(4\) \"\x7A\x2\x31\x36\"
