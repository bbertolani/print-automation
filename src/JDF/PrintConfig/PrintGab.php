<?php
/** @noinspection SpellCheckingInspection */
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\PrintGab class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig;

use RWC\Caldera\IJDFComponent;
use RWC\Caldera\AbstractJDFComponent;
use RWC\Caldera\Configurations;
use RWC\Caldera\JDF\JDFException;
use RWC\Caldera\JDF\PrintConfig\PrintGab\Orient\OrientOption;

/**
 * Page template
 *
 * @package RWC\Caldera\JDF\PrintConfig
 */
class PrintGab extends AbstractJDFComponent
{
    /**
     * Enable page templates
     *
     * @var bool|null
     */
    protected $enabled;

    /**
     * Page template width (in inches).
     *
     * @var float|null
     */
    protected $width;

    /**
     * Page template height (in inches).
     *
     * @var float|null
     */
    protected $height;

    /**
     * Page template inner left margin.
     *
     * @var float|null
     */
    protected $marginLeft;

    /**
     * Page template inner top margin.
     *
     * @var float|null
     */
    protected $marginTop;

    /**
     * Page template inner right margin.
     *
     * @var float|null
     */
    protected $marginRight;

    /**
     * Page template inner bottom margin.
     *
     * @var float|null
     */
    protected $marginBottom;

    /**
     * Template position on the page. Do not worry about hardware margins, they
     * are taken into account automatically.
     *
     * @var float|null
     */
    protected $positionX;

    /**
     * Template position on the page. Do not worry about hardware margins, they
     * are taken into account automatically.
     *
     * @var float|null
     */
    protected $positionY;

    /**
     * Template orientation.
     *
     * @var OrientOption|null
     */
    protected $orient;

    /**
     * PrintGab constructor.
     *
     * @param bool|null $enabled True to enable page template.
     * @param float|null $width Page template width in inches.
     * @param float|null $height Page template height in inches.
     * @param float|null $marginLeft Inner left page margin.
     * @param float|null $marginTop Inner top page margin.
     * @param float|null $marginRight Inner right page margin.
     * @param float|null $marginBottom Inner bottom page margin.
     * @param float|null $positionX Left position within the page.
     * @param float|null $positionY Top position within the page.
     * @param null|OrientOption $orient Page orientation.
     */
    public function __construct(
        ?bool $enabled = null,
        ?float $width = null,
        ?float $height = null,
        ?float $marginLeft = null,
        ?float $marginTop = null,
        ?float $marginRight = null,
        ?float $marginBottom = null,
        ?float $positionX = null,
        ?float $positionY = null,
        ?OrientOption $orient = null
    ) {
        $this->setEnabled($enabled);
        $this->setWidth($width);
        $this->setHeight($height);
        $this->setMarginLeft($marginLeft);
        $this->setMarginTop($marginTop);
        $this->setMarginRight($marginRight);
        $this->setMarginBottom($marginBottom);
        $this->setPositionX($positionX);
        $this->setPositionY($positionY);
        $this->setOrientation($orient);
    }
    /**
     * Template orientation.
     *
     * @param OrientOption|null $orient Template orientation.
     */
    public function setOrientation(?OrientOption $orient = null) : void
    {
        $this->orient = $orient;
    }

    /**
     * Template orientation.
     *
     * @return null|OrientOption Template orientation.
     */
    public function getOrientation() :?OrientOption
    {
        return $this->orient;
    }

    /**
     * Template position on the page. Do not worry about hardware margins, they
     * are taken into account automatically.
     *
     * @param float|null $positionY Template position on the page.
     */
    public function setPositionY(?float $positionY = null) : void
    {
        $this->positionY = $positionY;
    }

    /**
     * Template position on the page. Do not worry about hardware margins, they
     * are taken into account automatically.
     *
     * @return float|null Template position on the page.
     */
    public function getPositionY() : ?float
    {
        return $this->positionY;
    }

    /**
     * Template position on the page. Do not worry about hardware margins, they
     * are taken into account automatically.
     *
     * @param float $positionX Template position on the page.
     */
    public function setPositionX(?float $positionX = null) : void
    {
        $this->positionX = $positionX;
    }

    /**
     * Template position on the page. Do not worry about hardware margins, they
     * are taken into account automatically.
     *
     * @return float|null Template position on the page.
     */
    public function getPositionX() : ?float
    {
        return $this->positionX;
    }

    /**
     * Page template inner bottom margin.
     *
     * @param float|null $marginBottom Page template inner bottom margin.
     */
    public function setMarginBottom(?float $marginBottom = null) : void
    {
        $this->marginBottom = $marginBottom;
    }

    /**
     * Page template inner bottom margin.
     *
     * @return float|null Page template inner bottom margin.
     */
    public function getMarginBottom() : ?float
    {
        return $this->marginBottom;
    }

    /**
     * Page template inner right margin.
     *
     * @param float|null $marginRight Page template inner right margin.
     */
    public function setMarginRight(?float $marginRight = null) : void
    {
        $this->marginRight = $marginRight;
    }

    /**
     * Page template inner right margin.
     *
     * @return float|null Page template inner right margin.
     */
    public function getMarginRight() : ?float
    {
        return $this->marginRight;
    }

    /**
     * Page template inner top margin.
     *
     * @param float|null $marginTop Page template inner top margin.
     */
    public function setMarginTop(?float $marginTop = null) : void
    {
        $this->marginTop = $marginTop;
    }

    /**
     * Page template inner top margin.
     *
     * @return float|null Page template inner top margin.
     */
    public function getMarginTop() : ?float
    {
        return $this->marginTop;
    }

    /**
     * Page template inner left margin.
     *
     * @param float|null $marginLeft Page template inner left margin.
     */
    public function setMarginLeft(?float $marginLeft = null) : void
    {
        $this->marginLeft = $marginLeft;
    }

    /**
     * Page template inner left margin.
     *
     * @return float|null Page template inner left margin.
     */
    public function getMarginLeft() : ?float
    {
        return $this->marginLeft;
    }

    /**
     * Page template dimensions in inches.
     *
     * @param float|null $height Page template dimensions in inches.
     */
    public function setHeight(?float $height = null) : void
    {
        $this->height = $height;
    }

    /**
     * Page template dimensions in inches.
     *
     * @return float|null Page template dimensions in inches.
     */
    public function getHeight() : ?float
    {
        return $this->height;
    }


    /**
     * Page template dimensions in inches.
     *
     * @param float|null $width Page template dimensions in inches.
     */
    public function setWidth(?float $width = null) : void
    {
        $this->width = $width;
    }

    /**
     * Page template dimensions in inches.
     *
     * @return float|null Page template dimensions in inches.
     */
    public function getWidth() : ?float
    {
        return $this->width;
    }

    /**
     * Enable page templates.
     *
     * If true, activate page template. You must define the templte size in
     * other options. False disables page template.
     *
     * @param bool $enabled True to enable page template.
     */
    public function setEnabled(?bool $enabled = false) : void
    {
        $this->enabled = $enabled;
    }

    /**
     * Enable page templates.
     *
     * @return bool Enable page templates.
     */
    public function getEnabled() : bool
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
        $element = $dom->createElementNS(Configurations::XML_CALDERA_NAMESPACE, 'PrintConfig');

        if (! is_null($this->getEnabled())) {
            $child = $dom->createElement('enabled');
            $child->appendChild($dom->createTextNode($this->getEnabled() ? 'true' : 'false'));
            $element->appendChild($child);
        }

        if (! is_null($this->getWidth())) {
            $child = $dom->createElement('width');
            $child->appendChild($dom->createTextNode((string) $this->getWidth()));
            $element->appendChild($child);
        }

        if (! is_null($this->getHeight())) {
            $child = $dom->createElement('height');
            $child->appendChild($dom->createTextNode((string) $this->getHeight()));
            $element->appendChild($child);
        }

        if (! is_null($this->getMarginLeft())) {
            $child = $dom->createElement('mg_left');
            $child->appendChild($dom->createTextNode((string) $this->getMarginLeft()));
            $element->appendChild($child);
        }

        if (! is_null($this->getMarginTop())) {
            $child = $dom->createElement('mg_top');
            $child->appendChild($dom->createTextNode((string) $this->getMarginTop()));
            $element->appendChild($child);
        }

        if (! is_null($this->getMarginRight())) {
            $child = $dom->createElement('mg_right');
            $child->appendChild($dom->createTextNode((string) $this->getMarginRight()));
            $element->appendChild($child);
        }

        if (! is_null($this->getMarginBottom())) {
            $child = $dom->createElement('mg_bottom');
            $child->appendChild($dom->createTextNode((string) $this->getMarginBottom()));
            $element->appendChild($child);
        }

        if (! is_null($this->getPositionX())) {
            $child = $dom->createElement('pos_x');
            $child->appendChild($dom->createTextNode((string) $this->getPositionX()));
            $element->appendChild($child);
        }

        if (! is_null($this->getPositionY())) {
            $child = $dom->createElement('pos_y');
            $child->appendChild($dom->createTextNode((string) $this->getPositionY()));
            $element->appendChild($child);
        }

        if (! is_null($this->getOrientation())) {
            $element->appendChild($this->getOrientation()->getJDF($dom));
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
        $enabled = self::getTagBooleanValue($element, 'enabled');
        $width = self::getTagFloatValue($element, 'width');
        $height = self::getTagFloatValue($element, 'height');
        $marginLeft = self::getTagFloatValue($element, 'mg_left');
        $marginTop = self::getTagFloatValue($element, 'mg_top');
        $marginRight = self::getTagFloatValue($element, 'mg_right');
        $marginBottom = self::getTagFloatValue($element, 'mg_bottom');
        $positionX = self::getTagFloatValue($element, 'pos_x');
        $positionY = self::getTagFloatValue($element, 'pos_y');
        $orientEls = $element->getElementsByTagName('orient');
        $orient = null;

        if (count($orientEls) > 0) {
            $orient = OrientOption::fromJDFElement($orientEls[0]);
        }

        return new PrintGab(
            $enabled,
            $width,
            $height,
            $marginLeft,
            $marginTop,
            $marginRight,
            $marginBottom,
            $positionX,
            $positionY,
            $orient
        );
    }
}
