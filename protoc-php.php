<?php
require 'ProtobufCompiler/ProtobufParser.php';

if (!debug_backtrace()) {
    if (!class_exists('\ProtobufMessage')) {

        echo $argv[0] .
            ' requires protobuf extension installed to run' .
            PHP_EOL;

        exit(1);
    }

    $options = getopt('n', array(
        'use-namespaces'
    ));
    $useNamespaces = isset($options['use-namespaces']);

    $iterator = new \RegexIterator(new \ArrayIterator($argv), '/^-/');
    foreach ($iterator as $key => $value) {
        array_splice($argv, $key, 1);
    }

    if (count($argv) != 2) {
        printf('USAGE: %s PROTO_FILE' . PHP_EOL, $argv[0]);
        printf('       -n, --use-namespaces      Use native PHP namespaces' . PHP_EOL);
        exit(1);
    }

    $parser = new ProtobufParser($useNamespaces);
    $file = $argv[1];

    if (!file_exists($file)) {
        printf($file . ' does not exist' . PHP_EOL);
        exit(1);
    }

    if (!is_file($file)) {
        printf($file . ' is not a file' . PHP_EOL);
        exit(1);
    }

    try {
        $parser->parse($file);
    } catch (Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }
}
