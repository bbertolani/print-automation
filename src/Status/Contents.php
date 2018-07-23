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
use PF\Caldera\JDF\JDFException;

/**
 * Describes the content of a PrintJob in a Caldera Status element.
 *
 * @package RWC\Caldera\Status
 */
class Contents extends AbstractJDFComponent implements IJDFComponent
{
    /**
     * Describes the contents of a composite job.
     *
     * @var Compose|null
     */
    protected $compose;

    /**
     * The item printed in a direct print job.
     *
     * @var Item|null
     */
    protected $item;

    /**
     * Contents constructor.
     * @param null|Compose $compose
     * @param null|Item $item
     */
    public function __construct(?Compose $compose = null, ?Item $item = null)
    {
        $this->setCompose($compose);
        $this->setItem($item);
    }

    /**
     * Describes the contents of a composite job.
     *
     * @param null|Compose $compose Describes the contents of a composite job.
     */
    public function setCompose(?Compose $compose = null) : void
    {
        $this->compose = $compose;
    }

    /**
     * Describes the contents of a composite job.
     *
     * @return null|Compose Describes the contents of a composite job.
     *
     */
    public function getCompose() : ?Compose
    {
        return $this->compose;
    }

    /**
     * Describes the contents of a composite job.
     *
     * @param null|Item $item Describes the contents of a composite job.
     *
     */
    public function setItem(?Item $item = null) : void
    {
        $this->item = $item;
    }

    /**
     * Describes the contents of a composite job.
     *
     * @return null|Item Describes the contents of a composite job.
     */
    public function getItem() : ?Item
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
        $element = $dom->createElement('contents');

        if ($this->getCompose() != null) {
            $element->appendChild($this->getCompose()->getJDF($dom));
        }

        if ($this->getItem() != null) {
            $element->appendChild($this->getItem()->getJDF($dom));
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
        $composeEls = $element->getElementsByTagName('compose');
        $itemEls = $element->getElementsByTagName('item');

        $compose = null;
        $item = null;

        if (count($composeEls) > 0) {
            $compose = Compose::fromJDFElement($composeEls[0]);
        }

        if (count($itemEls) > 0) {
            $item = Item::fromJDFElement($itemEls[0]);
        }

        return new Contents($compose, $item);
    }
}
