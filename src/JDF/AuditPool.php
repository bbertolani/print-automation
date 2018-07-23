<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\AuditPool class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF;

use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\AuditPool\Created;
use RWC\Caldera\JDF\AuditPool\ProcessRun;
use RWC\Caldera\JDF\AuditPool\ResourceAudit;

/**
 * Class AuditPool
 * @package RWC\Caldera\JDF
 */
class AuditPool implements IJDFComponent
{
    /**
     * This node should be written when the JDF is created. The node has no
     * additional attributes.
     *
     * @var Created
     */
    protected $created;

    /**
     * Information about printing and errors for individual input files. This
     * is a link between JDF and a Caldera job. The behavior of the node is
     * specific to Caldera if <cal:Status> is present. There is always only one
     * occurrence of ResourceAudit with unique @FileSpecURL, server_name and
     * job_id values. If the cal:Status node does not contain job_id node, the
     * status (probably an error) is relative to an event that occurred before
     * printing (opening the file, …)
     *
     * @var null|ResourceAudit
     */
    protected $resourceAudit;

    /**
     * Information about running the process. This element log the end of a
     * process run. Any subsequent elements belong to the next run.
     *
     * @var null|ProcessRun
     */
    protected $processRun;

    /**
     * AuditPool constructor.
     * @param Created $created
     * @param null|ResourceAudit $resourceAudit
     * @param null|ProcessRun $processRun
     */
    public function __construct(
        Created $created,
        ?ResourceAudit $resourceAudit = null,
        ?ProcessRun $processRun = null
    ) {
        $this->setCreated($created);
        $this->setResourceAudit($resourceAudit);
        $this->setProcessRun($processRun);
    }

    /**
     * Information about running the process. This element log the end of a
     * process run. Any subsequent elements belong to the next run.
     *
     * @param null|ProcessRun $processRun Information about running the process.
     */
    public function setProcessRun(?ProcessRun $processRun = null) : void
    {
        $this->processRun = $processRun;
    }

    /**
     * Information about running the process. This element log the end of a
     * process run. Any subsequent elements belong to the next run.
     *
     * @return null|ProcessRun Information about running the process.
     */
    public function getProcessRun() : ?ProcessRun
    {
        return $this->processRun;
    }
    /**
     * Information about printing and errors for individual input files. This
     * is a link between JDF and a Caldera job. The behavior of the node is
     * specific to Caldera if <cal:Status> is present. There is always only one
     * occurrence of ResourceAudit with unique @FileSpecURL, server_name and
     * job_id values. If the cal:Status node does not contain job_id node, the
     * status (probably an error) is relative to an event that occurred before
     * printing (opening the file, …)
     *
     * @param null|ResourceAudit $resourceAudit Information about printing and errors for individual input files
     */
    public function setResourceAudit(?ResourceAudit $resourceAudit = null) : void
    {
        $this->resourceAudit = $resourceAudit;
    }

    /**
     * Information about printing and errors for individual input files. This
     * is a link between JDF and a Caldera job. The behavior of the node is
     * specific to Caldera if <cal:Status> is present. There is always only one
     * occurrence of ResourceAudit with unique @FileSpecURL, server_name and
     * job_id values. If the cal:Status node does not contain job_id node, the
     * status (probably an error) is relative to an event that occurred before
     * printing (opening the file, …)
     *
     * @return null|ResourceAudit  Information about printing and errors for individual input files.
     */
    public function getResourceAudit() : ?ResourceAudit
    {
        return $this->resourceAudit;
    }

    /**
     * This node should be written when the JDF is created. The node has no
     * additional attributes.
     *
     * @param Created $created  This node should be written when the JDF is created.
     */
    public function setCreated(Created $created = null) : void
    {
        $this->created = $created;
    }

    /**
     * This node should be written when the JDF is created. The node has no
     * additional attributes.
     *
     * @return Created  This node should be written when the JDF is created.
     */
    public function getCreated() : Created
    {
        return $this->created;
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
        $element = $dom->createElement('AuditPool');

        $element->appendChild($this->getCreated()->getJDF($dom));

        if (! empty($this->getResourceAudit())) {
            $element->appendChild($this->getResourceAudit()->getJDF($dom));
        }

        if (! empty($this->getProcessRun())) {
            $element->appendChild($this->getProcessRun()->getJDF($dom));
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
    public static function fromJDFElement(\DOMElement $element) : IJDFComponent
    {
        $createdEl       = $element->getElementsByTagName('Created');
        $resourceAuditEl = $element->getElementsByTagName('ResourceAudit');
        $processRunEl    = $element->getElementsByTagName('ProcessRun');

        if (count($createdEl) == 0) {
            throw new JDFException("Required AuditPool element " .
                "Created not found.");
        }

        $created      = Created::fromJDFElement($createdEl[0]);
        $resourceAudit = null;
        $processRun   = null;

        if (count($resourceAuditEl) > 0) {
            $resourceAudit = ResourceAudit::fromJDFElement($resourceAuditEl[0]);
        }

        if (count($processRunEl) > 0) {
            $processRun = ProcessRun::fromJDFElement($processRunEl[0]);
        }

        return new AuditPool(
            $created,
            $resourceAudit,
            $processRun
        );
    }
}
