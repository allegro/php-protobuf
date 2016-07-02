#!/usr/bin/env php
<?php
$composerAutoload = __DIR__ . '/vendor/autoload.php';

if (!file_exists($composerAutoload)) {
    fputs(STDERR, 'ERROR: The dependencies are not installed.' . PHP_EOL);
    fputs(STDERR, '       Run "composer install" in order to install them.' . PHP_EOL);
    exit(1);
}

if (!extension_loaded('protobuf')) {
    fputs(STDERR, 'ERROR: protobuf module is not installed.' . PHP_EOL);
    exit(1);
}

require_once $composerAutoload;

spl_autoload_register(function($class)
    {
        $filename = implode(DIRECTORY_SEPARATOR, array(__DIR__, 'src', 'php', str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php'));
        if (file_exists($filename))
        {
            include($filename);
            return true;
        }
        return false;
    }
);

use Allegro\Protobuf\Compiler\Compiler;

$compiler = new Compiler();
$compiler->run(__FILE__);
