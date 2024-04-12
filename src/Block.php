<?php

namespace Websystems\StructureBundle;

abstract class Block
{
    private $container;

    public function setContainer($container)
    {
        $this->container = $container;
    }

    public function getContainer()
    {
        return $this->container;
    }
}