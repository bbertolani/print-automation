<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\CutFile class.
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
 * Class CutFile
 * @package RWC\Caldera\JDF\PrintConfig
 */
class CutFile extends AbstractJDFComponent implements IJDFComponent
{
    protected $encoding;
    protected $data;

    /**
     * CutFile constructor.
     * @param string $encoding
     * @param string $data
     */
    public function __construct(string $encoding, string $data)
    {
        $this->setEncoding($encoding);
        $this->setData($data);
    }

    /**
     * @param string $encoding
     */
    public function setEncoding(string $encoding) : void
    {
        $this->encoding = $encoding;
    }

    /**
     * @return string
     */
    public function getEncoding() : string
    {
        return $this->encoding;
    }

    /**
     * @param string $data
     */
    public function setData(string $data) : void
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getData() : string
    {
        return $this->data;
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
        $element = $dom->createElement('cutfile');
        $element->setAttribute('encoding', $this->getEncoding());
        $element->appendChild($dom->createTextNode($this->getData()));

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
        $encoding = $element->getAttribute('encoding');

        if (is_null($encoding) || $encoding === '') {
            throw new JDFException('Required attribute "encoding" is not set.');
        }

        $data = $element->textContent;

        return new self($encoding, $data);
    }
}
