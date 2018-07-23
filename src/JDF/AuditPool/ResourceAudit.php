<?php
declare(strict_types=1);

/**
 * This file contains the namespace RWC\Caldera\JDF\AuditPool\ResourceAudit class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\AuditPool;

use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;
use RWC\Caldera\JDF\ResourceLinkPool\RunListLink;

/**
 * Class ResourceAudit
 * @package RWC\Caldera\JDF\AuditPool
 */
class ResourceAudit extends AbstractAuditPoolElement
{
    /**
     * The RunListLink.
     *
     * @var RunListLink
     */
    protected $runListLink;


    /**
     * ResourceAudit constructor.
     *
     * @param RunListLink $runListLink The RunListLink.
     * @param int $timestamp The timestamp when the ResourceAudit was created.
     * @param null|string $agentName The name of the Agent that created the JDF.
     * @param null|string $agentVersion The version of the Agent that created the JDF.
     */
    public function __construct(
        RunListLink $runListLink,
        int $timestamp,
        ?string $agentName = null,
        ?string $agentVersion = null
    ) {
        parent::__construct($timestamp, $agentName, $agentVersion);
        $this->setRunListLink($runListLink);
    }

    /**
     * Sets the RunListLink.
     *
     * @param RunListLink $runListLink The RunListLink
     */
    public function setRunListLink(RunListLink $runListLink) : void
    {
        $this->runListLink = $runListLink;
    }

    /**
     * Returns the RunListLink.
     *
     * @return RunListLink Returns the RunListLink.
     */
    public function getRunListLink() : RunListLink
    {
        return $this->runListLink;
    }

    /**
     * Generates the ResourceAudit element.
     *
     * The ResourceAudit provides all of the default parameters inherited from
     * AbstractAuditPoolElement including Timestamp, AgentName, and AgentVersion.
     * It also provides the RunListLink element.
     *
     * @param \DOMDocument $dom The DOMDocument use to generate the element.
     *
     * @return \DOMElement Returns the generated DOMElement for the component.
     */
    public function getJDF(\DOMDocument $dom): \DOMElement
    {
        $element = $dom->createElement('ResourceAudit');

        // Add required attributes.
        $this->decorateElement($element);

        $element->appendChild($this->getRunListLink()->getJDF($dom));

        return $element;
    }

    /**
     * Creates a new instance of the IJDFComponent from a DOMElement.
     *
     * @param \DOMElement $element The DOMElement containing the component definition.
     * @return IJDFComponent Returns the Component.
     * @throws JDFException if the DOMElement does not define a valid component descriptor.
     */
    public static function fromJDFElement(\DOMElement $element) : IJDFComponent
    {
        $timestampAtt    = $element->getAttribute('TimeStamp');
        $agentNameAtt    = $element->getAttribute('AgentName');
        $agentVersionAtt = $element->getAttribute('AgentVersion');
        $runListLinkEl   = $element->getElementsByTagName('RunListLink');

        if (empty($runListLinkEl)) {
            throw new JDFException('Required ResourceAudit sub-element RunListLink not found.');
        }

        if (empty($timestampAtt)) {
            throw new JDFException('Required Created elements attribute "TimeStamp" was not found.');
        }

        $timestamp    = strtotime($timestampAtt);
        $agentName    = empty($agentNameAtt) ? null : $agentNameAtt;
        $agentVersion = empty($agentVersionAtt) ? null : $agentVersionAtt;

        /** @var $runListLink RunListLink */
        $runListLink  = RunListLink::fromJDFElement($runListLinkEl[0]);

        return new ResourceAudit(
            $runListLink,
            $timestamp,
            $agentName,
            $agentVersion
        );
    }
}
