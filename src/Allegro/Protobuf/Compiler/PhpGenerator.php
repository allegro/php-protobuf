<?php
namespace Allegro\Protobuf\Compiler;

use Google\Protobuf\Compiler\CodeGeneratorRequest;
use Google\Protobuf\Compiler\CodeGeneratorResponse;
use Google\Protobuf\Compiler\CodeGeneratorResponse_File;
use Google\Protobuf\DescriptorProto;
use Google\Protobuf\EnumDescriptorProto;
use Google\Protobuf\FileDescriptorProto;

class PhpGenerator
{
    const CLASS_NAME_SEPARATOR = '_';
    const PHP_NAMESPACE_SEPARATOR = '\\';
    const PB_NAMESPACE_SEPARATOR = '.';

    const TAB = '    ';
    const EOL = PHP_EOL;

    private $customArguments;

    /**
     * @param CodeGeneratorRequest $request
     *
     * @return CodeGeneratorResponse
     * @throws GenerationException
     */
    public function generate(CodeGeneratorRequest $request) {
        $this->customArguments = array();
        $parameter = $request->getParameter();
        if ($parameter) {
            parse_str($parameter, $this->customArguments);
        }

        $createClassFilename = function ($className, $namespaceName) {
            if ($namespaceName) {
                $baseName = str_replace(
                    PhpGenerator::PHP_NAMESPACE_SEPARATOR,
                    DIRECTORY_SEPARATOR,
                    $namespaceName . PhpGenerator::PHP_NAMESPACE_SEPARATOR . $className
                );
            } else {
                $baseName = $className;
            }
            return $baseName . '.php';
        };

        $response = new CodeGeneratorResponse();
        $createClass = function ($className, $namespaceName, $content) use ($response, $createClassFilename) {
            $file = new CodeGeneratorResponse_File();
            $file->setName($createClassFilename($className, $namespaceName));
            $file->setContent('<?php' . PHP_EOL . $content);

            $response->appendFile($file);
        };

        $fileDescriptors = $this->_buildFileDescriptors($request->getProtoFile());
        foreach ($fileDescriptors as $fileDescriptor) {
            $this->_generateFiles($fileDescriptor, $createClass);
        }

        foreach ($request->getProtoFile() as $fileDescriptorProto) {
            if ($this->_containMapEntryMessage($fileDescriptorProto->getMessageType())) {
                Logger::warn('The maps are not fully supported (https://github.com/allegro/php-protobuf/issues/73)');
                break;
            }
        }

        return $response;
    }

    /**
     * @param DescriptorProto[] $descriptorProtos
     *
     * @return boolean
     */
    private function _containMapEntryMessage($descriptorProtos) {
        foreach ($descriptorProtos as $descriptorProto) {
            $messageOptions = $descriptorProto->getOptions();
            if ($messageOptions && $messageOptions->getMapEntry()) {
                return true;
            }

            if ($this->_containMapEntryMessage($descriptorProto->getNestedType())) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param FileDescriptorProto[] $fileDescriptorProtos
     *
     * @return FileDescriptor[]
     * @throws GenerationException
     */
    private function _buildFileDescriptors(array $fileDescriptorProtos)
    {
        $fileDescriptors = array();
        foreach ($fileDescriptorProtos as $fileDescriptorProto) {
            $fileDescriptors[] = $this->_buildFileDescriptor($fileDescriptorProto);
        }
        $this->_resolveFieldTypeDescriptors($fileDescriptors);
        return $fileDescriptors;
    }

    /**
     * @param FileDescriptor[] $files
     *
     * @return null
     * @throws GenerationException
     */
    private function _resolveFieldTypeDescriptors(array $files)
    {
        $typeDescriptorsByTypeName = array();
        foreach ($files as $file) {
            $package = $file->getPackage();
            if ($package) {
                $prefix = self::PB_NAMESPACE_SEPARATOR . $package;
            } else {
                $prefix = '';
            }

            foreach ($file->getMessages() as $messageDescriptor) {
                $this->_buildFieldTypeDescriptorsByTypeName($prefix, $messageDescriptor, $typeDescriptorsByTypeName);
            }

            foreach ($file->getEnums() as $enumDescriptor) {
                $this->_buildFieldTypeDescriptorsByTypeName($prefix, $enumDescriptor, $typeDescriptorsByTypeName);
            }
        }

        foreach ($files as $file) {
            foreach ($file->getMessages() as $messageDescriptor) {
                $this->_resolveMessageFieldTypes($messageDescriptor, $typeDescriptorsByTypeName);
            }
        }
    }

    /**
     * @param MessageDescriptor $messageDescriptor
     * @param array             $typeDescriptorsByTypeName
     *
     * @return null
     * @throws GenerationException
     */
    private function _resolveMessageFieldTypes($messageDescriptor, array $typeDescriptorsByTypeName)
    {
        foreach ($messageDescriptor->getFields() as $fieldDescriptor) {
            $typeName = $fieldDescriptor->getTypeName();
            if ($typeName) {
                $typeDescriptor = $typeDescriptorsByTypeName[$typeName];
                if ($typeDescriptor) {
                    $fieldDescriptor->setTypeDescriptor($typeDescriptorsByTypeName[$typeName]);
                } else {
                    throw new GenerationException('Failed to resolve ' . $typeName . ' type');
                }
            }
        }

        foreach ($messageDescriptor->getNested() as $nestedDescriptor) {
            $this->_resolveMessageFieldTypes($nestedDescriptor, $typeDescriptorsByTypeName);
        }
    }

    /**
     * @param string                           $prefix
     * @param MessageDescriptor|EnumDescriptor $descriptor
     * @param array                            $typeDescriptorsByTypeName
     *
     * @return null
     */
    private function _buildFieldTypeDescriptorsByTypeName($prefix, $descriptor, array &$typeDescriptorsByTypeName)
    {
        $typeName = $prefix . self::PB_NAMESPACE_SEPARATOR . $descriptor->getName();
        $typeDescriptorsByTypeName[$typeName] = $descriptor;
        if ($descriptor instanceof MessageDescriptor) {
            foreach ($descriptor->getEnums() as $enumDescriptor) {
                $this->_buildFieldTypeDescriptorsByTypeName($typeName, $enumDescriptor, $typeDescriptorsByTypeName);
            }
            foreach ($descriptor->getNested() as $nestedDescriptor) {
                $this->_buildFieldTypeDescriptorsByTypeName($typeName, $nestedDescriptor, $typeDescriptorsByTypeName);
            }
        }
    }

    /**
     * @param FileDescriptorProto $fileDescriptorProto
     *
     * @return FileDescriptor
     */
    private function _buildFileDescriptor(FileDescriptorProto $fileDescriptorProto)
    {
        $fileDescriptor = new FileDescriptor($fileDescriptorProto->getName());
        $fileDescriptor->setPackage($fileDescriptorProto->getPackage());
        foreach ($fileDescriptorProto->getMessageType() as $descriptorProto) {
            $this->_addMessageDescriptor($descriptorProto, $fileDescriptor);
        }
        foreach ($fileDescriptorProto->getEnumType() as $enumDescriptorProto) {
            $this->_addEnumDescriptor($enumDescriptorProto, $fileDescriptor);
        }
        return $fileDescriptor;
    }

    /**
     * @param DescriptorProto        $descriptorProto
     * @param FileDescriptor         $fileDescriptor
     * @param MessageDescriptor|null $messageDescriptor
     *
     * @return null
     */
    private function _addMessageDescriptor(
        DescriptorProto $descriptorProto, FileDescriptor $fileDescriptor, MessageDescriptor $messageDescriptor = null
    ) {
        $messageDescriptor = new MessageDescriptor($descriptorProto->getName(), $fileDescriptor, $messageDescriptor);

        foreach ($descriptorProto->getEnumType() as $enumDescriptorProto) {
            $this->_addEnumDescriptor($enumDescriptorProto, $fileDescriptor, $messageDescriptor);
        }

        foreach ($descriptorProto->getNestedType() as $nestedDescriptorProto) {
            $this->_addMessageDescriptor($nestedDescriptorProto, $fileDescriptor, $messageDescriptor);
        }

        $ignoredOneofs = array();

        foreach ($descriptorProto->getField() as $fieldDescriptorProto) {
            if ($fieldDescriptorProto->hasOneofIndex()) {
                $oneofIndex = $fieldDescriptorProto->getOneofIndex();
                if (!in_array($oneofIndex, $ignoredOneofs)) {
                    $oneofDescriptorProto = $descriptorProto->getOneofDeclAt($oneofIndex);
                    $name = $oneofDescriptorProto->getName();
                    Logger::warn("Ignoring '{$name}', "
                        . 'oneof is not supported (https://github.com/allegro/php-protobuf/issues/72).');
                    $ignoredOneofs[] = $oneofIndex;
                }
            } else {
                $fieldDescriptor = new FieldDescriptor();
                $fieldDescriptor->setName($fieldDescriptorProto->getName());
                if ($fieldDescriptorProto->hasDefaultValue()) {
                    $fieldDescriptor->setDefault($fieldDescriptorProto->getDefaultValue());
                }
                $fieldDescriptor->setLabel($fieldDescriptorProto->getLabel());
                $fieldDescriptor->setNumber($fieldDescriptorProto->getNumber());
                $fieldDescriptor->setType($fieldDescriptorProto->getType());
                $fieldDescriptor->setTypeName($fieldDescriptorProto->getTypeName());
                $options = $fieldDescriptorProto->getOptions();
                if ($options) {
                    $fieldDescriptor->setPacked($options->getPacked());
                }
                $messageDescriptor->addField($fieldDescriptor);
            }
        }
    }

    /**
     * @param EnumDescriptorProto    $enumDescriptorProto
     * @param FileDescriptor         $fileDescriptor
     * @param MessageDescriptor|null $messageDescriptor
     *
     * @return null
     */
    private function _addEnumDescriptor(
        EnumDescriptorProto $enumDescriptorProto, FileDescriptor $fileDescriptor, MessageDescriptor $messageDescriptor = null
    ) {
        $enumDescriptor = new EnumDescriptor($enumDescriptorProto->getName(), $fileDescriptor, $messageDescriptor);
        foreach ($enumDescriptorProto->getValue() as $valueDescriptorProto) {
            $enumValueDescriptor = new EnumValueDescriptor($valueDescriptorProto->getName(), $valueDescriptorProto->getNumber());
            $enumDescriptor->addValue($enumValueDescriptor);
        }
    }

    /**
     * @param FileDescriptor $file
     *
     * @return CommentStringBuffer
     */
    private function _createFileComment(FileDescriptor $file)
    {
        $comment = new CommentStringBuffer(self::TAB, self::EOL);
        $date = strftime("%Y-%m-%d %H:%M:%S");
        $comment->append('Auto generated from ' . basename($file->getName()) . ' at ' . $date);

        if ($file->getPackage()) {
            $comment->newline()
                ->append($file->getPackage() . ' package');
        }
        return $comment;
    }

    /**
     * @param FileDescriptor $file
     * @param callable       $createClass
     *
     * @return null
     */
    private function _generateFiles($file, $createClass)
    {
        foreach ($file->getEnums() as $descriptor) {
            $this->_createEnum($descriptor, $createClass);
        }

        foreach ($file->getMessages() as $descriptor) {
            $this->_createClass($descriptor, $createClass);
        }
    }

    /**
     * @param MessageDescriptor $descriptor
     * @param callable          $createClass
     *
     * @return null
     */
    private function _createClass(
        MessageDescriptor $descriptor, $createClass
    ) {
        foreach ($descriptor->getEnums() as $enum) {
            $this->_createEnum($enum, $createClass);
        }

        foreach ($descriptor->getNested() as $nested) {
            $this->_createClass($nested, $createClass);
        }

        $buffer = new CodeStringBuffer(self::TAB, self::EOL);
        $buffer->append($this->_createFileComment($descriptor->getFile()));
        $buffer->newline();

        $namespaceName = $this->_createNamespaceName($descriptor);
        if ($namespaceName) {
            $buffer->append('namespace ' . $namespaceName . ' {');
        } else {
            $buffer->append('namespace {');
        }

        $comment = new CommentStringBuffer(self::TAB, self::EOL);
        $path = $this->_createEmbeddedMessagePath($descriptor);
        if ($path) {
            $comment->append($descriptor->getName() . ' message embedded in ' . $path . ' message');
        } else {
            $comment->append($descriptor->getName() . ' message');
        }

        $buffer->append($comment);

        $className = $this->_createClassName($descriptor);
        $buffer->append('class ' . $className . ' extends \ProtobufMessage')
            ->append('{')
            ->increaseIdentation();

        $this->_createClassConstructor($descriptor->getFields(), $buffer);
        $this->_createClassBody($descriptor->getFields(), $buffer);

        $buffer->decreaseIdentation()
            ->append('}');

        $buffer->append('}');

        $createClass($className, $namespaceName, $buffer);
    }

    /**
     * @param EnumDescriptor $descriptor
     * @param callable       $createClass
     *
     * @return null
     */
    private function _createEnum(
        EnumDescriptor $descriptor, $createClass
    ) {
        $buffer = new CodeStringBuffer(self::TAB, self::EOL);
        $buffer->append($this->_createFileComment($descriptor->getFile()));
        $buffer->newline();

        $className = $this->_createClassName($descriptor);
        $namespaceName = $this->_createNamespaceName($descriptor);
        if ($namespaceName) {
            $buffer->append('namespace ' . $namespaceName . ' {');
        } else {
            $buffer->append('namespace {');
        }

        $comment = new CommentStringBuffer(self::TAB, self::EOL);
        $path = $this->_createEmbeddedMessagePath($descriptor);
        if ($path) {
            $comment->append($descriptor->getName() . ' enum embedded in ' . $path . ' message');
        } else {
            $comment->append($descriptor->getName() . ' enum');
        }

        $buffer->append($comment);

        $buffer->append('final class ' . $className)
            ->append('{')
            ->increaseIdentation();

        $this->_createEnumClassDefinition($descriptor->getValues(), $buffer);

        $buffer->decreaseIdentation()
            ->append('}');

        $buffer->append('}');

        $createClass($className, $namespaceName, $buffer);
    }

    /**
     * @param DescriptorInterface $descriptor
     *
     * @return string|null
     */
    private function _createNamespaceName(DescriptorInterface $descriptor)
    {
        if (isset($this->customArguments['options']['namespace'])) {
            return $this->customArguments['options']['namespace'];
        }

        $package = $descriptor->getFile()->getPackage();
        if (!$package) {
            return null;
        }

        $packageComponents = explode(self::PB_NAMESPACE_SEPARATOR, $package);
        $namespace = array();

        foreach ($packageComponents as $packageComponent) {
            $namespace[] = implode(array_map('ucfirst', explode('_', $packageComponent)));
        }

        return implode(self::PHP_NAMESPACE_SEPARATOR, $namespace);
    }

    /**
     * @param DescriptorInterface $descriptor
     *
     * @return string
     */
    private function _createClassName(DescriptorInterface $descriptor)
    {
        $components = array($descriptor->getName());

        $containing = $descriptor->getContaining();
        while (!is_null($containing)) {
            $components[] = $containing->getName();
            $containing = $containing->getContaining();
        }

        $components = array_reverse($components);

        $name = implode(self::CLASS_NAME_SEPARATOR, $components);

        return $name;
    }

    /**
     * @param DescriptorInterface $descriptor Descriptor
     *
     * @return string
     */
    private function _createFullyQualifiedClassName(DescriptorInterface $descriptor)
    {
        $className = $this->_createClassName($descriptor);
        $namespaceName = $this->_createNamespaceName($descriptor);
        if ($namespaceName) {
            $name = self::PHP_NAMESPACE_SEPARATOR . $namespaceName . self::PHP_NAMESPACE_SEPARATOR . $className;
        } else {
            $name = self::PHP_NAMESPACE_SEPARATOR . $className;
        }
        return $name;
    }

    /**
     * Creates embedded message path composed of ancestor messages
     * seperated by slash "/". If message has no ancestor returns empty string.
     *
     * @param DescriptorInterface $descriptor
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
     * @param FieldDescriptor[] $fields
     * @param CodeStringBuffer  $buffer
     *
     * @return null
     */
    private function _createClassBody(array $fields, CodeStringBuffer $buffer)
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
     * @param FieldDescriptor  $field
     * @param CodeStringBuffer $buffer
     *
     * @return null
     */
    private function _describeRepeatedField(FieldDescriptor $field, CodeStringBuffer $buffer)
    {
        $phpType = $field->getPhpType();
        if ($phpType != 'object') {
            $typeName = $phpType;
            $argumentClass = '';
        } else {
            $typeName = $this->_createFullyQualifiedClassName($field->getTypeDescriptor());
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
        $comment->append('Returns true if \'' . $field->getName() . '\' property is set, false otherwise')
            ->newline()
            ->appendParam('return', 'boolean');

        $buffer->newline()
            ->append($comment)
            ->append('public function has' . $field->getCamelCaseName() . '()')
            ->append('{')
            ->append(
                'return count($this->get(self::' . $field->getConstName() . ')) !== 0;',
                false,
                1
            )
            ->append('}');

        $comment = new CommentStringBuffer(self::TAB, self::EOL);
        $comment->append('Returns \'' . $field->getName() . '\' iterator')
            ->newline()
            ->appendParam('return', '\ArrayIterator');

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
     * @param FieldDescriptor  $field
     * @param CodeStringBuffer $buffer
     *
     * @return null
     */
    private function _describeSingleField(FieldDescriptor $field, CodeStringBuffer $buffer)
    {
        $phpType = $field->getPhpType();
        if ($phpType != 'object') {
            $typeName = $phpType;
            $argumentClass = '';
            $returnCast = '(' . $phpType . ')';
        } else {
            $typeName = $this->_createFullyQualifiedClassName($field->getTypeDescriptor());
            $argumentClass = $typeName . ' ';
            $returnCast = '';
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
                '(' . $argumentClass . '$value' . ($argumentClass ? '=null' : '') . ')'
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
            ->increaseIdentation();
            if ($returnCast) {
                $buffer->append('$value = ' . '$this->get(self::' . $field->getConstName() . ');')
                    ->append('return $value === null ? ' . $returnCast . '$value : $value;');
            } else {
                $buffer->append('return ' . '$this->get(self::' . $field->getConstName() . ');');
            }
            $buffer->decreaseIdentation()
                ->append('}');

        $comment = new CommentStringBuffer(self::TAB, self::EOL);
        $comment->append('Returns true if \'' . $field->getName() . '\' property is set, false otherwise')
            ->newline()
            ->appendParam('return', 'boolean');

        $buffer->newline()
            ->append($comment)
            ->append('public function has' . $field->getCamelCaseName() . '()')
            ->append('{')
            ->append(
                'return $this->get(self::' . $field->getConstName() . ') !== null;',
                false,
                1
            )
            ->append('}');
    }

    /**
     * @param EnumValueDescriptor[] $enums
     * @param CodeStringBuffer      $buffer
     *
     * @return null
     */
    private function _createEnumClassDefinition(array $enums, CodeStringBuffer $buffer)
    {
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

        $buffer->append('return array(', false, 1)
            ->increaseIdentation()
            ->increaseIdentation();

        foreach ($enums as $enum) {
            $buffer->append('\'' . $enum->getName() . '\' => self::' . $enum->getName() . ',');
        }

        $buffer->decreaseIdentation()
            ->append(');');

        $buffer->decreaseIdentation()
            ->append('}');
    }

    /**
     * @param FieldDescriptor[] $fields
     * @param CodeStringBuffer  $buffer
     *
     * @return null
     */
    private function _createClassConstructor(array $fields, CodeStringBuffer $buffer)
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
            $phpType = $field->getPhpType();
            if ($phpType == 'object') {
                $type = $this->_createFullyQualifiedClassName($field->getTypeDescriptor());
            } else {
                $type = $field->getScalarInternalType();
            }

            $buffer->append('self::' . $field->getConstName() . ' => array(')
                ->increaseIdentation();

            if (!is_null($field->getDefault())) {
                if ($field->isEnum()) {
                    $className = $this->_createFullyQualifiedClassName($field->getTypeDescriptor());
                    $buffer->append(
                        '\'default\' => ' . $className . '::' . $field->getDefault() . ','
                    );
                } else {
                    if ($phpType == 'string') {
                        $buffer->append(
                            '\'default\' => \'' .
                            addslashes($field->getDefault()) . '\','
                        );
                    }  else {
                        $buffer->append(
                            '\'default\' => ' . $field->getDefault() . ','
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

            if ($phpType == 'object') {
                $buffer->append('\'type\' => \'' . $type . '\'');
            } else {
                $buffer->append('\'type\' => ' . $type . ',');
            }

            if ($field->isPacked()) {
                $buffer->append(
                    '\'packed\' => true'
                );
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
        );

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
            if ($field->isRepeated()) {
                $buffer->append(
                    '$this->values[self::' . $field->getConstName() . '] = array();'
                );
            } else if (!is_null($field->getDefault())) {
                $buffer->append(
                    '$this->values[self::' . $field->getConstName() . '] = ' .
                    'self::$fields[self::' . $field->getConstName() . '][\'default\'];'
                );
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
}
