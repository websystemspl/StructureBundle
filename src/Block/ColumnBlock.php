<?php 

namespace Websystems\StructureBundle\Block;

use Twig\Environment;
use Websystems\StructureBundle\Block;
use Websystems\StructureBundle\BlockInterface;

class ColumnBlock extends Block implements BlockInterface
{
    private array $columns = [];
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
    private int $columnsCount = 1;
    private ?string $columnsSizes = "";
    private string $alignVertical = "start";
    private string $renderedHtml = '';

    public function render(Environment $twig)
    {
        $this->renderedHtml = $twig->render('@Structure/block/column_block.html.twig', [
            'uid' => $this->uid,
            'columns' => $this->columns,
            'paddingTop' => $this->paddingTop,
            'paddingRight' => $this->paddingRight,
            'paddingBottom' => $this->paddingBottom,
            'paddingLeft' => $this->paddingLeft,
            'marginTop' => $this->marginTop,
            'marginRight' => $this->marginRight,
            'marginBottom' => $this->marginBottom,
            'marginLeft' => $this->marginLeft,
            'background' => $this->background,       
            'columnsCount' => $this->columnsCount,     
            'alignVertical' => $this->alignVertical,    
            'columnsSizes' => $this->columnsSizes 

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
        $this->columnsCount = $properties['columnsCount'];
        $this->alignVertical = $properties['alignVertical'];
        $this->columnsSizes = implode(' ', $properties['columnsSizes']);
    }    

    public function addColumn($column): void
    {
        $this->columns[] = $column;
    }

    public function getColumns(): array
    {
        return $this->columns;
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
     * Get the value of columnsCount
     *
     * @return int
     */
    public function getColumnsCount(): int
    {
        return $this->columnsCount;
    }

    /**
     * Set the value of columnsCount
     *
     * @param int $columnsCount
     *
     * @return self
     */
    public function setColumnsCount(int $columnsCount): self
    {
        $this->columnsCount = $columnsCount;

        return $this;
    }

    /**
     * Get the value of alignVertical
     *
     * @return string
     */
    public function getAlignVertical(): string
    {
        return $this->alignVertical;
    }

    /**
     * Get the value of columnsSizes
     */ 
    public function getColumnsSizes()
    {
        return $this->columnsSizes;
    }
}