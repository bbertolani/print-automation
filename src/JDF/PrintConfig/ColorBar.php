<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\ColorBar class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig;

use RWC\Caldera\AbstractJDFComponent;
use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;
use RWC\Caldera\JDF\PrintConfig\ColorBar\Placement\PlacementOption;
use RWC\Caldera\JDF\PrintConfig\ColorBar\Side\SideOption;

/**
 * ColorBar class
 *
 * @package RWC\Caldera\JDF\PrintConfig
 */
class ColorBar extends AbstractJDFComponent implements IJDFComponent
{
    /**
     * Activates color bars
     *
     * @var bool|null
     */
    protected $enabled;

    /**
     * Sets color bar placement style
     *
     * @var PlacementOption|null
     */
    protected $placement;

    /**
     * Sets color bar placement style
     *
     * @var SideOption
     */
    protected $side;

    /**
     * Sets total width of the colorbar (“colorbar/width”) and the offset to the
     * image area (“colorbar/space”).
     *
     * @var float|null
     */
    protected $space;

    /**
     * Sets total width of the colorbar (“colorbar/width”) and the offset to the
     * image area (“colorbar/space”).
     *
     * @var float|null
     */
    protected $width;

    /**
     * ColorBar constructor.
     * @param bool|null $enabled
     * @param null|PlacementOption $placement
     * @param null|SideOption $sideOption
     * @param float|null $space
     * @param float|null $width
     */
    public function __construct(
        ?bool $enabled = null,
        ?PlacementOption $placement = null,
        ?SideOption $sideOption = null,
        ?float $space = null,
        ?float $width = null
    ) {
        $this->setEnabled($enabled);
        $this->setPlacement($placement);
        $this->setSide($sideOption);
        $this->setSpace($space);
        $this->setWidth($width);
    }

    /**
     * Sets total width of the colorbar (“colorbar/width”) and the offset to the
     * image area (“colorbar/space”).
     *
     * @param float|null $space Sets the offset to the image area.
     */
    public function setSpace(?float $space = null) : void
    {
        $this->space = $space;
    }

    /**
     * Sets total width of the colorbar (“colorbar/width”) and the offset to the
     * image area (“colorbar/space”).
     *
     * @return float|null Returns the offset to the image area.
     */
    public function getSpace() : ?float
    {
        return $this->space;
    }
    /**
     * Sets total width of the colorbar (“colorbar/width”) and the offset to the
     * image area (“colorbar/space”).
     *
     * @param float|null $width Sets total width of the colorbar
     */
    public function setWidth(?float $width = null) : void
    {
        $this->width = $width;
    }

    /**
     * Sets total width of the colorbar (“colorbar/width”) and the offset to the
     * image area (“colorbar/space”).
     *
     * @return float|null Sets total width of the colorbar
     */
    public function getWidth() : ?float
    {
        return $this->width;
    }

    /**
     * Sets color bar placement style
     *
     * @param null|SideOption $side Sets color bar placement style
     */
    public function setSide(?SideOption $side = null) : void
    {
        $this->side = $side;
    }

    /**
     * Sets color bar placement style
     *
     * @return null|SideOption Sets color bar placement style
     */
    public function getSide() : ?SideOption
    {
        return $this->side;
    }

    /**
     * Sets color bar placement style
     *
     * @param null|PlacementOption $placement Sets color bar placement style
     */
    public function setPlacement(?PlacementOption $placement = null) : void
    {
        $this->placement = $placement;
    }

    /**
     * Sets color bar placement style
     *
     * @return null|PlacementOption Sets color bar placement style
     */
    public function getPlacement() : ?PlacementOption
    {
        return $this->placement;
    }
    /**
     * Activates color bars
     *
     * @param bool|null $enabled Activates color bars
     */
    public function setEnabled(?bool $enabled = null) : void
    {
        $this->enabled = $enabled;
    }

    /**
     * Activates color bars
     *
     * @return bool|null Activates color bars
     */
    public function getEnabled() : ?bool
    {
        return $this->enabled;
    }
    /**
     * Generates a DOMElement representing the JDFComponent.
     *
     * @param \DOMDocument $dom The DOMDocument use to generate the element.
     *
     * @return \DOMElement Returns the generated DOMElement for the component.
     */
    public function getJDF(\DOMDocument $dom): \DOMElement
    {
        $element = $dom->createElement('colorbar');

        if ($this->getEnabled() !== null) {
            $enabledEl = $dom->createElement('enabled');
            $enabledEl->appendChild($dom->createTextNode($this->getEnabled() ? 'true' : 'false'));
            $element->appendChild($enabledEl);
        }

        if ($this->getPlacement() !== null) {
            $element->appendChild($this->getPlacement()->getJDF($dom));
        }

        if ($this->getSide() !== null) {
            $element->appendChild($this->getSide()->getJDF($dom));
        }

        if ($this->getSpace() !== null) {
            $spaceEl = $dom->createElement('space');
            $spaceEl->appendChild($dom->createTextNode((string) $this->getSpace()));
            $element->appendChild($spaceEl);
        }

        if ($this->getWidth() !== null) {
            $widthEl = $dom->createElement('width');
            $widthEl->appendChild($dom->createTextNode((string) $this->getWidth()));
            $element->appendChild($widthEl);
        }

        return $element;
    }

    /**
     * Creates a new instance of the IJDFComponent from a DOMElement.
     *
     * @param \DOMElement $element The DOMElement containing the component definition.
     * @return IJDFComponent Returns the Component.
     * @throws JDFException if the DOMElement does not define a valid component descriptor.
     */
    public static function fromJDFElement(\DOMElement $element): IJDFComponent
    {
        $placementEl = $element->getElementsByTagName('placement');
        $placement = null;

        if (count($placementEl) > 0) {
            $placement = PlacementOption::fromJDFElement($placementEl[0]);
        }

        $sideEl = $element->getElementsByTagName('side');
        $side = null;

        if (count($sideEl) > 0) {
            $side = SideOption::fromJDFElement($sideEl[0]);
        }

        return new ColorBar(
            self::getTagBooleanValue($element, 'enabled', false, null),
            $placement,
            $side,
            self::getTagFloatValue($element, 'space', false, null),
            self::getTagFloatValue($element, 'width', false, null)
        );
    }
}
