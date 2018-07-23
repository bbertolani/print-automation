<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\RunListLink class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\ResourceLinkPool;

/**
 * Links to a RunList resource.
 *
 * @package RWC\Caldera\JDF
 */
class RunListLink extends AbstractLink
{
    /**
     * Creates a new RunListLink.
     *
     * @param string $usage Usage of the RunLink (input or output).
     * @param string $rRef Reference to the ID of the RunLink.
     */
    public function __construct(string $usage, string $rRef)
    {
        parent::__construct('RunListLink', $usage, $rRef);
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
        $element = $dom->createElement('RunListLink');
        $element->setAttribute('Usage', $this->getUsage());
        $element->setAttribute('rRef', $this->getRRef());

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

        return new RunListLink($usage, $rRef);
    }
}
