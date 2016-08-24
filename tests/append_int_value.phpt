--TEST--
Protocol Buffers appending integer value
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';

$foo = new Foo();

/* from int type */
$foo->appendInt32PackedField(2);

/* from float type */
$floatValue = 3.0;
$foo->appendInt32PackedField($floatValue);
var_dump($floatValue);

/* from string type */
$stringValue = '4';
$foo->appendInt32PackedField($stringValue);
var_dump($stringValue);

/* from null */
$nullValue = null;
$foo->appendInt32PackedField($nullValue);

$values = $foo->getInt32PackedField();
var_dump(count($values));
var_dump($values[0]);
var_dump($values[1]);
var_dump($values[2]);
?>
--EXPECT--
float(3)
string(1) "4"
int(3)
int(2)
int(3)
int(4)
