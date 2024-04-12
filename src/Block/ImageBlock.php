<?php 

namespace Websystems\StructureBundle\Block;

use Twig\Environment;
use Websystems\StructureBundle\Block;
use Websystems\StructureBundle\BlockInterface;

class ImageBlock extends Block implements BlockInterface
{
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
    private string $align = 'left';
    private string $src = '';
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
        $this->align = $properties['settings']['Align'];
        $this->src = $properties['src'];
    }

    public function render(Environment $twig)
    {
        $this->renderedHtml = $twig->render('@Structure/block/image_block.html.twig', [
            'src' => $this->src,
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
            'align' => $this->align,
        ]);
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
     * Get the value of src
     *
     * @return string
     */
    public function getSrc(): string
    {
        return $this->src;
    }

    /**
     * Set the value of src
     *
     * @param string $src
     *
     * @return self
     */
    public function setSrc(string $src): self
    {
        $this->src = $src;

        return $this;
    }
}