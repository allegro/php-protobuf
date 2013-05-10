<?php
require_once 'pb_proto_foo.php';

$foo = new Foo();
$foo->setBar(1);
$foo->setBaz('two');
$foo->appendSpam(3.0);
$foo->appendSpam(4.0);

$packed = $foo->serializeToString();

$foo->clear();

try {
	$foo->parseFromString($packed);
} catch (Exception $ex) {
	die('Upss.. there is a bug in this example');
}

$foo->dump();
?>
