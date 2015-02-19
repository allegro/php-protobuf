<?php
require_once 'DescriptorInterface.php';
require_once 'MessageDescriptor.php';
require_once 'FileDescriptor.php';
require_once 'FieldDescriptor.php';
require_once 'FieldLabel.php';
require_once 'EnumDescriptor.php';
require_once 'EnumValueDescriptor.php';
require_once 'CodeStringBuffer.php';
require_once 'CommentStringBuffer.php';

/**
 * Parses protobuf file and generates message class
 */
class ProtobufParser
{
    const NAMESPACE_SEPARATOR = '_';
    const NAMESPACE_SEPARATOR_NATIVE = '\\';

    private static $_globalNamespace = '';
    private static $_parsers = array();
    private $_file = null;
    private $_namespaces = array();

    const TAB = '    ';
    const EOL = PHP_EOL;

    private $_hasSplTypes = false;
    private $_useNativeNamespaces = false;

    private $_filenamePrefix = 'pb_proto_';
    private $_savePsrOutput = false;

    private $_comment;

    public function __construct($useNativeNamespaces = null)
    {
        $this->_hasSplTypes = extension_loaded('SPL_Types');
        $this->_useNativeNamespaces = (boolean)$useNativeNamespaces;
    }

    /**
     * Returns namespaces
     *
     * @return array
     */
    public function getNamespaces()
    {
        return $this->_namespaces;
    }

    /**
     * Returns namespace separator
     *
     * @return array
     */
    public function getNamespaceSeparator()
    {
        return $this->_useNativeNamespaces
            ? self::NAMESPACE_SEPARATOR_NATIVE : self::NAMESPACE_SEPARATOR;
    }

    /**
     * Creates package name based on proto package name value
     *
     * @param string $name Package name
     *
     * @return string
     */
    public function createPackageName($name)
    {
        $components = explode('.', $name);
        $name = '';

        foreach ($components as $component) {
            if (strlen($component) > 0) {
                $name .= $this->getNamespaceSeparator() . ucfirst($component);
            }
        }

        return trim($name, $this->getNamespaceSeparator());
    }

    /**
     * Created type name based on proto type name
     *
     * @param string $name Type name
     *
     * @return string
     */
    public static function createTypeName($name)
    {
        $components = explode('_', $name);
        $name = '';

        foreach ($components as $component) {
            if (strlen($component) > 0) {
                $name .= ucfirst($component);
            }
        }

        return $name;
    }

    /**
     * Generates message files (PHP code) for proto file
     *
     * @param string $sourceFile Source filename (.proto)
     * @param string $outputFile Output filename
     *
     * @return null
     */
    public function parse($sourceFile, $outputFile = null)
    {
        $string = file_get_contents($sourceFile);
        $this->_file = new FileDescriptor($sourceFile);
        $this->_stripComments($string);

        $string = trim($string);

        $file = new FileDescriptor($sourceFile);
        $this->_parseMessageType($file, $string);

        $this->_resolveNamespaces($file);
        $buffer = new CodeStringBuffer(self::TAB, self::EOL);

        $this->_createClassFile($file, $buffer, $outputFile);

        return $file;
    }

    /**
     * Generates class description and write it to buffer
     *
     * @param MessageDescriptor $descriptor Message descriptor
     * @param CodeStringBuffer  $buffer     Buffer to write code to
     *
     * @return null
     */
    private function _createClass(
        MessageDescriptor $descriptor, CodeStringBuffer $buffer
    ) {
        if ($this->getSavePsrOutput()) {
            $buffer = new CodeStringBuffer(self::TAB, self::EOL);
            $buffer->append($this->_comment);
        }

        foreach ($descriptor->getEnums() as $enum) {
            $this->_createEnum($enum, $buffer);
        }

        foreach ($descriptor->getNested() as $nested) {
            $this->_createClass($nested, $buffer);
        }

        $buffer->newline();

        if ($this->_useNativeNamespaces) {
            $name = self::createTypeName($descriptor->getName());
            $namespaceName = $this->_createNamespaceName($descriptor);
            $buffer->append('namespace ' . $namespaceName . ' {');
        } else {
            $name = $this->_createClassName($descriptor);
        }

        $comment = new CommentStringBuffer(self::TAB, self::EOL);
        $path = $this->_createEmbeddedMessagePath($descriptor);
        if ($path) {
            $comment->append($descriptor->getName() . ' message embedded in ' . $path . ' message');
        } else {
            $comment->append($descriptor->getName() . ' message');
        }

        $buffer->append($comment);

        $buffer->append('class ' . $name . ' extends \ProtobufMessage')
            ->append('{')
            ->increaseIdentation();

        $this->_createClassConstructor($descriptor->getFields(), $buffer);
        $this->_createClassBody($descriptor->getFields(), $buffer);

        $buffer->decreaseIdentation()
            ->append('}');

        if ($this->_useNativeNamespaces) {
            $buffer->append('}');
        }

        if ($this->getSavePsrOutput()) {
            $this->_createFilePsr($name, $namespaceName, $buffer);
        }
    }

    /**
     * Creates enum description
     *
     * @param EnumDescriptor   $descriptor Enum descriptor
     * @param CodeStringBuffer $buffer     Buffer to write code to
     *
     * @return null
     */
    private function _createEnum(
        EnumDescriptor $descriptor, CodeStringBuffer $buffer
    ) {
        if ($this->getSavePsrOutput()) {
            $buffer = new CodeStringBuffer(self::TAB, self::EOL);
            $buffer->append($this->_comment);
        } else {
            $buffer->newline();
        }

        if ($this->_useNativeNamespaces) {
            $name = self::createTypeName($descriptor->getName());
            $namespaceName = $this->_createNamespaceName($descriptor);
            $buffer->append('namespace ' . $namespaceName . ' {');
        } else {
            $name = $this->_createClassName($descriptor);
        }

        $comment = new CommentStringBuffer(self::TAB, self::EOL);
        $path = $this->_createEmbeddedMessagePath($descriptor);
        if ($path) {
            $comment->append($descriptor->getName() . ' enum embedded in ' . $path . ' message');
        } else {
            $comment->append($descriptor->getName() . ' enum');
        }

        $buffer->append($comment);

        if ($this->_hasSplTypes) {
            $buffer->append('final class ' . $name .' extends \SplEnum')
                ->append('{')
                ->increaseIdentation();
        } else {
            $buffer->append('final class ' . $name)
                ->append('{')
                ->increaseIdentation();
        }

        $this->_createEnumClassDefinition($descriptor->getValues(), $buffer);

        $buffer->decreaseIdentation()
            ->append('}');

        if ($this->_useNativeNamespaces) {
            $buffer->append('}');
        }
        if ($this->getSavePsrOutput()) {
            $this->_createFilePsr($name, $namespaceName, $buffer);
        }
    }

    /**
     * Creates class code for given file descriptor
     *
     * @param FileDescriptor   $file       File descriptor
     * @param CodeStringBuffer $buffer     Buffer to write code to
     * @param string|null      $outputFile Output filename
     *
     * @return null
     */
    private function _createClassFile(
        FileDescriptor $file, CodeStringBuffer $buffer, $outputFile = null
    ) {
        $comment = new CommentStringBuffer(self::TAB, self::EOL);
        $date = strftime("%Y-%m-%d %H:%M:%S");
        $comment->append('Auto generated from ' . basename($file->getName()) . ' at ' . $date);

        if ($file->getPackage()) {
            $comment->newline()
                ->append($file->getPackage() . ' package');
        }

        if ($this->getSavePsrOutput()) {
            $this->_comment = $comment;
        }

        $buffer->append($comment);

        foreach ($file->getEnums() as $descriptor) {
            $this->_createEnum($descriptor, $buffer);
        }

        foreach ($file->getMessages() as $descriptor) {
            $this->_createClass($descriptor, $buffer);
        }

        $requiresString = '';

        foreach ($file->getDependencies() as $dependency) {
            $requiresString .= sprintf(
                'require_once \'%s\';',
                $this->_createOutputFilename($dependency->getName())
            );
        }

        if ($this->_useNativeNamespaces && !empty($requiresString)) {
            $requiresString = 'namespace {' . PHP_EOL . $requiresString . PHP_EOL . '}';
        }

        $buffer->append($requiresString);

        if ($outputFile == null) {
            $outputFile = $this->_createOutputFilename($file->getName());
        }

        if (!$this->getSavePsrOutput()) {
            file_put_contents($outputFile, '<?php' . PHP_EOL . $buffer);
        }
    }

    private function _createFilePsr($outputFile, $namespace, $buffer)
    {
        $path = str_replace('\\', '/', $namespace  .'/');
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        file_put_contents($path . $outputFile . '.php', '<?php' . PHP_EOL . $buffer);
    }

    /**
     * Generates namespace name for given descriptor
     *
     * @param DescriptorInterface $descriptor Descriptor
     *
     * @return string
     */
    private function _createNamespaceName(DescriptorInterface $descriptor)
    {
        $namespace = array();

        $containing = $descriptor->getContaining();

        while (!is_null($containing)) {
            $namespace[] = self::createTypeName($containing->getName());
            $containing = $containing->getContaining();
        }

        $package = $descriptor->getFile()->getPackage();

        if (!empty($package)) {
            $namespace[] = $this->createPackageName($package);
        }

        $namespace = array_reverse($namespace);

        $name = implode($this->getNamespaceSeparator(), $namespace);

        return $name;
    }

    /**
     * Generates class name for given descriptor
     *
     * @param DescriptorInterface $descriptor Descriptor
     *
     * @return string
     */
    private function _createClassName(DescriptorInterface $descriptor)
    {
        $name = self::createTypeName($descriptor->getName());

        $prefix = $this->_createNamespaceName($descriptor);
        if (!empty($prefix)) {
            $name = $prefix . $this->getNamespaceSeparator() . $name;
            if ($this->_useNativeNamespaces) {
                $name = self::NAMESPACE_SEPARATOR_NATIVE . $name;
            }
        }

        return $name;
    }

    /**
     * Generates filename for given source filename
     *
     * @param string $sourceFilename Filename
     *
     * @return string
     */
    private function _createOutputFilename($sourceFilename)
    {
        $pathInfo = pathinfo($sourceFilename);

        return $this->getFilenamePrefix() . $pathInfo['filename'] . '.php';
    }

    /**
     * Sets filename prefix
     *
     * @param string $prefix
     */
    public function setFilenamePrefix($prefix)
    {
        $this->_filenamePrefix = $prefix;
    }

    /**
     * Gets filename prefix
     *
     * @return string
     */
    public function getFilenamePrefix()
    {
        return $this->_filenamePrefix;
    }

    /**
     * Sets flag for directory based file layout vs single file
     *
     * @param bool $psrOutput
     */
    public function setSavePsrOutput($psrOutput)
    {
        $this->_savePsrOutput = $psrOutput;
    }

    /**
     * Gets flag for directory based file layout vs single file
     *
     * @return bool
     */
    public function getSavePsrOutput()
    {
        return $this->_savePsrOutput;
    }

    /**
     * Creates embedded message path composed of ancestor messages
     * seperated by slash "/". If message has no ancestor returns empty string.
     *
     * @param DescriptorInterface $descriptor message descriptor
     *
     * @return string
     */
    private function _createEmbeddedMessagePath(DescriptorInterface $descriptor)
    {
        $containing = $descriptor->getContaining();
        $path = array();

        while ($containing) {
            $path[] = $containing->getName();
            $containing = $containing->getContaining();
        }

        array_reverse($path);

        return implode("/", $path);
    }

    /**
     * Generates type name for given descriptor
     *
     * @param FieldDescriptor $field Field descriptor
     *
     * @return string
     */
    private function _getType(FieldDescriptor $field)
    {
        if ($field->isProtobufScalarType()) {
            return $field->getScalarType();
        } else if ($field->getTypeDescriptor() instanceof EnumDescriptor) {
            return ProtobufMessage::PB_TYPE_INT;
        } else {
            return $this->_createClassName($field->getTypeDescriptor());
        }
    }

    /**
     * Generates class body for given field descriptors list and
     * writes it to buffer
     *
     * @param array            $fields Array of FieldDescriptors
     * @param CodeStringBuffer $buffer Buffer to write code to
     *
     * @return null
     */
    private function _createClassBody($fields, CodeStringBuffer $buffer)
    {
        $comment = new CommentStringBuffer(self::TAB, self::EOL);

        $comment->append('Returns field descriptors')
            ->newline()
            ->appendParam('return', 'array');

        $buffer->append($comment)
            ->append('public function fields()')
            ->append('{')
            ->append('return self::$fields;', false, 1)
            ->append('}');

        foreach ($fields as $field) {
            if ($field->isRepeated()) {
                $this->_describeRepeatedField($field, $buffer);
            } else {
                $this->_describeSingleField($field, $buffer);
            }
        }
    }

    /**
     * Describes repeated field
     *
     * @param FieldDescriptor  $field  Field descriptor
     * @param CodeStringBuffer $buffer Buffer to write to
     *
     * @return null
     */
    private function _describeRepeatedField(
        FieldDescriptor $field, CodeStringBuffer $buffer
    ) {
        if ($field->isProtobufScalarType() || $field->getTypeDescriptor() instanceof EnumDescriptor) {
            $typeName = $field->getTypeName();
            $argumentClass = '';
        } else {
            $typeName = $this->_createClassName($field->getTypeDescriptor());
            $argumentClass = $typeName . ' ';
        }

        $comment = new CommentStringBuffer(self::TAB, self::EOL);
        $comment->append('Appends value to \'' . $field->getName() . '\' list')
            ->newline()
            ->appendParam('param', $typeName . ' $value Value to append')
            ->newline()
            ->appendParam('return', 'null');

        $buffer->newline()
            ->append($comment)
            ->append(
                'public function append' . $field->getCamelCaseName() . '(' . $argumentClass . '$value)'
            )
            ->append('{')
            ->append(
                'return $this->append(self::' . $field->getConstName() . ', $value);',
                false,
                1
            )
            ->append('}');

        $comment = new CommentStringBuffer(self::TAB, self::EOL);
        $comment->append('Clears \'' . $field->getName() . '\' list')
            ->newline()
            ->appendParam('return', 'null');

        $buffer->newline()
            ->append($comment)
            ->append('public function clear' . $field->getCamelCaseName() . '()')
            ->append('{')
            ->append(
                'return $this->clear(self::' . $field->getConstName() . ');',
                false,
                1
            )
            ->append('}');

        $comment = new CommentStringBuffer(self::TAB, self::EOL);
        $comment->append('Returns \'' . $field->getName() . '\' list')
            ->newline()
            ->appendParam('return', $typeName . '[]');

        $buffer->newline()
            ->append($comment)
            ->append('public function get' . $field->getCamelCaseName() . '()')
            ->append('{')
            ->append(
                'return $this->get(self::' . $field->getConstName() . ');',
                false,
                1
            )
            ->append('}');

        $comment = new CommentStringBuffer(self::TAB, self::EOL);
        $comment->append('Returns \'' . $field->getName() . '\' iterator')
            ->newline()
            ->appendParam('return', 'ArrayIterator');

        $buffer->newline()
            ->append($comment)
            ->append(
                'public function get' . $field->getCamelCaseName() . 'Iterator()'
            )
            ->append('{')
            ->append(
                'return new \ArrayIterator($this->get(self::' .
                $field->getConstName() . '));',
                false,
                1
            )
            ->append('}');

        $comment = new CommentStringBuffer(self::TAB, self::EOL);
        $comment->append(
            'Returns element from \'' . $field->getName() .
            '\' list at given offset'
        )
            ->newline()
            ->appendParam('param', 'int $offset Position in list')
            ->newline()
            ->appendParam('return', $typeName);

        $buffer->newline()
            ->append($comment)
            ->append(
                'public function get' . $field->getCamelCaseName() . 'At($offset)'
            )
            ->append('{')
            ->append(
                'return $this->get(self::' .
                $field->getConstName() . ', $offset);',
                false,
                1
            )
            ->append('}');

        $comment = new CommentStringBuffer(self::TAB, self::EOL);
        $comment->append('Returns count of \'' . $field->getName() . '\' list')
            ->newline()
            ->appendParam('return', 'int');

        $buffer->newline()
            ->append($comment)
            ->append('public function get' . $field->getCamelCaseName() . 'Count()')
            ->append('{')
            ->append(
                'return $this->count(self::' . $field->getConstName() . ');',
                false,
                1
            )
            ->append('}');
    }

    /**
     * Describes non-repeated field descriptor
     *
     * @param FieldDescriptor  $field  Field descriptor
     * @param CodeStringBuffer $buffer Buffer to write code to
     *
     * @return null
     */
    private function _describeSingleField(
        FieldDescriptor $field, CodeStringBuffer $buffer
    ) {
        if ($field->isProtobufScalarType() || $field->getTypeDescriptor() instanceof EnumDescriptor) {
            $typeName = $field->getTypeName();
            $argumentClass = '';
        } else {
            $typeName = $this->_createClassName($field->getTypeDescriptor());
            $argumentClass = $typeName . ' ';
        }

        $comment = new CommentStringBuffer(self::TAB, self::EOL);

        $comment->append(
            'Sets value of \'' . $field->getName() . '\' property'
        )
            ->newline()
            ->appendParam(
                'param',
                $typeName . ' $value Property value'
            )
            ->newline()
            ->appendParam('return', 'null');

        $buffer->newline()
            ->append($comment)
            ->append(
                'public function set' . $field->getCamelCaseName() .
                '(' . $argumentClass . '$value)'
            )
            ->append('{')
            ->append(
                'return $this->set(self::' .
                $field->getConstName() . ', $value);',
                false,
                1
            )
            ->append('}');

        $comment = new CommentStringBuffer(self::TAB, self::EOL);
        $comment->append('Returns value of \'' . $field->getName() . '\' property')
            ->newline()
            ->appendParam('return', $typeName);

        $buffer->newline()
            ->append($comment)
            ->append('public function get' . $field->getCamelCaseName() . '()')
            ->append('{')
            ->append(
                'return ' .
                '$this->get(self::' . $field->getConstName() . ');',
                false,
                1
            )
            ->append('}');
    }

    /**
     * Generates enum class definition
     *
     * @param array            $enums  Enums descriptors list
     * @param CodeStringBuffer $buffer Buffer to write code
     *
     * @return null
     */
    private function _createEnumClassDefinition(
        array $enums, CodeStringBuffer $buffer
    ) {
        foreach ($enums as $enum) {
            $buffer->append(
                'const ' . $enum->getName() . ' = ' . $enum->getValue() . ';'
            );
        }

        $buffer->newline();

        $comment = new CommentStringBuffer(self::TAB, self::EOL);
        $comment->append('Returns defined enum values')
            ->newline()
            ->appendParam('return', 'int[]');

        $buffer->append($comment)
            ->append('public function getEnumValues()')
            ->append('{');

        if ($this->_hasSplTypes) {
            $buffer->increaseIdentation()
                ->append('return $this->getConstList(false);');
        } else {
            $buffer->append('return array(', false, 1)
                ->increaseIdentation()
                ->increaseIdentation();

            foreach ($enums as $enum) {
                $buffer->append('\'' . $enum->getName() . '\' => self::' . $enum->getName() . ',');
            }

            $buffer->decreaseIdentation()
                ->append(');');

        }

        $buffer->decreaseIdentation()
            ->append('}');
    }

    /**
     * Generates class constructor and params list
     *
     * @param FieldDescriptor[] $fields Field descriptors list
     * @param CodeStringBuffer  $buffer Code buffer to write to
     *
     * @return null
     */
    private function _createClassConstructor($fields, CodeStringBuffer $buffer)
    {
        $buffer->append('/* Field index constants */');

        foreach ($fields as $field) {
            $buffer->append(
                'const ' . $field->getConstName() .
                ' = ' . $field->getNumber() . ';'
            );
        }

        $buffer->newline();

        $buffer->append('/* @var array Field descriptors */')
            ->append('protected static $fields = array(')
            ->increaseIdentation();

        foreach ($fields as $field) {
            $type = $this->_getType($field);

            $buffer->append('self::' . $field->getConstName() . ' => array(')
                ->increaseIdentation();

            if (!is_null($field->getDefault())) {
                if ($type == ProtobufMessage::PB_TYPE_STRING) {
                    $buffer->append(
                        '\'default\' => \'' .
                        addslashes($field->getDefault()) . '\', '
                    );
                } else {
                    if ($field->isProtobufScalarType()) {
                        $buffer->append(
                            '\'default\' => ' . $field->getDefault() . ', '
                        );
                    } else {
                        $className = $this->_createClassName($field->getTypeDescriptor());
                        $buffer->append(
                            '\'default\' => ' . $className . '::' . $field->getDefault() . ', '
                        );
                    }
                }
            }

            $buffer->append(
                '\'name\' => \'' . addslashes($field->getName()) . '\'' . ','
            );

            if (!$field->isRepeated()) {
                $buffer->append(
                    '\'required\' => ' .
                    ($field->isOptional() ? 'false' : 'true') . ','
                );
            } else {
                $buffer->append('\'repeated\' => true,');
            }

            if (is_int($type)) {
                $buffer->append('\'type\' => ' . $type . ',');
            } else {
                $buffer->append('\'type\' => \'' . $type . '\'');
            }

            $buffer->decreaseIdentation();
            $buffer->append('),');
        }

        $buffer->decreaseIdentation()
            ->append(');')
            ->newline();

        $comment = new CommentStringBuffer(self::TAB, self::EOL);
        $comment->append(
            'Constructs new message container and clears its internal state'
        )
            ->newline()
            ->appendParam('return', 'null');

        $buffer->append($comment)
            ->append('public function __construct()')
            ->append('{')
            ->increaseIdentation()
            ->append('$this->reset();')
            ->decreaseIdentation()
            ->append('}')
            ->newline();

        $comment = new CommentStringBuffer(self::TAB, self::EOL);
        $comment->append('Clears message values and sets default ones')
            ->newline()
            ->appendParam('return', 'null');

        $buffer->append($comment)
            ->append('public function reset()')
            ->append('{')
            ->increaseIdentation();

        foreach ($fields as $field) {
            $type = $this->_getType($field);

            if ($field->isRepeated()) {
                $buffer->append(
                    '$this->values[self::' . $field->getConstName() . '] = array();'
                );
            } else if ($field->isOptional() && !is_null($field->getDefault())) {
                if ($field->isProtobufScalarType()) {
                    $buffer->append(
                        '$this->values[self::' . $field->getConstName() . '] = ' .
                        $field->getDefault() . ';'
                    );
                } else {
                    $className = $this->_createClassName($field->getTypeDescriptor());
                    $buffer->append(
                        '$this->values[self::' . $field->getConstName() . '] = ' .
                        $className . '::' . $field->getDefault() . ';'
                    );
                }
            } else {
                $buffer->append(
                    '$this->values[self::' . $field->getConstName() . '] = null;'
                );
            }
        }

        $buffer->decreaseIdentation()
            ->append('}')
            ->newline();
    }

    /**
     * Parses protobuf file and returns MessageDescriptor
     *
     * @param FileDescriptor    $file           File descriptors
     * @param string            $messageContent Protobuf message content
     * @param MessageDescriptor $parent         Parent message (if nested)
     *
     * @return MessageDescriptor
     *
     * @throws Exception
     */
    private function _parseMessageType(
        FileDescriptor $file, $messageContent, MessageDescriptor $parent = null
    ) {
        if ($messageContent == '') {
            return;
        }

        while (strlen($messageContent) > 0) {
            $next = ($this->_next($messageContent));

            if (strtolower($next) == 'message') {
                $messageContent = trim(substr($messageContent, strlen($next)));
                $name = $this->_next($messageContent);

                $offset = $this->_getBeginEnd($messageContent, '{', '}');
                // now extract the content and call parse_message again
                $content = trim(
                    substr(
                        $messageContent,
                        $offset['begin'] + 1,
                        $offset['end'] - $offset['begin'] - 2
                    )
                );

                $childMessage = new MessageDescriptor($name, $file, $parent);
                $this->_parseMessageType($file, $content, $childMessage);

                $messageContent = '' . trim(substr($messageContent, $offset['end']));
            } else if (strtolower($next) == 'enum') {
                $messageContent = trim(substr($messageContent, strlen($next)));
                $name = $this->_next($messageContent);
                $offset = $this->_getBeginEnd($messageContent, '{', '}');
                // now extract the content and call parse_message again
                $content = trim(
                    substr(
                        $messageContent,
                        $offset['begin'] + 1,
                        $offset['end'] - $offset['begin'] - 2
                    )
                );

                $enum = new EnumDescriptor($name, $file, $parent);
                $this->_parseEnum($enum, $content);
                // removing it from string
                $messageContent = '' . trim(substr($messageContent, $offset['end']));
            } else if (strtolower($next) == 'import') {
                $name = $this->_next($messageContent);

                $match = preg_match(
                    '/"([^"]+)";*\s?/',
                    $messageContent,
                    $matches,
                    PREG_OFFSET_CAPTURE
                );

                if (!$match) {
                    throw new Exception(
                        'Malformed include / look at your import statement: ' .
                        $messageContent
                    );
                }

                $includedFilename = $matches[1][0];

                if (!file_exists($includedFilename)) {
                    throw new Exception(
                        'Included file ' . $includedFilename . ' does not exist'
                    );
                }

                $messageContent = trim(
                    substr(
                        $messageContent,
                        $matches[0][1] + strlen($matches[0][0])
                    )
                );

                $parserKey = realpath($includedFilename);

                if (!isset(self::$_parsers[$parserKey])) {
                    $pbp = new ProtobufParser($this->_useNativeNamespaces);
                    self::$_parsers[$parserKey] = $pbp;
                } else {
                    $pbp = self::$_parsers[$parserKey];
                }

                $file->addDependency($pbp->parse($includedFilename));

            } else if (strtolower($next) == 'option') {

                // We don't support option parameters just yet, skip for now.
                $messageContent = preg_replace('/^.+\n/', '', $messageContent);
                
            } else if (strtolower($next) == 'package') {

                $match = preg_match(
                    '/package[\s]+([^;]+);?/',
                    $messageContent,
                    $matches,
                    PREG_OFFSET_CAPTURE
                );

                if (!$match) {
                    throw new Exception('Malformed package');
                }

                $file->setPackage($matches[1][0]);
                $messageContent = trim(
                    substr(
                        $messageContent,
                        $matches[0][1] + strlen($matches[0][0])
                    )
                );
            } else {
                // now a normal field
                $match = preg_match(
                    '/(.*);/',
                    $messageContent,
                    $matches,
                    PREG_OFFSET_CAPTURE
                );

                if (!$match || !$parent) {
                    throw new Exception('Proto file missformed');
                }

                $parent->addField($this->_parseField($matches[0][0]));

                $messageContent = trim(
                    substr(
                        $messageContent,
                        $matches[0][1] + strlen($matches[0][0])
                    )
                );
            }
        }
    }

    /**
     * Parses protobuf field properties
     *
     * @param string $content Protobuf content
     *
     * @return FieldDescriptor
     * @throws Exception
     */
    private function _parseField($content)
    {
        $field = new FieldDescriptor();

        // parse the default value
        $match = preg_match(
            '/\[\s?default\s?=\s?([^\[]*)\]\s?;/',
            $content,
            $matches,
            PREG_OFFSET_CAPTURE
        );

        if ($match) {
            $field->setDefault($matches[1][0]);
            $content = trim(substr($content, 0, $matches[0][1])) . ';';
        }

        // parse the value
        $match = preg_match(
            '/(optional|required|repeated)[\s]+([^;^=^\s^]+)' .
            '[\s]+([^;^=^\s]+)[\s]+=[\s]+([\d]+);/',
            $content,
            $matches
        );

        if ($match) {
            switch ($matches[1]) {

            case 'optional':
                $label = FieldLabel::OPTIONAL;
                break;

            case 'required':
                $label = FieldLabel::REQUIRED;
                break;

            case 'repeated':
                $label = FieldLabel::REPEATED;
                break;
            }

            $field->setLabel($label);

            if (($pos = strrpos($matches[2], '.')) !== false) {
                $field->setType(substr($matches[2], $pos + 1));

                if ($pos == 0) {
                    $field->setNamespace($matches[2][$pos]);
                } else {
                    $field->setNamespace(substr($matches[2], 0, $pos));
                }
            } else {
                $field->setType($matches[2]);
            }

            $field->setName($matches[3]);
            $field->setNumber($matches[4]);
        } else {
            throw new Exception('Syntax error ' . $content);
        }

        return $field;
    }

    /**
     * Resolves message field types
     *
     * @param MessageDescriptor $descriptor Message descriptor
     * @param FileDescriptor    $file       File descriptor
     *
     * @throws Exception
     * @return null
     */
    private function _resolveMessageFieldTypes(
        MessageDescriptor $descriptor, FileDescriptor $file
    ) {
        foreach ($descriptor->getFields() as $field) {

            if ($field->isProtobufScalarType()) {
                continue;
            }

            $namespace = $field->getNamespace();

            if (is_null($namespace)) {
                if (($type = $descriptor->findType($field->getType())) !== false) {
                    $field->setTypeDescriptor($type);
                    continue;
                }

                $exists = $this->_namespaces[$file->getPackage()]
                    [$field->getType()];

                if (isset($exists)) {

                    $field->setTypeDescriptor(
                        $this->_namespaces[$file->getPackage()][$field->getType()]
                    );

                    continue;
                }

                $exists = isset($this->_namespaces[self::$_globalNamespace])
                    && isset($this->_namespaces[self::$_globalNamespace]
                    [$field->getType()]);

                if ($exists) {

                    $field->setTypeDescriptor(
                        $this->_namespaces[self::GLOBAL_NAMESPACE][$field->getType()]
                    );

                    continue;
                }

                throw new Exception('Type ' . $field->getType() . ' not defined');
            } else if ($namespace[0] == '.') {
                if ($namespace == '.') {
                    $namespace = '';
                } else {
                    $namespace = substr($namespace, 1);
                }

                if (!isset($this->_namespaces[$namespace])) {
                    throw new Exception(
                        'Namespace \'' . $namespace . '\' for type ' .
                        $field->getType() . ' not defined'
                    );
                }

                if (!isset($this->_namespaces[$namespace][$field->getType()])) {
                    throw new Exception(
                        'Type ' . $field->getType() . ' not defined in ' . $namespace
                    );
                }

                $field->setTypeDescriptor(
                    $this->_namespaces[$namespace][$field->getType()]
                );

            } else {
                $type = $descriptor->findType(
                    $field->getType(), $field->getNamespace()
                );

                if ($type !== false) {
                    $field->setTypeDescriptor($type);
                    continue;
                }

                if (!isset($this->_namespaces[$namespace])) {
                    throw new Exception(
                        'Namespace ' . $namespace . ' for type ' .
                        $field->getType() . ' not defined'
                    );
                }

                $exists = isset($this->_namespaces[$namespace][$field->getType()]);

                if (!$exists) {
                    throw new Exception(
                        'Type ' . $field->getType() . ' not defined in ' . $namespace
                    );
                }

                $field->setTypeDescriptor(
                    $this->_namespaces[$namespace][$field->getType()]
                );
            }
        }

        foreach ($descriptor->getNested() as $nested) {
            $this->_resolveMessageFieldTypes($nested, $file);
        }
    }

    /**
     * Resolves namespaces for given file descriptor
     *
     * @param FileDescriptor $file File descriptor
     *
     * @return null
     */
    private function _resolveNamespaces(FileDescriptor $file)
    {
        foreach ($file->getEnums() as $descriptor) {
            $this->_namespaces[$file->getPackage()]
            [$descriptor->getName()] = $descriptor;
        }

        foreach ($file->getMessages() as $descriptor) {
            $this->_namespaces[$file->getPackage()]
            [$descriptor->getName()] = $descriptor;
        }

        foreach (self::$_parsers as $parser) {
            foreach ($parser->getNamespaces() as $namespace => $descriptors) {
                foreach ($descriptors as $name => $descriptor) {
                    $this->_namespaces[$namespace][$name] = $descriptor;
                }
            }
        }

        foreach ($file->getMessages() as $descriptor) {
            $this->_resolveMessageFieldTypes($descriptor, $file);
        }
    }

    /**
     * Parses enum
     *
     * @param EnumDescriptor $enum    Enum descriptor
     * @param string         $content Protobuf enum description
     *
     * @return EnumDescriptor
     * @throws Exception
     */
    private function _parseEnum(EnumDescriptor $enum, $content)
    {
        $match = preg_match_all('/(.*);\s?/', $content, $matches);

        if (!$match) {
            throw new \Exception('Semantic error in Enum!');
        }

        foreach ($matches[1] as $match) {
            $split = preg_split('/=/', $match);

            $enum->addValue(
                new EnumValueDescriptor(trim($split[0]), trim($split[1]))
            );
        }

        return $enum;
    }

    /**
     * Returns next token from parsed protobuf message
     *
     * @param string $message Message to parse
     *
     * @return int|string Next token or -1 if not found
     */
    private function _next($message)
    {
        $match = preg_match(
            '/([^\s^\{}]*)/',
            $message,
            $matches,
            PREG_OFFSET_CAPTURE
        );

        if (!$match) {
            return -1;
        } else {
            return trim($matches[0][0]);
        }
    }


    /**
     * Finds starting, ending char in string
     *
     * @param string $string  String to search
     * @param string $char    Starting char
     * @param string $charend Ending char
     *
     * @return array
     * @throws Exception
     */
    private function _getBeginEnd($string, $char, $charend)
    {
        $offsetBegin = strpos($string, $char);

        if ($offsetBegin === false) {
            return array('begin' => -1, 'end' => -1);
        }

        $offsetNumber = 1;
        $offset = $offsetBegin + 1;

        while ($offsetNumber > 0 && $offset > 0) {
            // now search after the end nested { }
            $offsetOpen = strpos($string, $char, $offset);
            $offsetClose = strpos($string, $charend, $offset);

            if ($offsetOpen < $offsetClose && !($offsetOpen === false)) {
                $offset = $offsetOpen + 1;
                $offsetNumber++;
            } else if (!($offsetClose === false)) {
                $offset = $offsetClose + 1;
                $offsetNumber--;
            } else {
                $offset = -1;
            }
        }

        if ($offset == -1) {
            throw new Exception('Protofile failure: ' . $char . ' not nested');
        }

        return array('begin' => $offsetBegin, 'end' => $offset);
    }

    /**
     * Strips comments in string
     *
     * @param string &$string String to be stripped
     *
     * @return null
     */
    private function _stripComments(&$string)
    {
        $string = preg_replace('/\/\/.*/', '', $string);
        // now replace empty lines and whitespaces in front
        $string = preg_replace('/\\r?\\n\s*/', PHP_EOL, $string);
    }
}
