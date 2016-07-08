<?php
namespace Allegro\Protobuf\Compiler;

interface DescriptorInterface
{
    /**
     * Returns name
     *
     * @return string
     */
    public function getName();

    /**
     * Returns parent message
     *
     * @return DescriptorInterface
     */
    public function getContaining();

    /**
     * Returns parent file
     *
     * @return FileDescriptor
     */
    public function getFile();
}
