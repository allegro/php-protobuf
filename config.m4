dnl $Id$
dnl config.m4 for extension allegro_protobuf

PHP_ARG_ENABLE(allegro-protobuf, whether to enable allegro_protobuf extension,
[  --enable-allegro-protobuf
                          Enable allegro_protobuf extension])

if test "$PHP_ALLEGRO_PROTOBUF" != "no"; then
  PHP_NEW_EXTENSION(allegro_protobuf, protobuf.c reader.c writer.c, $ext_shared)
fi

PHP_C_BIGENDIAN()
