<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\ComponentLink class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\ResourceLinkPool;

/**
 * Links to a Device resource.
 *
 * @package RWC\Caldera\JDF
 */
class ComponentLink extends AbstractLink
{
    /**
     * Expected amount (number of copies) of the document to print. “Document”
     * is a set of input files with the list of pages/copies described by a
     * RunList resource. (new in V10)
     *
     * @var int|null
     */
    protected $amount;

    /**
     * Total number of document copies that was actually printed. (new in V10)
     *
     * @var int|null
     */
    protected $actualAmount;

    /**
     * ComponentLink constructor.
     *
     * @param string $usage Usage of the DeviceLink (input or output).
     * @param string $rRef Reference to the ID of the Device.
     * @param int|null $amount Expected number of copies to print.
     * @param int|null $actualAmount Actual number of copies printed.
     */
    public function __construct(string $usage, string $rRef, ?int $amount = null, ?int $actualAmount = null)
    {
        parent::__construct('ComponentLink', $usage, $rRef);
        $this->setAmount($amount);
        $this->setActualAmount($actualAmount);
    }

    /**
     *  Expected amount (number of copies) of the document to print. “Document”
     * is a set of input files with the list of pages/copies described by a
     * RunList resource. (new in V10)
     *
     * @param int|null $amount Expected number of copies to print.
     */
    public function setAmount(?int $amount = null) : void
    {
        $this->amount = $amount;
    }

    /**
     *  Expected amount (number of copies) of the document to print. “Document”
     * is a set of input files with the list of pages/copies described by a
     * RunList resource. (new in V10)
     *
     * @return int|null Expected number of copies to print.
     */
    public function getAmount() : ?int
    {
        return $this->amount;
    }

    /**
     * Total number of document copies that was actually printed. (new in V10)
     *
     * @param int|null $actualAmount Total number of document copies that was actually printed. (new in V10)
     */
    public function setActualAmount(?int $actualAmount = null) : void
    {
        $this->actualAmount = $actualAmount;
    }

    /**
     * Total number of document copies that was actually printed. (new in V10)
     *
     * @return int|null Total number of document copies that was actually printed. (new in V10)
     */
    public function getActualAmount() : ?int
    {
        return $this->actualAmount;
    }
    /**
     * Returns a DOMElement for the ComponentLink.
     *
     * @param \DOMDocument $dom The DOMDocument used to generate the Element.
     *
     * @return \DOMElement Returns the generated ComponentLink Element.
     */
    public function getJDF(\DOMDocument $dom) : \DOMElement
    {
        $element = $dom->createElement('ComponentLink');
        $element->setAttribute('Usage', $this->getUsage());
        $element->setAttribute('rRef', $this->getRRef());

        if (! is_null($this->getAmount())) {
            $element->setAttribute('Amount', (string) $this->getAmount());
        }

        if (! is_null($this->getActualAmount())) {
            $element->setAttribute('ActualAmount', (string) $this->getActualAmount());
        }

        return $element;
    }

    /**
     * Creates a new instance of the IJDFComponent from a DOMElement.
     *
     * @param \DOMElement $element The DOMElement containing the component definition.
     * @return \RWC\Caldera\IJDFComponent Returns the Component.
     */
    public static function fromJDFElement(\DOMElement $element): \RWC\Caldera\IJDFComponent
    {
        $usage = $element->getAttribute('Usage');
        $rRef = $element->getAttribute('rRef');
        $amount = $element->getAttribute('Amount');
        $actualAmount = $element->getAttribute('ActualAmount');

        $amount = empty($amount) ? null : (int) $amount;
        $actualAmount = empty($actualAmount) ? null : (int) $actualAmount;

        return new ComponentLink($usage, $rRef, $amount, $actualAmount);
    }
}
