--TEST--
Protocol Buffers appending floating-point value
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';

$foo = new Foo();

/* from float type */
$foo->appendFloatPackedField(2.0);

/* from int type */
$intValue = 3;
$foo->appendFloatPackedField($intValue);
var_dump($intValue);

/* from string type */
$stringValue = '4';
$foo->appendFloatPackedField($stringValue);
var_dump($stringValue);

/* from null */
$nullValue = null;
$foo->appendFloatPackedField($nullValue);

$values = $foo->getFloatPackedField();
var_dump(count($values));
var_dump($values[0]);
var_dump($values[1]);
var_dump($values[2]);
?>
--EXPECT--
int(3)
string(1) "4"
int(3)
float(2)
float(3)
float(4)
