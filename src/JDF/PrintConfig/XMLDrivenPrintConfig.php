<?php
declare(strict_types=1);

/**
 * This file contains the PF\PrintJob\JDF\PrintConfigXMLDrivenPrintConfig class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF\PrintConfig;

use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;
use RWC\Caldera\JDF\PrintConfig;

/**
 * Class XMLDrivenPrintConfig
 * @package RWC\Caldera\JDF\PrintConfig
 */
class XMLDrivenPrintConfig extends PrintConfig implements IJDFComponent
{
    /**
     * @var string
     */
    protected $xmlString;

    /**
     * @var \DOMDocument
     */
    protected $domDocument;

    /**
     * @var \DOMElement
     */
    protected $preset;
    /** @noinspection PhpMissingParentConstructorInspection */

    /**
     * XMLDrivenPrintConfig constructor.
     * @param string $xml
     * @throws JDFException
     */
    public function __construct(string $xml)
    {
        $this->setXml($xml);
    }

    /**
     * @param string $xmlString
     * @throws JDFException
     */
    public function setXml(string $xmlString) : void
    {
        $this->xmlString = $xmlString;
        $this->domDocument = new \DOMDocument();
        $this->domDocument->loadXML($this->xmlString);
        $this->preset = $this->domDocument->firstChild;

        if ($this->preset->nodeName != 'preset') {
            throw new JDFException("XML's root node is not a preset.");
        }
    }

    /**
     * @return string
     */
    public function getXml() : string
    {
        return $this->xmlString;
    }

    /**
     * @return \DOMElement
     */
    public function getPreset() : \DOMElement
    {
        return $this->preset;
    }/** @noinspection PhpMissingParentCallCommonInspection */

    /**
     * Generates a DOMElement representing the JDFComponent.
     *
     * @param \DOMDocument $dom The DOMDocument use to generate the element.
     *
     * @return \DOMElement Returns the generated DOMElement for the component.
     */
    public function getJDF(\DOMDocument $dom) : \DOMElement
    {
        /**
         * @var $preset \DOMElement
         */
        $preset = $dom->importNode($this->getPreset(), true);

        return $preset;
    }/** @noinspection PhpMissingParentCallCommonInspection */

    /**
     * Creates a new instance of the IJDFComponent from a DOMElement.
     *
     * @param \DOMElement $element The DOMElement containing the component definition.
     * @return IJDFComponent Returns the Component.
     * @throws JDFException if the DOMElement does not define a valid component descriptor.
     */
    public static function fromJDFElement(\DOMElement $element) : IJDFComponent
    {
        return new XMLDrivenPrintConfig($element->ownerDocument->saveXML($element));
    }
}
