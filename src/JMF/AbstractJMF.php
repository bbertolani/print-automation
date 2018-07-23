<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JMF\AbstractJMF class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JMF;

use RWC\Caldera\Configurations;

/**
 * Class AbstractJMF
 * @package RWC\Caldera\JMF
 */
abstract class AbstractJMF implements IJMFComponent
{
    /**
     * The SenderID.
     *
     * @var string
     */
    protected $senderId;

    /**
     * The supported JMF version.
     *
     * @var float
     */
    protected $version;

    /**
     * The timestamp.
     *
     * @var int
     */
    protected $timestamp;

    /**
     * AbstractJMF constructor.
     * @param string $senderId
     * @param float|null $version
     * @param int|null $timestamp
     */
    public function __construct(
        string $senderId,
        ?float $version = null,
        ?int $timestamp = null
    ) {
        // default to now.
        $timestamp = $timestamp ?? time();

        $this->setSenderId($senderId);
        $this->setVersion($version);
        $this->setTimestamp($timestamp);
    }

    /**
     * Sets the sender id.
     *
     * @param string $senderId The sender id.
     */
    public function setSenderId(string $senderId) : void
    {
        $this->senderId = $senderId;
    }

    /**
     * Returns the sender id.
     *
     * @return string Returns the sender id.
     */
    public function getSenderId() : string
    {
        return $this->senderId;
    }

    /**
     * Sets the supported JMF version.
     *
     * @param float $version The supported JMF version.
     */
    public function setVersion(?float $version = null) : void
    {
        $version = $version ?? Configurations::DEFAULT_JDF_VERSION;

        $this->version = $version;
    }

    /**
     * Returns the JMF version.
     *
     * @return float Returns the supported JMF version.
     */
    public function getVersion() : float
    {
        return $this->version;
    }

    /**
     * Sets the timestamp.
     *
     * @param int $timestamp The timestamp.
     */
    public function setTimestamp(int $timestamp) : void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * Returns the timestamp.
     *
     * @return int Returns the timestamp.
     */
    public function getTimestamp() : int
    {
        return $this->timestamp;
    }

    /**
     * Converts the IJMFComponent into a DOMElement for inclusion in a JMF Document.
     *
     * @param \DOMDocument $document The DOMDocument used to create the element.
     * @return \DOMElement Returns the converted element.
     */
    abstract public function getJMF(\DOMDocument $document) : \DOMElement;

    /**
     * Converts the given DOMElement into the IJMFComponent type.
     *
     * @param \DOMElement $element The DOMElement to convert.
     * @return IJMFComponent Returns the converted IJMFComponent type.
     * @throws JMFException If a conversion error occurs.
     */
    abstract public static function fromJMF(\DOMElement $element) : IJMFComponent;
}
