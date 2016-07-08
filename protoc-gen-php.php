#!/usr/bin/env php
<?php
spl_autoload_register(function ($class)
    {
        $filename = implode(DIRECTORY_SEPARATOR, array(
            __DIR__, 'src', str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php'
        ));
        if (file_exists($filename)) {
            include($filename);
            return true;
        }
        return false;
    }
);

use Allegro\Protobuf\Compiler\Logger;

$composerAutoload = __DIR__ . '/vendor/autoload.php';
if (!file_exists($composerAutoload)) {
    Logger::error('The dependencies are not installed. Run "composer install" in order to install them.');
    exit(1);
}

if (!extension_loaded('protobuf')) {
    Logger::error('protobuf module is not installed.');
    exit(1);
}

require_once $composerAutoload;

use Allegro\Protobuf\Compiler\Compiler;

$compiler = new Compiler();
$compiler->run(__FILE__);
