<?php
declare(strict_types=1);

/**
 * This file contains the namespace RWC\Caldera\Status\InkCons class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\Status;

use RWC\Caldera\AbstractJDFComponent;
use RWC\Caldera\IJDFComponent;

/**
 * Class InkCons
 * @package RWC\Caldera\Status
 */
class InkCons extends AbstractJDFComponent implements IJDFComponent
{
    /**
     * The unit of measure of the ink volume.
     *
     * @var string
     */
    protected $unit;

    /**
     * The total volume of ink consumed.
     *
     * @var float
     */
    protected $total;

    /**
     * An array of Inks in the InkCons.
     *
     * @var Ink[]
     */
    protected $inks;

    /**
     * InkCons constructor.
     *
     * @param string $unit The unity of measure for ink consumption.
     * @param float $total The volume of ink consumed by the print job.
     * @param array $inks The list of Inks consumed by the print job.
     */
    public function __construct(string $unit, float $total, array $inks = [])
    {
        $this->setUnit($unit);
        $this->setTotal($total);
        $this->setInks($inks);
    }

    /**
     * Sets the unit of measurement for the ink volume consumed.
     *
     * @param string $unit The unit of measurement for the ink volume consumed.
     */
    public function setUnit(string $unit) : void
    {
        $this->unit = $unit;
    }

    /**
     * Returns the unit of measurement for the ink volume consumed.
     *
     * @return string Returns the unit of measurement for the ink volume consumed.
     */
    public function getUnit() : string
    {
        return $this->unit;
    }

    /**
     * Sets the total volume of ink consumed.
     *
     * @param float $total Sets the total volume of ink consumed.
     */
    public function setTotal(float $total) : void
    {
        $this->total = $total;
    }

    /**
     * Returns the total volume of ink consumed.
     *
     * @return float Returns the total amount of ink consumed.
     */
    public function getTotal() : float
    {
        return $this->total;
    }

    /**
     * Adds a single Ink to the InkCons block.
     *
     * @param Ink $ink The Ink to add to the InkCons block.
     */
    public function addInk(Ink $ink) : void
    {
        $this->inks[] = $ink;
    }

    /**
     * Sets the list of Inks in the InkCons.
     *
     * @param Ink[] $inks List of Inks to add to InkCons.
     */
    public function setInks(array $inks) : void
    {
        foreach ($inks as $current) {
            $this->addInk($current);
        }
    }

    /**
     * Returns the list of Inks in the InkCons.
     *
     * @return Ink[] Returns the list of Inks.
     */
    public function getInks() : array
    {
        return $this->inks;
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
        $element = $dom->createElement('ink_cons');
        $element->setAttribute('unit', $this->getUnit());
        $element->setAttribute('total', (string) $this->getTotal());

        foreach ($this->getInks() as $current) {
            $element->appendChild($current->getJDF($dom));
        }

        return $element;
    }

    /**
     * Creates a new instance of the IJDFComponent from a DOMElement.
     *
     * @param \DOMElement $element The DOMElement containing the component definition.
     * @return IJDFComponent Returns the Component.s
     */
    public static function fromJDFElement(\DOMElement $element): IJDFComponent
    {
        $unit = $element->getAttribute('unit');
        $total = (float) $element->getAttribute('total');

        $inkEls = $element->getElementsByTagName('ink');

        $inks = [];
        /** @var \DOMElement $inkEl */
        foreach ($inkEls as $inkEl) {
            $inks[] = Ink::fromJDFElement($inkEl);
        }

        return new InkCons($unit, $total, $inks);
    }
}
