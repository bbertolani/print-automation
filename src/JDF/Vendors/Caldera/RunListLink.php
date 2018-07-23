<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\RunListLink class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\Vendors\Caldera;

use RWC\Caldera\Configurations;
use RWC\Caldera\JDF\ResourceLinkPool\RunListLink as BaseRunListLink;
use RWC\Caldera\Status;

/**
 * The link to a RunList resource (see the ResourceLinkPool for details).
 *
 * @package RWC\Caldera\JDF\Vendors\Caldera
 */
class RunListLink extends BaseRunListLink
{
    /**
     * Details status information returned from Caldera.
     *
     * @var Status
     */
    protected $status;

    /**
     * Creates a new RunListLink.
     *
     * @param string $usage Usage of the RunLink (input or output).
     * @param string $rRef Reference to the ID of the RunLink.
     * @param null|Status $status The Caldera job status.
     */
    public function __construct(string $usage, string $rRef, ?Status $status = null)
    {
        parent::__construct($usage, $rRef);
        $this->setStatus($status);
    }

    /**
     * Sets the Caldera Status block.
     *
     * @param Status|null $status The Caldera Status block.
     */
    public function setStatus(?Status $status) : void
    {
        $this->status = $status;
    }

    /**
     * @return Status Returns the Caldera Status block.
     */
    public function getStatus() : ?Status
    {
        return $this->status;
    }

    /**
     * Returns a DOMElement for the RunListLink.
     *
     * @param \DOMDocument $dom The DOMDocument used to generate the Element.
     *
     * @return \DOMElement Returns the generated RunListLink Element.
     */
    public function getJDF(\DOMDocument $dom) : \DOMElement
    {
        $element = parent::getJDF($dom);

        if ($this->getStatus() != null) {
            $element->appendChild($this->getStatus()->getJDF($dom));
        }

        return $element;
    }/** @noinspection PhpMissingParentCallCommonInspection */

    /**
     * Creates a new instance of the IJDFComponent from a DOMElement.
     *
     * @param \DOMElement $element The DOMElement containing the component definition.
     * @return \RWC\Caldera\IJDFComponent Returns the Component.
     * @throws \RWC\Caldera\JDF\JDFException If element generation cannot be completed.
     */
    public static function fromJDFElement(\DOMElement $element): \RWC\Caldera\IJDFComponent
    {
        $usage = $element->getAttribute('Usage');
        $rRef = $element->getAttribute('rRef');

        $statusEl = $element->getElementsByTagNameNS(
            Configurations::XML_CALDERA_NAMESPACE,
            'Status'
        );

        /** @var $status Status */
        $status = null;

        if (count($statusEl) > 0) {
            $status = Status::fromJDFElement($statusEl[0]);
        }
        return new self($usage, $rRef, $status);
    }
}
