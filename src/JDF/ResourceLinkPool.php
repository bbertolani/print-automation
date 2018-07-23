<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\ResourceLinkPool class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF;

use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\ResourceLinkPool\RunListLink;
use RWC\Caldera\JDF\ResourceLinkPool\LayoutLink;
use RWC\Caldera\JDF\ResourceLinkPool\DigitalPrintingParamsLink;
use RWC\Caldera\JDF\ResourceLinkPool\DeviceLink;
use RWC\Caldera\JDF\ResourceLinkPool\ComponentLink;
use RWC\Caldera\JDF\ResourceLinkPool\CustomerInfoLink;

/**
 * Contains links to resources within the JDF document.
 *
 * @package RWC\Caldera\JDF
 */
class ResourceLinkPool implements IJDFComponent
{
    protected $runListLink;
    protected $layoutLink;
    protected $deviceLink;
    protected $dppLink;
    protected $componentLink;
    protected $customerInfoLink;

    /**
     * ResourceLinkPool constructor.
     * @param null|RunListLink $runListLink
     * @param null|LayoutLink $layoutLink
     * @param null|DigitalPrintingParamsLink $digitalPrintingParamsLink
     * @param null|DeviceLink $deviceLink
     * @param null|ComponentLink $componentLink
     * @param null|CustomerInfoLink $customerInfoLink
     */
    public function __construct(
        ?RunListLink $runListLink = null,
        ?LayoutLink $layoutLink = null,
        ?DigitalPrintingParamsLink $digitalPrintingParamsLink = null,
        ?DeviceLink $deviceLink = null,
        ?ComponentLink $componentLink = null,
        ?CustomerInfoLink $customerInfoLink = null
    ) {
        $this->setRunListLink($runListLink);
        $this->setLayoutLink($layoutLink);
        $this->setDigitalPrintingParamsLink($digitalPrintingParamsLink);
        $this->setDeviceLink($deviceLink);
        $this->setComponentLink($componentLink);
        $this->setCustomerInfoLink($customerInfoLink);
    }

    /**
     * Link to a CustomerInfo resource.
     *
     * @param null|CustomerInfoLink $customerInfoLink Link to a CustomerInfo resource.
     */
    public function setCustomerInfoLink(?CustomerInfoLink $customerInfoLink = null) : void
    {
        $this->customerInfoLink = $customerInfoLink;
    }

    /**
     * Link to a CustomerInfo resource.
     *
     * @return null|CustomerInfoLink Link to a CustomerInfo resource.
     */
    public function getCustomerInfoLink() : ?CustomerInfoLink
    {
        return $this->customerInfoLink;
    }

    /**
     * Link to a Component resource.
     *
     * @param null|ComponentLink $componentLink Link to a Component resource.
     */
    public function setComponentLink(?ComponentLink $componentLink = null) : void
    {
        $this->componentLink = $componentLink;
    }

    /**
     * Link to a Component resource.
     *
     * @return null|ComponentLink Link to a Component resource.
     */
    public function getComponentLink() : ?ComponentLink
    {
        return $this->componentLink;
    }

    /**
     * Link to a Device resource.
     *
     * @param null|DeviceLink $deviceLink Link to a Device resource.
     */
    public function setDeviceLink(?DeviceLink $deviceLink = null) : void
    {
        $this->deviceLink = $deviceLink;
    }

    /**
     * Link to a Device resource.
     *
     * @return null|DeviceLink Link to a Device resource.
     */
    public function getDeviceLink() : ?DeviceLink
    {
        return $this->deviceLink;
    }

    /**
     * Link to a DigitalPrintingParams resource.
     *
     * @param null|DigitalPrintingParamsLink $digitalPrintingParamsLink Link to a DigitalPrintingParams resource.
     */
    public function setDigitalPrintingParamsLink(?DigitalPrintingParamsLink $digitalPrintingParamsLink = null) : void
    {
        $this->dppLink = $digitalPrintingParamsLink;
    }

    /**
     * Link to a DigitalPrintingParams resource.
     *
     * @return null|DigitalPrintingParamsLink Link to a DigitalPrintingParams resource.
     */
    public function getDigitalPrintingParamsLink() : ?DigitalPrintingParamsLink
    {
        return $this->dppLink;
    }

    /**
     * Link to a Layout resource.
     *
     * @param null|LayoutLink $layoutLink Link to a Layout resource.
     */
    public function setLayoutLink(?LayoutLink $layoutLink = null) : void
    {
        $this->layoutLink = $layoutLink;
    }

    /**
     * Link to a Layout resource.
     *
     * @return null|LayoutLink Link to a Layout resource.
     */
    public function getLayoutLink() : ?LayoutLink
    {
        return $this->layoutLink;
    }

    /**
     * Link to a RunList resource.
     *
     * @param null|RunListLink $runListLink Link to a RunList resource.
     */
    public function setRunListLink(?RunListLink $runListLink) : void
    {
        $this->runListLink = $runListLink;
    }

    /**
     * Link to a RunList resource.
     *
     * @return null|RunListLink Link to a RunList resource.
     */
    public function getRunListLink() : ?RunListLink
    {
        return $this->runListLink;
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
        // TODO: Implement getJDF() method.
        $element = $dom->createElement('ResourceLinkPool');

        if (! empty($this->getDigitalPrintingParamsLink())) {
            $element->appendChild($this->getDigitalPrintingParamsLink()->getJDF($dom));
        }

        if (! empty($this->getRunListLink())) {
            $element->appendChild($this->getRunListLink()->getJDF($dom));
        }

        if (! empty($this->getCustomerInfoLink())) {
            $element->appendChild($this->getCustomerInfoLink()->getJDF($dom));
        }

        if (! empty($this->getDeviceLink())) {
            $element->appendChild($this->getDeviceLink()->getJDF($dom));
        }

        if (! empty($this->getComponentLink())) {
            $element->appendChild($this->getComponentLink()->getJDF($dom));
        }

        return $element;
    }

    /**
     * Creates a new instance of the IJDFComponent from a DOMElement.
     *
     * @param \DOMElement $element The DOMElement containing the component definition.
     * @return IJDFComponent Returns the Component.
     */
    public static function fromJDFElement(\DOMElement $element): IJDFComponent
    {
        /**
         * <DigitalPrintingParamsLink Usage="Input" rRef="DPP001" />
        <RunListLink Usage="Input" rRef="RL001" />
        <CustomerInfoLink Usage="Input" rRef="CI001" />
        <DeviceLink Usage="Input" rRef="DEV001" />
        <ComponentLink Usage="Output" rRef="C001" Amount="4" />
         */
        $dppLinkEls = $element->getElementsByTagName('DigitalPrintingParamsLink');
        $rllEls =  $element->getElementsByTagName('RunListLink');
        $customerInfoLinkEls =  $element->getElementsByTagName('CustomerInfoLink');
        $deviceLinkEls =  $element->getElementsByTagName('DeviceLink');
        $componentLinkEls =  $element->getElementsByTagName('ComponentLink');
        $layoutLinkEls = $element->getElementsByTagName('LayoutLink');

        $dppLink = null;
        $runListLink = null;
        $customerInfoLink = null;
        $deviceLink = null;
        $componentLink = null;
        $layoutLink = null;

        if (count($rllEls) > 0) {
            $runListLink = RunListLink::fromJDFElement($rllEls[0]);
        }

        if (count($layoutLinkEls) > 0) {
            $layoutLink = LayoutLink::fromJDFElement($layoutLinkEls[0]);
        }

        if (count($dppLinkEls) > 0) {
            $dppLink = DigitalPrintingParamsLink::fromJDFElement($dppLinkEls[0]);
        }

        if (count($deviceLinkEls) > 0) {
            $deviceLink = DeviceLink::fromJDFElement($deviceLinkEls[0]);
        }

        if (count($componentLinkEls) > 0) {
            $componentLink = ComponentLink::fromJDFElement($componentLinkEls[0]);
        }

        if (count($customerInfoLinkEls) > 0) {
            $customerInfoLink = CustomerInfoLink::fromJDFElement($customerInfoLinkEls[0]);
        }

        return new ResourceLinkPool(
            $runListLink,
            $layoutLink,
            $dppLink,
            $deviceLink,
            $componentLink,
            $customerInfoLink
        );
    }
}
