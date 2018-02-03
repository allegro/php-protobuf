--TEST--
Protocol Buffers object with missing fields serialization and parsing
--SKIPIF--
<?php require 'skipif.inc' ?>
--FILE--
<?php
require 'Bar.php';

$B = new Bar();
$B->setLastField("last");
$B->setDoubleField(123);
$B->setIntField(22);

$data = $B->serializeToString();
echo base64_encode($data);
?>
--EXPECT--
CQAAAAAAwF5AEBaSBARsYXN0

