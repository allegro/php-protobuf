<?php
require 'ProtobufCompiler/ProtobufParser.php';

if (!debug_backtrace()) {
    if (!class_exists('\ProtobufMessage')) {

        echo $argv[0] .
            ' requires protobuf extension installed to run' .
            PHP_EOL;

        exit(1);
    }

    $optionError = false;
    $useNamespaces = false;
    $filenamePrefix = false;

    $iterator = new \RegexIterator(new \ArrayIterator($argv), '/^-/');

    $shortOpts = "np:";
    $longOpts = array("use-namespaces", "filename-prefix:");

    $options = getOpt($shortOpts, $longOpts);

    foreach ($options as $key => $value) {
        switch ($key) {
            case 'n' :
            case 'use-namespaces' :
                $useNamespaces = true;
                break;
            case 'p':
            case 'filename-prefix' :
                $filenamePrefix = $value;
                if (strpos($value, '-') === 0) {
                    $optionError = true;
                }
                break;
            default :
                $optionError = true;
                break;
        }

        // Look for occurrences of -o (simple option with no value) or -o<val> (no space in between):
        if ($value === false) {
            while ($argvKey = array_search("-" . $key . $value, $GLOBALS['argv'])) {
                if ($argvKey) {
                    unset($GLOBALS['argv'][$argvKey]);
                }
            }
        }

        // Look for remaining occurrences of -o <val> (space in between):
        while($argvKey = array_search("-" . $key, $GLOBALS['argv'])) {
            if($argvKey) {
                unset($GLOBALS['argv'][$argvKey]);
                unset($GLOBALS['argv'][$argvKey + 1]);
            }
        }
    }

    if ($optionError || count($argv) != 2) {
        printf('USAGE: %s [OPTIONS] PROTO_FILE' . PHP_EOL, $argv[0]);
        printf('  -n, --use-namespaces              Use native PHP namespaces' . PHP_EOL);
        printf('  -p, --filename-prefix [PREFIX]    Specify a prefix for generated file names' . PHP_EOL);
        exit(1);
    }

    // Reindex argv
    $GLOBALS['argv'] = array_values($GLOBALS['argv']);

    $parser = new ProtobufParser($useNamespaces);

    if ($filenamePrefix !== false) {
        $parser->setFilenamePrefix($filenamePrefix);
    }

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
