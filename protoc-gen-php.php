#!/usr/bin/env php
<?php
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
