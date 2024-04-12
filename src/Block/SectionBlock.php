<?php 

namespace Websystems\StructureBundle\Block;

use Twig\Environment;
use Websystems\StructureBundle\Block;
use Websystems\StructureBundle\BlockInterface;

class SectionBlock extends Block implements BlockInterface
{
    private array $blocks = [];
    private ?string $uid = null;
    private string $paddingTop = "";
    private string $paddingRight = "";
    private string $paddingBottom = "";
    private string $paddingLeft = "";
    private string $marginTop = "";
    private string $marginRight = "";
    private string $marginBottom = "";
    private string $marginLeft = "";
    private string $background = "";    
    private bool $container = false;
    private string $renderedHtml = '';

    public function render(Environment $twig)
    {
        $this->renderedHtml = $twig->render('@Structure/block/section_block.html.twig', [
            'uid' => $this->uid,
            'blocks' => $this->blocks,
            'paddingTop' => $this->paddingTop,
            'paddingRight' => $this->paddingRight,
            'paddingBottom' => $this->paddingBottom,
            'paddingLeft' => $this->paddingLeft,
            'marginTop' => $this->marginTop,
            'marginRight' => $this->marginRight,
            'marginBottom' => $this->marginBottom,
            'marginLeft' => $this->marginLeft,
            'background' => $this->background,
            'container' => $this->container,
        ]);
    }    

    public function resolveProperties(array $properties): void
    {
        $this->uid = $properties['uid'];
        $this->paddingTop = $properties['settings']['Padding']['top'];
        $this->paddingRight = $properties['settings']['Padding']['right'];
        $this->paddingBottom = $properties['settings']['Padding']['bottom'];
        $this->paddingLeft = $properties['settings']['Padding']['left'];
        $this->marginTop = $properties['settings']['Margin']['top'];
        $this->marginRight = $properties['settings']['Margin']['right'];
        $this->marginBottom = $properties['settings']['Margin']['bottom'];
        $this->marginLeft = $properties['settings']['Margin']['left'];
        $this->background = $properties['settings']['Background'];
        $this->container = $properties['settings']['Container'];
    }

    public function setBlocks(array $blocks): void
    {
        $this->blocks = $blocks;
    }

    public function getBlocks(): array
    {
        return $this->blocks;
    }

    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function getPaddingTop(): int
    {
        return $this->paddingTop;
    }

    public function getPaddingRight(): int
    {
        return $this->paddingRight;
    }

    public function getPaddingBottom(): int
    {
        return $this->paddingBottom;
    }

    public function getPaddingLeft(): int
    {
        return $this->paddingLeft;
    }

    public function getMarginTop(): int
    {
        return $this->marginTop;
    }

    public function getMarginRight(): int
    {
        return $this->marginRight;
    }

    public function getMarginBottom(): int
    {
        return $this->marginBottom;
    }

    public function getMarginLeft(): int
    {
        return $this->marginLeft;
    }   

    public function getBackground(): string
    {
        return $this->background;
    }

    public function isContainer(): bool
    {
        return $this->container;
    }

    /**
     * Get the value of renderedHtml
     *
     * @return string
     */
    public function getRenderedHtml(): string
    {
        return $this->renderedHtml;
    }

    /**
     * Set the value of renderedHtml
     *
     * @param string $renderedHtml
     *
     * @return self
     */
    public function setRenderedHtml(string $renderedHtml): self
    {
        $this->renderedHtml = $renderedHtml;

        return $this;
    }
}