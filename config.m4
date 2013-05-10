dnl $Id$
dnl config.m4 for extension protobuf

PHP_ARG_ENABLE(protobuf, whether to enable protobuf support,
[  --enable-protobuf       enable protobuf support])

if test "$PHP_PROTOBUF" != "no"; then
  PHP_NEW_EXTENSION(protobuf, protobuf.c reader.c writer.c, $ext_shared)
fi

PHP_C_BIGENDIAN()
