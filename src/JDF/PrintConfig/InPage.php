<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\InPage class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig;

use RWC\Caldera\IJDFComponent;

/**
 * Class InPage
 * @package RWC\Caldera\JDF\PrintConfig
 */
class InPage implements IJDFComponent
{
    /**
     * Page margins
     *
     * @var float
     */
    protected $marginLeft;

    /**
     * Page margins
     *
     * @var float
     */
    protected $marginTop;

    /**
     * Page margins
     *
     * @var float
     */
    protected $marginRight;

    /**
     * Page margins
     *
     * @var float
     */
    protected $marginBottom;

    /**
     * InPage constructor.
     *
     * @param float $marginLeft Page margins
     * @param float $marginTop Page margins
     * @param float $marginRight Page margins
     * @param float $marginBottom Page margins
     */
    public function __construct(
        float $marginLeft,
        float $marginTop,
        float $marginRight,
        float $marginBottom
    ) {
        $this->setMarginLeft($marginLeft);
        $this->setMarginTop($marginTop);
        $this->setMarginRight($marginRight);
        $this->setMarginBottom($marginBottom);
    }

    /**
     * Page margins
     *
     * @param float $marginBottom Page margins
     */
    public function setMarginBottom(float $marginBottom) : void
    {
        $this->marginBottom = $marginBottom;
    }

    /**
     * Page margins
     *
     * @return float Page margins
     */
    public function getMarginBottom() : float
    {
        return $this->marginBottom;
    }

    /**
     * Page margins
     *
     * @param float $marginRight Page margins
     */
    public function setMarginRight(float $marginRight) : void
    {
        $this->marginRight = $marginRight;
    }

    /**
     * Page margins
     *
     * @return float Page margins
     */
    public function getMarginRight() : float
    {
        return $this->marginRight;
    }

    /**
     * Page margins
     *
     * @param float $marginTop Page margins
     */
    public function setMarginTop(float $marginTop) : void
    {
        $this->marginTop = $marginTop;
    }

    /**
     * Page margins
     *
     * @return float Page margins
     */
    public function getMarginTop() : float
    {
        return $this->marginTop;
    }

    /**
     * Page margins
     *
     * @param float $marginLeft Page margins
     */
    public function setMarginLeft(float $marginLeft) : void
    {
        $this->marginLeft = $marginLeft;
    }

    /**
     * Page margins
     *
     * @return float Page margins
     */
    public function getMarginLeft() : float
    {
        return $this->marginLeft;
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
        $element = $dom->createElement('in_page');

        $marginLeft = $dom->createElement('mg_left');
        $marginLeft->appendChild($dom->createTextNode((string) $this->getMarginLeft()));
        $element->appendChild($marginLeft);

        $marginTop = $dom->createElement('mg_top');
        $marginTop->appendChild($dom->createTextNode((string) $this->getMarginTop()));
        $element->appendChild($marginTop);

        $marginRight = $dom->createElement('mg_right');
        $marginRight->appendChild($dom->createTextNode((string) $this->getMarginRight()));
        $element->appendChild($marginRight);

        $marginBottom = $dom->createElement('mg_bottom');
        $marginBottom->appendChild($dom->createTextNode((string) $this->getMarginBottom()));
        $element->appendChild($marginBottom);

        return $element;
    }

    /**
     * Creates a new instance of the IJDFComponent from a DOMElement.
     *
     * @param \DOMElement $element The DOMElement containing the component definition.
     * @return IJDFComponent Returns the Component.
     */
    public static function fromJDFElement(\DOMElement $element): IJDFComponent
    {
        $mgLeftEl = $element->getElementsByTagName('mg_left');
        $mgTopEl = $element->getElementsByTagName('mg_top');
        $mgRightEl = $element->getElementsByTagName('mg_right');
        $mgBottomEl = $element->getElementsByTagName('mg_bottom');

        $mgLeft = null;
        $mgTop = null;
        $mgRight = null;
        $mgBottom = null;

        if (count($mgLeftEl) > 0) {
            $mgLeft = (float) $mgLeftEl[0]->textContent;
        }

        if (count($mgTopEl) > 0) {
            $mgTop = (float) $mgTopEl[0]->textContent;
        }

        if (count($mgRightEl) > 0) {
            $mgRight = (float) $mgRightEl[0]->textContent;
        }

        if (count($mgBottomEl) > 0) {
            $mgBottom = (float) $mgBottomEl[0]->textContent;
        }

        return new InPage($mgLeft, $mgTop, $mgRight, $mgBottom);
    }
}
