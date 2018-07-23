<?php
declare(strict_types=1);

/**
 * This file contains the namespace RWC\Caldera\Status\Unit class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\Status;

use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;

/**
 * A configurable element for units of measure.
 *
 * The Unit class can be used to specify elements such as print_width and
 * media_width in a Caldera Status element. They provide an element name (the
 * rendered tag), a unit of measure (such as "Inches"), and a floating point
 * value.
 *
 * @package RWC\Caldera\Status
 */
class Unit implements IJDFComponent
{
    /**
     * The tag name.
     *
     * @var string
     */
    protected $name;

    /**
     * The unit of measurement (ex. "Inches")
     * @var string
     */
    protected $unit;

    /**
     * The measurement value.
     *
     * @var float
     */
    protected $value;

    /**
     * Sets the tag name.
     *
     * @param string $name The tag name
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * Returns the tag name.
     *
     * @return string Returns the tag name.
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Sets the unit of measurement.
     *
     * @param string $unit The unit of measurement.
     */
    public function setUnit(string $unit) : void
    {
        $this->unit = $unit;
    }

    /**
     * Returns the unit of measurement.
     *
     * @return string Returns the unit of measurement.
     */
    public function getUnit() : string
    {
        return $this->unit;
    }

    /**
     * Sets the unit value.
     *
     * @param float $value The unit value.
     */
    public function setValue(float $value) : void
    {
        $this->value = $value;
    }

    /**
     * Returns the unit value.
     *
     * @return float Returns the unit value.
     */
    public function getValue() : float
    {
        return $this->value;
    }

    /**
     * Creates a new Unit.
     *
     * The name specifies the tag to render. The unit specifies the unit of
     * measurement. The value specifies the floating point measurement amount.
     *
     * @param string $name The tag name.
     * @param string $unit The unit of measurement.
     * @param float $value The measurement value.
     */
    public function __construct(string $name, string $unit, float $value)
    {
        $this->setName($name);
        $this->setUnit($unit);
        $this->setValue($value);
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
        $element = $dom->createElement($this->getName());
        $element->setAttribute('unit', $this->getUnit());
        $element->appendChild($dom->createTextNode((string)$this->getValue()));
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
        // TODO: Implement fromJDFElement() method.
    }
}
