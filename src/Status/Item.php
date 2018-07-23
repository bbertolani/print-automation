<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\Status\Item class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\Status;

use RWC\Caldera\AbstractJDFComponent;
use RWC\Caldera\IJDFComponent;

/**
 * Describes a printed item in a print job status.
 *
 * @package RWC\Caldera\Status
 */
class Item extends AbstractJDFComponent implements IJDFComponent
{
    /**
     * The number of copies printed.
     *
     * @var int
     */
    protected $copies;

    /**
     * Item constructor.
     *
     * @param int $copies The number of copies printed.
     */
    public function __construct(int $copies)
    {
        $this->setCopies($copies);
    }

    /**
     * Sets the number of copies printed.
     *
     * @param int $copies The number of copies printed.
     */
    public function setCopies(int $copies) : void
    {
        $this->copies = $copies;
    }

    /**
     * Returns the number of copies printed.
     *
     * @return int Returns the number of copies printed.
     */
    public function getCopies() : int
    {
        return $this->copies;
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
        $element = $dom->createElement('item');
        $element->setAttribute('copies', (string) $this->getCopies());

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
        $copies = (int) $element->getAttribute('copies');

        return new Item($copies);
    }
}
