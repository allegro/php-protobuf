--TEST--
Protocol Buffers repeated field accessors
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';

function check_repeated($foo, $expected)
{
	var_dump($foo->getRepeatedFieldCount());
	var_dump($expected == $foo->getRepeatedField());
	var_dump($expected == $foo->getRepeatedFieldIterator()->getArrayCopy());
}

/* empty */
$foo = new Foo();

check_repeated($foo, array());

/* two elements */
$foo->appendRepeatedField(2);
$foo->appendRepeatedField(3);

check_repeated($foo, array(2, 3));

var_dump($foo->getRepeatedFieldAt(0));
var_dump($foo->getRepeatedFieldAt(1));

/* clear */
$foo->clearRepeatedField();

check_repeated($foo, array());
?>
--EXPECT--
int(0)
bool(true)
bool(true)
int(2)
bool(true)
bool(true)
int(2)
int(3)
int(0)
bool(true)
bool(true)
