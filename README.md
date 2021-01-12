This repository is no longer maintained
=======================================

Since Google's official [Protocol Buffers][1] supports PHP language, it's unjustifiable to maintain this project. Please refer to [Protocol Buffers][1] for PHP language support.

PHP Protobuf - Google's Protocol Buffers for PHP
================================================

Overview
--------

[Protocol Buffers][1] are a way of encoding structured data in an efficient yet extensible format. It might be used in file formats and RPC protocols.

PHP Protobuf is Google's Protocol Buffers implementation for PHP with a goal to provide high performance, including a `protoc` plugin to generate PHP classes from .proto files. The heavy-lifting (a parsing and a serialization) is done by a PHP extension.

### Requirements
* PHP 7.0 or above (for PHP 5 support refer to [php5](https://github.com/allegro/php-protobuf/tree/php5) branch)
* Pear's Console_CommandLine (for the protoc plugin)
* Google's protoc compiler version 2.6 or above

## Getting started

### Installation
1. Clone the source code

    ```
    git clone https://github.com/allegro/php-protobuf
    ```
1. Go to the source code directory

    ```
    cd php-protobuf
    ```
1. Build and install the PHP extension (follow instructions at [php.net][2])

1. Install protoc plugin dependencies

    ```
    composer install
    ```

### Usage

1. Assume you have a file `foo.proto`
    ```
    message Foo
    {
        required int32 bar = 1;
        optional string baz = 2;
        repeated float spam = 3;
    }
    ```

1. Compile `foo.proto`
    ```
    php protoc-gen-php.php foo.proto
    ```

1. Create `Foo` message and populate it with some data
    ```php
    require_once 'Foo.php';
    
    $foo = new Foo();
    $foo->setBar(1);
    $foo->setBaz('two');
    $foo->appendSpam(3.0);
    $foo->appendSpam(4.0);
    ```

1. Serialize a message to a string
    ```php
    $packed = $foo->serializeToString();
    ```

1. Parse a message from a string
    ```php
    $parsedFoo = new Foo();
    try {
        $parsedFoo->parseFromString($packed);
    } catch (Exception $ex) {
        die('Oops.. there is a bug in this example, ' . $ex->getMessage());
    }
    ```

1. Let's see what we parsed out

    ```php
    $parsedFoo->dump();
    ```

    It should produce output similar to the following:
    ```
    Foo {
      1: bar => 1
      2: baz => 'two'
      3: spam(2) =>
        [0] => 3
        [1] => 4
    }
    ```

1. If you would like you can reset an object to its initial state

    ```php
    $parsedFoo->reset();
    ```

Guide
-----

### Compilation

PHP Protobuf comes with Google's protoc compiler plugin. You can run in directly:

    php protoc-gen-php.php -o output_dir foo.proto

or pass it to the *protoc*:

    protoc --plugin=protoc-gen-allegrophp=protoc-gen-php.php --allegrophp_out=output_dir foo.proto

On Windows use `protoc-gen-php.bat` instead.

#### Command line options

* -o out, --out=out - the destination directory for generated files (defaults to the current directory).
* -I proto_path, --proto_path=proto_path - the directory in which to search for imports.
* --protoc=protoc - the protoc compiler executable path.
* -D define, --define=define - define a generator option (i.e. -Dnamespace='Foo\Bar\Baz').

#### Generator options
* namespace - the namespace to be used by the generated PHP classes.

### Message class

The classes generated during the compilation are PSR-0 compliant (each class is put into it's own file). If `namespace` generator option is not defined then a package name (if present) is used to create a namespace. If the package name is not set then a class is put into global space. 

PHP Protobuf module implements `ProtobufMessage` class which encapsulates the protocol logic. A message compiled from a proto file extends this class providing message field descriptors. Based on these descriptors *ProtobufMessage* knows how to parse and serialize a message of a given type.

For each field a set of accessors is generated. The set of methods is different for single value fields (`required` / `optional`) and multi-value fields (`repeated`).

* `required` / `optional`

        get{FIELD}()        // return a field value
        has{FIELD}()        // check whether a field is set
        set{FIELD}($value)  // set a field value to $value

* `repeated`

        append{FIELD}($value)       // append $value to a field
        clear{FIELD}()              // empty field
        get{FIELD}()                // return an array of field values
        getAt{FIELD}($index)        // return a field value at $index index
        getCount{FIELD}()           // return a number of field values
        has{FIELD}()                // check whether a field is set
        getIterator{FIELD}()        // return an ArrayIterator

{FIELD} is a camel cased field name.

### Enum

PHP does not natively support enum type. Hence enum is represented by the PHP integer type. For convenience enum is compiled to a class with set of constants corresponding to its possible values.

### Type mapping

The range of available build-in PHP types poses some limitations. PHP does not support 64-bit positive integer type. Note that parsing big integer values might result in getting unexpected results.

Protocol Buffers types map to PHP types as follows (x86_64):

    | Protocol Buffers | PHP    |
    | ---------------- | ------ |
    | double           | float  |
    | float            |        |
    | ---------------- | ------ |
    | int32            | int    |
    | int64            |        |
    | uint32           |        |
    | uint64           |        |
    | sint32           |        |
    | sint64           |        |
    | fixed32          |        |
    | fixed64          |        |
    | sfixed32         |        |
    | sfixed64         |        |
    | ---------------- | ------ |
    | bool             | bool   |
    | ---------------- | ------ |
    | string           | string |
    | bytes            |        |

Protocol Buffers types map to PHP types as follows (x86):

    | Protocol Buffers | PHP                         |
    | ---------------- | --------------------------- |
    | double           | float                       |
    | float            |                             |
    | ---------------- | --------------------------- |
    | int32            | int                         |
    | uint32           |                             |
    | sint32           |                             |
    | fixed32          |                             |
    | sfixed32         |                             |
    | ---------------- | --------------------------- |
    | int64            | if val <= PHP_INT_MAX       |
    | uint64           | then value is stored as int |
    | sint64           | otherwise as double         |
    | fixed64          |                             |
    | sfixed64         |                             |
    | ---------------- | --------------------------- |
    | bool             | bool                        |
    | ---------------- | --------------------------- |
    | string           | string                      |
    | bytes            |                             |

Not set value is represented by `null` type. To unset value just set its value to `null`.

### Parsing

To parse message create a message class instance and call its `parseFromString` method passing it a serialized message. The errors encountered are signaled by throwing `Exception`. Exception message provides detailed explanation. Required fields not set are silently ignored.

```php
$packed = /* serialized FooMessage */;
$foo = new FooMessage();

try {
    $foo->parseFromString($packed);
} catch (Exception $ex) {
    die('Parse error: ' . $e->getMessage());
}

$foo->dump(); // see what you got
```

### Serialization

To serialize a message call `serializeToString` method. It returns a string containing protobuf-encoded message. The errors encountered are signaled by throwing `Exception`. Exception message provides detailed explanation. A required field not set triggers an error.

```php
$foo = new FooMessage()
$foo->setBar(1);

try {
    $packed = $foo->serializeToString();
} catch (Exception $ex) {
    die 'Serialize error: ' . $e->getMessage();
}

/* do some cool stuff with protobuf-encoded $packed */
```

### Debugging

There might be situations you need to investigate what an actual content of a given message is. What `var_dump` gives on a message instance is somewhat obscure.

The `ProtobufMessage` class comes with `dump` method which prints out a message content to the standard output. It takes one optional argument specifying whether you want to dump only set fields (by default it dumps only set fields). Pass `false` as an argument to dump all fields. Format it produces is similar to `var_dump`.

Alternatively you can use `printDebugString()` method which produces output in protocol buffers text format.

IDE Helper and Auto-Complete Support
------------------------------------

To integrate this extension with your IDE (PhpStorm, Eclipse etc.) and get auto-complete support, simply include `stubs\ProtobufMessage.php` anywhere under your project root.

Known issues
------------

* [maps](https://developers.google.com/protocol-buffers/docs/proto#maps) are not fully supported ([#73](https://github.com/allegro/php-protobuf/issues/73))
* [oneof](https://developers.google.com/protocol-buffers/docs/proto#oneof) is not supported ([#72](https://github.com/allegro/php-protobuf/issues/72))
* [groups](https://developers.google.com/protocol-buffers/docs/proto#groups) are not supported
* [extenions](https://developers.google.com/protocol-buffers/docs/proto#extensions) are not supported ([#131](https://github.com/allegro/php-protobuf/issues/131))

References
----------

* [Protocol Buffers][1]

Acknowledgments
---------------

* PHP7 support ([Sergey](https://github.com/serggp))


[1]: https://developers.google.com/protocol-buffers "Protocol Buffers"
[2]: http://php.net/manual/en/install.pecl.phpize.php
