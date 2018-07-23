<?php
declare(strict_types=1);

/**
 * This file contains the namespace RWC\Caldera\Status\Ink class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\Status;

use RWC\Caldera\AbstractJDFComponent;
use RWC\Caldera\IJDFComponent;

/** @noinspection PhpClassNamingConventionInspection */

/**
 * Specifies an ink color and amount used during a print job.
 *
 * @package RWC\Caldera\Status
 */
class Ink extends AbstractJDFComponent implements IJDFComponent
{
    /**
     * The ink name.
     *
     * @var string
     */
    protected $name;

    /**
     * The short ink identifier.
     *
     * @var string
     */
    protected $short;

    /**
     * The unit of measure (ml, ...)
     *
     * @var string
     */
    protected $unit;

    /**
     * The amount of ink used.
     *
     * @var float
     */
    protected $value;

    /**
     * Ink constructor.
     *
     * @param string $name The name of the ink color.
     * @param string $short The one-letter identifier of the ink color.
     * @param string $unit The unit of measure of the ink color.
     * @param float $value The numeric amount of the ink consumed.
     */
    public function __construct(
        string $name,
        string $short,
        string $unit,
        float $value
    ) {
        $this->setName($name);
        $this->setShort($short);
        $this->setUnit($unit);
        $this->setValue($value);
    }
    /**
     * Sets the ink amount used.
     *
     * @param float $value The ink amount used.
     */
    public function setValue(float $value) : void
    {
        $this->value = $value;
    }

    /**
     * Returns the ink amount used.
     *
     * @return float Returns the ink amount.
     */
    public function getValue() : float
    {
        return $this->value;
    }

    /**
     * Sets the unit of measure (ml, ...)
     *
     * @param string $unit The unit of measure (ml, ...)
     */
    public function setUnit(string $unit) : void
    {
        $this->unit = $unit;
    }

    /**
     * Returns the unit of measure (ml, ...)
     *
     * @return string Returns the unit of measure (ml, ...)
     */
    public function getUnit() : string
    {
        return $this->unit;
    }

    /**
     * Sets the short name of the ink color (C, M, Y, K, ...)
     *
     * @param string $short The short name of the ink color (C, M, Y, K, ...)
     */
    public function setShort(string $short) : void
    {
        $this->short = $short;
    }

    /**
     * Returns the short name of the ink color (C, M, Y, K, ...)
     *
     * @return string Returns the short name of the ink color (C, M, Y, K, ...)
     */
    public function getShort() : string
    {
        return $this->short;
    }

    /**
     * Sets the name of the ink color.
     *
     * @param string $name The name of the ink color.
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * Returns the name of the ink color.
     *
     * @return string Returns the name of the ink color.
     */
    public function getName() : string
    {
        return $this->name;
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
        $element = $dom->createElement('ink');
        $element->setAttribute('name', $this->getName());
        $element->setAttribute('short', $this->getShort());
        $element->setAttribute('unit', $this->getUnit());
        $element->appendChild($dom->createTextNode((string) $this->getValue()));
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
        $name = $element->getAttribute('name');
        $short = $element->getAttribute('short');
        $unit = $element->getAttribute('unit');
        $value = (float) $element->textContent;

        return new Ink($name, $short, $unit, $value);
    }
}
