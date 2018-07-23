<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\AuditPool\AbstractAuditPoolElement class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\AuditPool;

use RWC\Caldera\IJDFComponent;
use RWC\Caldera\TimeFormatter;

/**
 * Base class for AuditPool elements.
 *
 * @package RWC\Caldera\JDF\AuditPool
 */
abstract class AbstractAuditPoolElement implements IJDFComponent
{
    /**
     * The agent/product name (optional).
     *
     * @var string|null
     */
    protected $agentName;

    /**
     * The agent/product version (optional).
     *
     * @var string|null
     */
    protected $agentVersion;

    /**
     * The time the event occurred as a UNIX Epoch timestamp.
     *
     * @var int
     */
    protected $timestamp;

    /**
     * AbstractAuditPoolElement constructor.
     *
     * @param int $timestamp The timestamp when the element was created.
     * @param null|string $agentName The name of the agent that created the JDF.
     * @param null|string $agentVersion The version of the agent that created the JDF.
     */
    public function __construct(
        int $timestamp,
        ?string $agentName = null,
        ?string $agentVersion = null
    ) {
        $this->setTimestamp($timestamp);
        $this->setAgentName($agentName);
        $this->setAgentVersion($agentVersion);
    }

    /**
     * Sets the product/agent name (optional).
     *
     * @param null|string $agentName The product/agent name (optional).
     */
    public function setAgentName(?string $agentName) : void
    {
        $this->agentName = $agentName;
    }

    /**
     * Returns the product/agent name (optional).
     *
     * @return null|string Returns the product/agent name (optional).
     */
    public function getAgentName() : ?string
    {
        return $this->agentName;
    }

    /**
     * Sets the product version (optional).
     *
     * @param null|string $agentVersion The product version  (optional).
     */
    public function setAgentVersion(?string $agentVersion = null)
    {
        $this->agentVersion = $agentVersion;
    }

    /**
     * Returns the product version (optional).
     *
     * @return null|string Returns the production version (optional).
     */
    public function getAgentVersion() : ?string
    {
        return $this->agentVersion;
    }/** @noinspection SpellCheckingInspection */


    /**
     * Sets the time of event or element creation.
     *
     * Timestamp is specified as a UNIX Epoch timestamp, but will output in XML
     * in ISO8601:2004 "YYYY-MM-DD T HH:MM:SS Z".
     *
     * @param int $timestamp The time of event or element creation.
     */
    public function setTimestamp(int $timestamp) : void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * Returns the time of the event or element creation.
     *
     * @return int Time of event or element creation.
     */
    public function getTimestamp() : int
    {
        return $this->timestamp;
    }

    /**
     * Generates a DOMElement representing the JDFComponent.
     *
     * @param \DOMDocument $dom The DOMDocument use to generate the element.
     *
     * @return \DOMElement Returns the generated DOMElement for the component.
     */
    abstract public function getJDF(\DOMDocument $dom): \DOMElement;

    /**
     * Decorates the specified DOMElement with attributes for the AuditPool
     * element.
     *
     * @param \DOMElement $element The element to decorate with AuditPool attributes.
     * @return void
     */
    protected function decorateElement(\DOMElement $element) : void
    {
        if (! empty($this->getAgentName())) {
            $element->setAttribute('AgentName', $this->getAgentName());
        }

        if (! empty($this->getAgentVersion())) {
            $element->setAttribute('AgentVersion', $this->getAgentVersion());
        }

        $element->setAttribute('TimeStamp', (new TimeFormatter())->format($this->getTimestamp()));
    }
}
