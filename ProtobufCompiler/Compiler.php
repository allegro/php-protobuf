<?php

namespace ProtobufCompiler;

require_once 'PhpGenerator.php';

require_once "pb_proto_plugin.php";

class Compiler
{
    public function run() {
        $data = file_get_contents('php://stdin');
        $request = new \CodeGeneratorRequest();
        // TODO handle parse error
        $request->parseFromString($data);
        $generator = new PhpGenerator();
        $response = $generator->generate($request);
        echo $response->serializeToString();
    }
}