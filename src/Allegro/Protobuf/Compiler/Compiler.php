<?php
namespace Allegro\Protobuf\Compiler;

use Google\Protobuf\Compiler\CodeGeneratorRequest;

class Compiler
{
    const MINIMUM_PROTOC_VERSION = '2.6.0';
    const VERSION = '0.12.3';

    /**
     * @param string $pluginExecutable
     *
     * @return null
     */
    public function run($pluginExecutable)
    {
        if ($this->hasStdin()) {
            $data = file_get_contents('php://stdin');
            $request = new CodeGeneratorRequest();
            try {
                $request->parseFromString($data);
            } catch (\Exception $ex) {
                Logger::error('Unable to parse a message passed by protoc.' . $ex->getMessage() . '.');
                exit(1);
            }
            $generator = new PhpGenerator();
            try {
                $response = $generator->generate($request);
                echo $response->serializeToString();
            } catch (GenerationException $ex) {
                Logger::error($ex->getMessage() . '.');
                exit(1);
            }
        } else {
            if ($this->isWin()) {
                $pluginExecutable = substr($pluginExecutable, 0, -3) . 'bat';
            }
            $this->runProtoc($pluginExecutable);
        }
    }

    /**
     * @return bool
     */
    private function isWin()
    {
        return 'WIN' === strtoupper(substr(PHP_OS, 0, 3));
    }

    /**
     * @return bool
     */
    private function hasStdin()
    {
        $stdin = fopen('php://stdin', 'r');
        $read = array($stdin);
        $write = null;
        $except = null;
        $ret = stream_select($read, $write, $except, 0);
        fclose($stdin);
        return $ret == 1;
    }

    /**
     * @return \Console_CommandLine_Result
     */
    private function parseArguments()
    {
        $parser = new \Console_CommandLine(array('version' => self::VERSION));

        $parser->addOption('out', array(
            'short_name'    => '-o',
            'long_name'     => '--out',
            'action'        => 'StoreString',
            'default'       => './',
            'description'   => 'The destination directory for generated files (defaults to the current directory).',
        ));

        $parser->addOption('proto_path', array(
            'short_name'    => '-I',
            'long_name'     => '--proto_path',
            'action'        => 'StoreArray',
            'multiple'      => true,
            'description'   => 'The directory in which to search for imports.',
        ));

        $parser->addOption('protoc', array(
            'long_name'     => '--protoc',
            'action'        => 'StoreString',
            'default'       => 'protoc',
            'description'   => 'The protoc compiler executable path.',
        ));

        $parser->addOption('define', array(
            'short_name'    => '-D',
            'long_name'     => '--define',
            'action'        => 'StoreArray',
            'multiple'      => true,
            'description'   => 'Define a generator option (i.e. -Dnamespace=\'Foo\Bar\Baz\').',
        ));

        $parser->addArgument('file', array(
            'multiple'      => true,
            'description'   => 'Proto files.',
        ));

        try {
            $result = $parser->parse();
            return $result;
        } catch (\Exception $e) {
            $parser->displayError($e->getMessage());
            exit(1);
        }
    }

    /**
     * @param string $pluginExecutable
     *
     * @return null
     */
    private function runProtoc($pluginExecutable)
    {
        $result = $this->parseArguments();

        $protocExecutable = $result->options['protoc'];
        $this->checkProtoc($protocExecutable);

        $cmd[] = $protocExecutable;
        $cmd[] = '--plugin=protoc-gen-allegrophp=' . escapeshellarg($pluginExecutable);

        if ($result->options['proto_path']) {
            foreach ($result->options['proto_path'] as $protoPath) {
                $cmd[] = '--proto_path=' . escapeshellarg($protoPath);
            }
        }

        $customArgs = $this->buildCustomArguments($result);
        $cmd[] = '--allegrophp_out=' . escapeshellarg($customArgs . ':' . $result->options['out']);

        foreach ($result->args['file'] as $file) {
            $cmd[] = escapeshellarg($file);
        }

        $cmdStr = implode(' ', $cmd);
        passthru($cmdStr, $return);

        if ($return !== 0) {
            Logger::error('protoc exited with an exit status ' . $return . ' when executed with: ' . PHP_EOL
                . '  ' . implode(" \\\n    ", $cmd));
            exit($return);
        }
    }

    /**
     * @param string $protocExecutable
     *
     * @return null
     */
    private function checkProtoc($protocExecutable)
    {
        exec("$protocExecutable --version", $output, $return);

        if (0 !== $return && 1 !== $return) {
            Logger::error('Unable to find the protoc command. Please make sure it\'s installed and available in the path.');
            exit(1);
        }

        if (!preg_match('/[0-9\.]+/', $output[0], $m)) {
            Logger::error('Unable to get protoc command version. Please make sure it\'s installed and available in the path.');
            exit(1);
        }

        if (version_compare($m[0], self::MINIMUM_PROTOC_VERSION) < 0) {
            Logger::error('The protoc command in your system is too old. Minimum required version is '
                . self::MINIMUM_PROTOC_VERSION . ' but found ' . $m[0]);
            exit(1);
        }
    }

    /**
     * @param \Console_CommandLine_Result $result
     *
     * @return array
     */
    private function buildCustomArguments($result)
    {
        $args = array();
        if ($result->options['define']) {
            $args['options'] = array();
            foreach($result->options['define'] as $define) {
                $parts = explode('=', $define);
                $parts = array_filter(array_map('trim', $parts));
                if (count($parts) == 1) {
                    $parts[1] = 1;
                }
                $args['options'][$parts[0]] = $parts[1];
            }
        }

        return http_build_query($args, '', '&');
    }
}
