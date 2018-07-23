<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\Loading class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF\PrintConfig;

use RWC\Caldera\IJDFComponent;

/**
 * Class Loading
 * @package RWC\Caldera\JDF\PrintConfig
 */
class Loading implements IJDFComponent
{
    /**
     * Loading selector (depends on the printer).
     *
     * @var string
     */
    protected $value;

    /**
     * Internal loading id (undocumented).
     *
     * @var string|null
     */
    protected $loadingId;

    /**
     *  Internal loading id (undocumented).
     *
     * @var string|null
     */
    protected $inPageId;

    /**
     * Loading constructor.
     *
     * @param string $value Loading selector (depends on the printer).
     * @param null|string $loadingId Internal loading id (undocumented).
     * @param null|string $inPageId Internal loading id (undocumented).
     */
    public function __construct(
        string $value,
        ?string $loadingId = null,
        ?string $inPageId = null
    ) {
        $this->setValue($value);
        $this->setLoadingId($loadingId);
        $this->setInPageId($inPageId);
    }

    /**
     * Loading selector (depends on the printer).
     *
     * @param string $value Loading selector (depends on the printer).
     */
    public function setValue(string $value) : void
    {
        $this->value = $value;
    }

    /**
     * Loading selector (depends on the printer).
     *
     * @return string Loading selector (depends on the printer).
     */
    public function getValue() : string
    {
        return $this->value;
    }

    /**
     * Internal loading id (undocumented).
     *
     * @param null|string $loadingId Internal loading id (undocumented).
     */
    public function setLoadingId(?string $loadingId = null) : void
    {
        $this->loadingId = $loadingId;
    }

    /**
     * Internal loading id (undocumented).
     *
     * @return null|string Internal loading id (undocumented).
     */
    public function getLoadingId() : ?string
    {
        return $this->loadingId;
    }

    /**
     * Internal loading id (undocumented).
     *
     * @param null|string $inPageId Internal loading id (undocumented).
     */
    public function setInPageId(?string $inPageId = null) : void
    {
        $this->inPageId = $inPageId;
    }

    /**
     * Internal loading id (undocumented).
     *
     * @return null|string Internal loading id (undocumented).
     */
    public function getInPageId() : ?string
    {
        return $this->inPageId;
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
        $element = $dom->createElement('loading');
        $element->appendChild($dom->createTextNode($this->getValue()));

        if (! empty($this->getLoadingId())) {
            $element->setAttribute('loading_id', $this->getLoadingId());
        }

        if (! empty($this->getInPageId())) {
            $element->setAttribute('in_page_id', $this->getInPageId());
        }

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
        $loadingId = $element->getAttribute('loading_id');
        $inPageId  = $element->getAttribute('in_page_id');
        $value     = $element->nodeValue;

        $loadingId = empty($loadingId) ? null : $loadingId;
        $inPageId  = empty($inPageId) ? null : $inPageId;

        return new Loading($value, $loadingId, $inPageId);
    }
}
