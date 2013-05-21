PHP Protobuf - Fast PHP Protocol Buffers implementation
=======================================================

Overview
--------

[Protocol Buffers][1] are a way of encoding structured data in an efficient yet extensible format. It might be used in file formats and RPC protocols.

PHP Protobuf is PHP implementation of Google's Protocol Buffers. Parsing and serialization is provided by ProtobufMessage class which is entirely implemented in extension providing high performance.

PHP Protobuf is highly portable and has no external dependencies. Compiler is written from scratch in pure PHP. Extension has no OS-specific requirements.

Extension is PECL-compliant so compilation is easy. All that is needed are PHP developer tools (i.e. phpize).

Guide
-----

### Compilation ###

Use *protoc-php.php* script to compile your *proto* files. It requires extension to be installed.

        php protoc-php.php foo.proto

### Name conversion ###

* underscore seperated message and enum names are converted to CamelCased
* embedded message and enum names are composed of parent message names seperated by underscore

### Message interface ###

PHP Protobuf module implements *ProtobufMessage* class which encapsulates protocol logic. Message compiled from *proto* file extends this class providing message field descriptors. Based on these descriptors *ProtobufMessage* knows how to parse and serialize messages of the given type.

For each field a set of accessors is generated. Methods actualy accessible are different for single value fields (*required* / *optional*) and multi-value fields (*repeated*).

* *required* / *optional*

            get{FIELD}()        // return field value
            set{FIELD}($value)  // set field value to $value

* repeated

            append{FIELD}($value)       // append $value value to field
            clear{FIELD}()              // empty field
            get{FIELD}()                // return array of field values
            getAt{FIELD}($index)        // return field value at $index index
            getCount{FIELD}()           // return number of field values
            getIterator{FIELD}($index)  // return ArrayIterator for field values

{FIELD} is camel cased field name.

### Enums ###

PHP does not natively support enum type. Hence enum is compiled to a class with set of constants.

Enum field is simple PHP integer type.

### Type mapping ###

Range of available build-in PHP types poses some limitations. PHP does not support 64-bit positive integer type. Note that parsing big integer values might result in getting unexpected results.

Protocol Buffers types map to PHP types as follows:

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

Not set value is represented by *null* type. To unset value just set its value to *null*.

### Parsing ###

To parse message create message class instance and call its *parseFromString* method passing it prior to the serialized message. Errors encountered are signaled by throwing *Exception*. Exception message provides detailed explanation. Required fields not set are silently ignored.

        $packed = /* serialized FooMessage */;
        $foo = new FooMessage();

        try {
            $foo->parseFromString($packed);
        } catch (Exception $ex) {
            die('Parse error: ' . $e->getMessage());
        }

        $foo->dump(); // see what you got

### Serialization ###

To serialize message call *serializeToString* method. It returns a string containing protobuf-encoded message. Errors encountered are signaled by throwing *Exception*. Exception message provides detailed explanation. Required field not set triggers an error.

        $foo = new FooMessage()
        $foo->setBar(1);

        try {
            $packed = $foo->serializeToString();
        } catch (Exception $ex) {
            die 'Serialize error: ' . $e->getMessage();
        }

        /* do some cool stuff with protobuf-encoded $packed */

### Dumping ###

There might be situations you need to investigate what actual content of the given message is. What *var_dump* gives on message instance is somewhat obscure.

*ProtobufMessage* class comes with *dump* method which prints out a message content to the standard output. It takes one optional argument specifing whether you want to dump only set fields. By default it dumps only set fields. Pass *false* as argument to dump all fields. Format it produces is similar to *var_dump*.

### Example ###

* *foo.proto*

        message Foo
        {
            required int32 bar = 1;
            optional string baz = 2;
            repeated float spam = 3;
        }

* *pb_proto_foo.php*

        php protoc-php.php foo.proto

* *foo.php*

        <?php
            require_once 'pb_proto_foo.php';

            $foo = new Foo();
            $foo->setBar(1);
            $foo->setBaz('two');
            $foo->appendSpam(3.0);
            $foo->appendSpam(4.0);

            $packed = $foo->serializeToString();

            $foo->clear();

            try {
                $foo->parseFromString($packed);
            } catch (Exception $ex) {
                die('Upss.. there is a bug in this example');
            }

            $foo->dump();
        ?>

`php foo.php` should produce following output:

        Foo {
          1: bar => 1
          2: baz => 'two'
          3: spam(2) =>
            [0] => 3
            [1] => 4
        }

Compatibility
-------------

PHP Protobuf does not support repeated packed fields.

References
----------

* [Protocol Buffers][1]

[1]: http://code.google.com/p/protobuf/ "Protocol Buffers"
