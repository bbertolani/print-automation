<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\Collate class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig;

use RWC\Caldera\AbstractJDFComponent;
use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;

/**
 * ColorBar class
 *
 * @package RWC\Caldera\JDF\PrintConfig
 */
class Collate extends AbstractJDFComponent implements IJDFComponent
{
    /**
     * New in 9.10. Enables multi-page collate feature
     *
     * @var bool|null
     */
    protected $enabled;

    /**
     * New in 9.10. Inverses the page order
     *
     * @var bool|null
     */
    protected $inverseOrder;

    /**
     * Collate constructor.
     * @param bool|null $enabled
     * @param bool|null $inverseOrder
     */
    public function __construct(
        ?bool $enabled = null,
        ?bool $inverseOrder = null
    ) {
        $this->setEnabled($enabled);
        $this->setInverseOrder($inverseOrder);
    }

    /**
     * New in 9.10. Inverses the page order
     *
     * @param bool|null $inverseOrder New in 9.10. Inverses the page order
     */
    public function setInverseOrder(?bool $inverseOrder = null) : void
    {
        $this->inverseOrder = $inverseOrder;
    }

    /**
     * New in 9.10. Inverses the page order
     *
     * @return bool|null New in 9.10. Inverses the page order
     */
    public function getInverseOrder() : ?bool
    {
        return $this->inverseOrder;
    }

    /**
     * New in 9.10. Enables multi-page collate feature
     *
     * @param bool|null $enabled New in 9.10. Enables multi-page collate feature
     */
    public function setEnabled(?bool $enabled = null) : void
    {
        $this->enabled = $enabled;
    }

    /**
     * New in 9.10. Enables multi-page collate feature
     *
     * @return bool|null New in 9.10. Enables multi-page collate feature
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
        $element = $dom->createElement('collate');

        if (! is_null($this->getEnabled())) {
            $enabled = $dom->createElement('enabled');
            $enabled->appendChild($dom->createTextNode($this->getEnabled() ? 'true' : 'false'));
            $element->appendChild($enabled);
        }

        if (! is_null($this->getInverseOrder())) {
            /** @noinspection SpellCheckingInspection */
            $inverseOrder = $dom->createElement('invorder');
            $inverseOrder->appendChild($dom->createTextNode($this->getInverseOrder() ? 'true' : 'false'));
            $element->appendChild($inverseOrder);
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
        /** @noinspection SpellCheckingInspection */
        return new Collate(
            self::getTagBooleanValue($element, 'enabled', false, null),
            self::getTagBooleanValue($element, 'invorder', false, null)
        );
    }
}
