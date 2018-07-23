<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\Status\Compose class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\Status;

use RWC\Caldera\AbstractJDFComponent;
use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;

/**
 * Describes the content of a nest job.
 *
 * @package RWC\Caldera\Status
 */
class Compose extends AbstractJDFComponent implements IJDFComponent
{
    /**
     * Describes the printed item.
     *
     * @var Item
     */
    protected $item;

    /**
     * Compose constructor.
     *
     * @param Item $item The item printed in the composite job.
     */
    public function __construct(Item $item)
    {
        $this->setItem($item);
    }

    /**
     * Sets the description of the printed item.
     *
     * @param Item $item The description of the printed item.
     */
    public function setItem(Item $item) : void
    {
        $this->item = $item;
    }

    /**
     * Returns the description of the printed item.
     *
     * @return Item Returns the description of the printed Item.
     */
    public function getItem() : Item
    {
        return $this->item;
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
        $element = $dom->createElement('compose');
        $element->appendChild($this->getItem()->getJDF($dom));

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
        $itemsEl = $element->getElementsByTagName('item');

        if (count($itemsEl) == 0) {
            throw new JDFException('Expected sub-element "item" not found.');
        }

        /** @var $item Item */
        $item = Item::fromJDFElement($itemsEl[0]);
        return new Compose($item);
    }
}
