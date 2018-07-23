<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JMF\JMFResponse class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JMF;

use RWC\Caldera\Configurations;
use RWC\Caldera\TimeFormatter;

/**
 * Class JMFResponse
 * @package RWC\Caldera\JMF
 */
class JMFResponse extends AbstractJMF implements IJMFComponent
{
    protected $response;

    /**
     * JMFResponse constructor.
     * @param string $senderId
     * @param Response $response
     * @param float|null $version
     * @param int|null $timestamp
     */
    public function __construct(
        string $senderId,
        Response $response,
        ?float $version = null,
        ?int $timestamp = null
    ) {
        parent::__construct($senderId, $version, $timestamp);
        $this->setResponse($response);
    }

    /**
     * @param Response $response
     */
    public function setResponse(Response $response) : void
    {
        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function getResponse() : Response
    {
        return $this->response;
    }

    /**
     * Converts the IJMFComponent into a DOMElement for inclusion in a JMF Document.
     *
     * @param \DOMDocument $document The DOMDocument used to create the element.
     * @return \DOMElement Returns the converted element.
     */
    public function getJMF(\DOMDocument $document): \DOMElement
    {
        $jmfElement = $document->createElement('JMF');

        // Add all required attributes.
        $jmfElement->setAttribute('version', (string) $this->getVersion());
        $jmfElement->setAttribute('SenderID', $this->getSenderId());
        $jmfElement->setAttribute('ICSVersions', Configurations::XML_ICS_VERSIONS);
        $jmfElement->setAttribute(
            'Timestamp',
            (new TimeFormatter())->format($this->getTimestamp())
        );

        $jmfElement->appendChild($this->getResponse()->getJMF($document));

        return $jmfElement;
    }

    /**
     * Converts the given DOMElement into the IJMFComponent type.
     *
     * @param \DOMElement $element The DOMElement to convert.
     * @return IJMFComponent Returns the converted IJMFComponent type.
     * @throws JMFException If a conversion error occurs.
     */
    public static function fromJMF(\DOMElement $element): IJMFComponent
    {
        if ($element->nodeName != 'JMF') {
            throw new JMFException('Element is not a JMF element.');
        }

        $responseEl = $element->getElementsByTagName('Response');

        if ($responseEl->length == 0) {
            throw new JMFException('Required element Response not found.');
        }

        /**
         * @var $responseEl \DOMElement
         */
        $responseEl     = $responseEl[0];
        $version        = (float) $element->getAttribute('Version');
        $senderId       = $element->getAttribute('SenderID');
        $timestamp      = $element->getAttribute('TimeStamp');

        if (empty($version)) {
            throw new JMFException('Required attribute "version" not found.');
        }

        if (empty($senderId)) {
            throw new JMFException('Required attribute "SenderID" not found.');
        }

        if (empty($timestamp)) {
            throw new JMFException('Required attribute "Timestamp" not found.');
        }

        /**
         * @var $response Response
         */
        $response = Response::fromJMF($responseEl);


        return new JMFResponse($senderId, $response, $version, (int) $timestamp);
    }

    /**
     * Returns the string version of the JMF Response.
     *
     * @param string $jmf
     * @return JMFResponse
     * @throws JMFException
     */
    public static function fromJMFString(string $jmf) : JMFResponse
    {
        $domDocument = new \DOMDocument();
        if (false === $domDocument->loadXML($jmf)) {
            throw new JMFException("Document was not valid XML.");
        }

        /**
         * @var $jmfElement \DOMElement
         */
        $jmfElement = $domDocument->firstChild;

        if ($jmfElement->nodeName != 'JMF') {
            throw new JMFException('Document root was not JMF.');
        }

        /**
         * @var $jmfMessage JMFResponse
         */
        $jmfMessage = self::fromJMF($jmfElement);

        return $jmfMessage;
    }

    /**
     * Returns a DOMDocument containing the JMF Message.
     *
     * @return \DOMDocument Returns a DOMDocument containing the JMF.
     */
    public function getJMFDocument() : \DOMDocument
    {
        $domDocument = new \DOMDocument();
        $domDocument->appendChild($this->getJMF($domDocument));
        return $domDocument;
    }

    /**
     * Returns an XML string for the JMF message.
     *
     * @return string Returns an XML string for the JMF message.
     */
    public function getJMFString() : string
    {
        return $this->getJMFDocument()->saveXML();
    }
}
