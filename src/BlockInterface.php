<?php

namespace Websystems\StructureBundle;

interface BlockInterface
{
    public function resolveProperties(array $properties): void;
}