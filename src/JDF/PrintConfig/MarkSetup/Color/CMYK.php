<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\CropMarks class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF\PrintConfig\MarkSetup\Color;

use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;
use RWC\Caldera\JDF\PrintConfig\MarkSetup\Color;

/**
 * Class CMYK
 * @package RWC\Caldera\JDF\PrintConfig\MarkSetup\Color
 */
class CMYK extends Color implements IJDFComponent
{
    protected $cyan;
    protected $magenta;
    protected $yellow;
    protected $black;

    /**
     * CMYK constructor.
     * @param int $cyan
     * @param int $magenta
     * @param int $yellow
     * @param int $black
     */
    public function __construct(int $cyan, int $magenta, int $yellow, int $black)
    {
        parent::__construct('CMYK');
        $this->setCyan($cyan);
        $this->setMagenta($magenta);
        $this->setYellow($yellow);
        $this->setBlack($black);
    }

    /**
     * @param int $cyan
     */
    public function setCyan(int $cyan) : void
    {
        $this->cyan = $cyan;
    }

    /**
     * @return int
     */
    public function getCyan() : int
    {
        return $this->cyan;
    }

    /**
     * @param int $magenta
     */
    public function setMagenta(int $magenta) : void
    {
        $this->magenta = $magenta;
    }

    /**
     * @return int
     */
    public function getMagenta() : int
    {
        return $this->magenta;
    }

    /**
     * @param int $yellow
     */
    public function setYellow(int $yellow) : void
    {
        $this->yellow = $yellow;
    }

    /**
     * @return int
     */
    public function getYellow() : int
    {
        return $this->yellow;
    }

    /**
     * @param int $black
     */
    public function setBlack(int $black) : void
    {
        $this->black = $black;
    }

    /**
     * @return int
     */
    public function getBlack() : int
    {
        return $this->black;
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
        $element = $dom->createElement('color');

        $mode = $dom->createElement('mode');
        $mode->appendChild($dom->createTextNode($this->getMode()));
        $element->appendChild($mode);

        $cyan = $dom->createElement('c');
        $cyan->appendChild($dom->createTextNode((string) $this->getCyan()));
        $element->appendChild($cyan);

        $magenta = $dom->createElement('m');
        $magenta->appendChild($dom->createTextNode((string) $this->getMagenta()));
        $element->appendChild($magenta);

        $yellow = $dom->createElement('y');
        $yellow->appendChild($dom->createTextNode((string) $this->getYellow()));
        $element->appendChild($yellow);

        $black = $dom->createElement('k');
        $black->appendChild($dom->createTextNode((string) $this->getBlack()));
        $element->appendChild($black);

        return $element;
    }/** @noinspection PhpMissingParentCallCommonInspection */

    /**
     * Creates a new instance of the IJDFComponent from a DOMElement.
     *
     * @param \DOMElement $element The DOMElement containing the component definition.
     * @return IJDFComponent Returns the Component.
     * @throws JDFException if the DOMElement does not define a valid component descriptor.
     * @throws \RWC\Caldera\JDF\JDFException
     */
    public static function fromJDFElement(\DOMElement $element): IJDFComponent
    {
        return new self(
            self::getTagIntegerValue($element, 'c', true),
            self::getTagIntegerValue($element, 'm', true),
            self::getTagIntegerValue($element, 'y', true),
            self::getTagIntegerValue($element, 'k', true)
        );
    }
}
