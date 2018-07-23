<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JMFMessage class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JMF;

use RWC\Caldera\Configurations;
use RWC\Caldera\JMF\Commands\CommandFactory;
use RWC\Caldera\JMF\Commands\ICommand;
use RWC\Caldera\TimeFormatter;

/**
 * A JMFMessage represents a JMF (Job Message Format) XML document.
 *
 * A JMFMessage is used to send a command to a JMF/JDF device. The senderId
 * parameter specifies the name of the device or application sending the
 * message. The version parameter specified the supported JMF version of the
 * device. The timestamp specifies the date and time at which
 * the message was created in UNIX timestamp format (defaults to the current
 * time). The responseUrl parameter specifies a local file system URL
 * ("file:///") which will receive the result of the command when it completes.
 * The command parameter is used to specify the JMF command to execute.
 *
 * @package RWC\Caldera
 */
class JMFMessage extends AbstractJMF implements IJMFComponent
{
    /**
     * The response URL.
     *
     * @var string|null
     */
    protected $responseUrl;

    /**
     * The command to execute.
     *
     * @var ICommand
     */
    protected $command;

    /**
     * JMFMessage constructor.
     *
     * @param string $senderId The id of the sender of the message.
     * @param null|ICommand $command The command to execute.
     * @param null|string $responseUrl Response is sent here when sent over unidirectional channel.
     * @param float $version The supported JMF version.
     * @param int|null $timestamp The timestamp.
     */
    public function __construct(
        string $senderId,
        ?ICommand $command = null,
        ?string $responseUrl = null,
        ?float $version = null,
        ?int $timestamp = null
    ) {
        parent::__construct($senderId, $version, $timestamp);

        $this->setResponseUrl($responseUrl);
        $this->setCommand($command);
    }

    /**
     * Sets the response URL that will receive job status updates.
     *
     * @param null|string $responseUrl Sets the response URL that will receive job status updates.
     */
    public function setResponseUrl(?string $responseUrl = null) : void
    {
        $this->responseUrl = $responseUrl;
    }

    /**
     * Returns the response URL that will receive job status updates.
     *
     * @return null|string Returns the response URL that will receive job status updates.
     */
    public function getResponseUrl() : ?string
    {
        return $this->responseUrl;
    }

    /**
     * Sets the JMF Command to execute.
     *
     * @param null|ICommand $command The JMF command to execute.
     */
    public function setCommand(?ICommand $command) : void
    {
        $this->command = $command;
    }

    /**
     * Returns the JMF Command to execute.
     *
     * @return null|ICommand Returns the JMF Command to execute.
     */
    public function getCommand() : ?ICommand
    {
        return $this->command;
    }

    /**
     * Returns a DOMDocument containing the JMF Message.
     *
     * @return \DOMDocument Returns a DOMDocument containing the JMF.
     * @throws JMFException If an error occurs while converting to JMF.
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
     * @throws JMFException If an error occurs while converting to JMF
     */
    public function getJMFString() : string
    {
        return $this->getJMFDocument()->saveXML();
    }

    /**
     * Converts the IJMFComponent into a DOMElement for inclusion in a JMF Document.
     *
     * @param \DOMDocument $document The DOMDocument used to create the element.
     * @return \DOMElement Returns the converted element.
     * @throws JMFException If a conversion error occurs.
     */
    public function getJMF(\DOMDocument $document) : \DOMElement
    {
        $jmfElement = $document->createElementNS(Configurations::XML_JDF_NAMESPACE, 'JMF');

        // Add all required attributes.
        $jmfElement->setAttribute('version', (string) $this->getVersion());
        $jmfElement->setAttribute('SenderID', $this->getSenderId());
        $jmfElement->setAttribute('ICSVersions', Configurations::XML_ICS_VERSIONS);
        $jmfElement->setAttribute(
            'Timestamp',
            (new TimeFormatter())->format($this->getTimestamp())
        );

        if ($this->getResponseUrl() !== null) {
            $jmfElement->setAttribute('ResponseURL', $this->getResponseUrl());
        }

        if ($this->getCommand() != null) {
            $jmfElement->appendChild($this->getCommand()->getJMF($document));
        }

        return $jmfElement;
    }

    /**
     * Converts the given DOMElement into the IJMFComponent type.
     *
     * @param \DOMElement $element The DOMElement to convert.
     * @return IJMFComponent Returns the converted IJMFComponent type.
     * @throws JMFException If a conversion error occurs.
     */
    public static function fromJMF(\DOMElement $element) : IJMFComponent
    {
        $version        = (float) $element->getAttribute('version');
        $senderId       = $element->getAttribute('SenderID');
        $timestamp      = $element->getAttribute('Timestamp');
        $responseUrl    = $element->getAttribute('ResponseURL');
        $commandElement = $element->getElementsByTagName('Command');
        $command        = null;

        if ($commandElement->length > 0) {
            $command = CommandFactory::fromJMF($commandElement[0]);
        }
        return new JMFMessage(
            $senderId,
            $command,
            $responseUrl,
            $version,
            strtotime($timestamp)
        );
    }

    /**
     * @param string $jmf
     * @return JMFMessage
     * @throws JMFException
     */
    public static function fromJMFString(string $jmf) : JMFMessage
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
         * @var $jmfMessage JMFMessage
         */
        $jmfMessage = self::fromJMF($jmfElement);

        return $jmfMessage;
    }
}
