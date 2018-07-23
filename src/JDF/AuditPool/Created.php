<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\AuditPool\Created class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\AuditPool;

use RWC\Caldera\JDF\JDFException;
use RWC\Caldera\IJDFComponent;

/**
 * This node should be written when the JDF is created. The node has no
 * additional attributes.
 *
 * @package RWC\Caldera\JDF\AuditPool
 */
class Created extends AbstractAuditPoolElement
{
    /**
     * Generates a DOMElement representing the Created component.
     *
     * @param \DOMDocument $dom The DOMDocument use to generate the element.
     *
     * @return \DOMElement Returns the generated DOMElement for the component.
     */
    public function getJDF(\DOMDocument $dom): \DOMElement
    {
        $element = $dom->createElement('Created');

        // Add required attributes.
        $this->decorateElement($element);

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

        if (empty($timestampAtt)) {
            throw new JDFException('Required Created elements attribute "TimeStamp" was not found.');
        }

        $timestamp    = strtotime($timestampAtt);
        $agentName    = empty($agentNameAtt) ? null : $agentNameAtt;
        $agentVersion = empty($agentVersionAtt) ? null : $agentVersionAtt;

        return new Created(
            $timestamp,
            $agentName,
            $agentVersion
        );
    }
}
