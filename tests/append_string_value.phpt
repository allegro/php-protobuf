--TEST--
Protocol Buffers appending string value
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';

$foo = new Foo();

/* from string type */
$foo->appendRepeatedStringField('2');

/* from float type */
$floatValue = 3.0;
$foo->appendRepeatedStringField($floatValue);
var_dump($floatValue);

/* from int type */
$intValue = 4;
$foo->appendRepeatedStringField($intValue);
var_dump($intValue);

/* from null */
$nullValue = null;
$foo->appendRepeatedStringField($nullValue);

$values = $foo->getRepeatedStringField();
var_dump(count($values));
var_dump($values[0]);
var_dump($values[1]);
var_dump($values[2]);
?>
--EXPECT--
float(3)
int(4)
int(3)
string(1) "2"
string(1) "3"
string(1) "4"
