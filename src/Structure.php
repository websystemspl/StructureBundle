<?php

namespace Websystems\StructureBundle;

use Twig\Environment;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class Structure
{
    private ?array $data = null;
    private array $blockCollection = [];

    public function __construct(
        private Environment $twig,
        private ContainerInterface $container,
        private ParameterBagInterface $parameterBag
    )
    {
    }

    public function loadJsonData(string $json): void
    {
        $this->data = json_decode($json, true);
    }

    public function render(): self
    {
        $this->blockCollection = $this->createBlockObjectArray($this->data);

        return $this;
    }

    public function getHtml(): string
    {
        $html = '';
        foreach($this->blockCollection as $block) {
            $html .= $block->getRenderedHtml();
        }

        return $html;
    }

    public function getBlockCollection(): array
    {
        return $this->blockCollection;
    }

    private function createBlockObjectArray(array $data, array $blocks = [])
    {
        foreach($data as $arrayBlock) {
            $className = "Websystems\\StructureBundle\\Block\\" . $arrayBlock['component'];
            if(class_exists($className)) {
                $block = new $className();
                $block->setContainer($this->container);
                $block->resolveProperties($arrayBlock);

                if(isset($arrayBlock['columns'])) {
                    foreach($arrayBlock['columns'] as $column) {
                        if(count($column) === 0) {
                            continue;
                        }
                        $block->addColumn($this->createBlockObjectArray($column));
                    }
                }

                if(isset($arrayBlock['blocks'])) {
                    $block->setBlocks($this->createBlockObjectArray($arrayBlock['blocks']));
                }

                $block->render($this->twig);
                $blocks[] = $block;
            }
        }      
        
        return $blocks;
    }
}
