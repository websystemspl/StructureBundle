<?php 

namespace Websystems\StructureBundle\Block;

use Twig\Environment;
use Websystems\StructureBundle\Block;
use Websystems\StructureBundle\BlockInterface;

class CodeBlock extends Block implements BlockInterface
{
    private ?string $uid = null;
    private ?string $paddingTop = "";
    private ?string $paddingRight = "";
    private ?string $paddingBottom = "";
    private ?string $paddingLeft = "";
    private ?string $marginTop = "";
    private ?string $marginRight = "";
    private ?string $marginBottom = "";
    private ?string $marginLeft = "";
    private string $background = "";
    private string $color = "";
    private string $align = 'left';
    private string $code = '';
    private string $renderedHtml = '';

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
        $this->color = $properties['settings']['Color'];
        $this->align = $properties['settings']['Align'];
        $this->code = $properties['code'];
    }

    public function render(Environment $twig)
    {
        $this->renderedHtml = $twig->render('@Structure/block/code_block.html.twig', [
            'code' => $this->code,
            'uid'=> $this->uid,
            'paddingTop' => $this->paddingTop,
            'paddingRight' => $this->paddingRight,
            'paddingBottom' => $this->paddingBottom,
            'paddingLeft' => $this->paddingLeft,
            'marginTop' => $this->marginTop,
            'marginRight' => $this->marginRight,
            'marginBottom' => $this->marginBottom,
            'marginLeft' => $this->marginLeft,
            'background' => $this->background,
            'color' => $this->color,
            'align' => $this->align,
        ]);
    }

    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function getPaddingTop(): ?string
    {
        return $this->paddingTop;
    }

    public function getPaddingRight(): ?string
    {
        return $this->paddingRight;
    }

    public function getPaddingBottom(): ?string
    {
        return $this->paddingBottom;
    }

    public function getPaddingLeft(): ?string
    {
        return $this->paddingLeft;
    }

    public function getMarginTop(): ?string
    {
        return $this->marginTop;
    }

    public function getMarginRight(): ?string
    {
        return $this->marginRight;
    }

    public function getMarginBottom(): ?string
    {
        return $this->marginBottom;
    }   

    public function getMarginLeft(): ?string
    {
        return $this->marginLeft;
    }

    public function getBackground(): string
    {
        return $this->background;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getAlign(): string
    {
        return $this->align;
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

    /**
     * Get the value of code
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }
}