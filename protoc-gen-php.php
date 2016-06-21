<?php
spl_autoload_register(function($class)
    {
        $prefix = 'ProtobufCompiler\\';
        if (strpos($class, $prefix) === 0)
        {
            $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
            $class = __DIR__ . DIRECTORY_SEPARATOR . $class;
            include($class . '.php');
            return true;
        }
        return false;
    }
);

use ProtobufCompiler\Compiler;

$compiler = new Compiler();
$compiler->run();
