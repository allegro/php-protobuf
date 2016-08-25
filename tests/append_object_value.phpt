--TEST--
Protocol Buffers appending object value
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Foo.php';
require 'Bar.php';

$barDestructed = false;

class SpiedBar extends Bar {
    public function __destruct() {
        global $barDestructed;
        $barDestructed = true;
    }
}

$bar = new SpiedBar();
$bar->setDoubleField(1.0);

$foo = new Foo();
$foo->appendRepeatedObjField($bar);

$values = $foo->getRepeatedObjField();
var_dump(count($values));
var_dump($values[0] === $bar);
$values = null;

$foo->clearRepeatedObjField();
var_dump($barDestructed);

$bar = null;
var_dump($barDestructed);
?>
--EXPECT--
int(1)
bool(true)
bool(false)
bool(true)
