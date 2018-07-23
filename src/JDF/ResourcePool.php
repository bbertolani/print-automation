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

/**
 * Container for resources.
 *
 * @package RWC\Caldera\JDFO
 */
class ResourcePool implements IJDFComponent
{
    /**
     * Ordered set of LayoutElement nodes
     *
     * @var RunList
     */
    protected $runList;

    /**
     * Resource to define RIP parameters. Currently allows to pass the Caldera
     * PrintConfig data. In the future we could support some of JDF attributes
     * (Collate...)
     *
     * @var null|DigitalPrintingParams
     */
    protected $digitalPrintingParams;

    /**
     * The device the job should print to. If not specified, the workflow must
     * specify the device.
     *
     * @var Device
     */
    protected $device;

    /**
     * ResourcePool constructor.
     *
     * @param RunList $runList Ordered set of LayoutElement nodes
     * @param DigitalPrintingParams|null $digitalPrintingParams Resource to define RIP parameters.
     * @param Device|null $device The device to print to.
     */
    public function __construct(
        RunList $runList,
        ?DigitalPrintingParams $digitalPrintingParams = null,
        ?Device $device = null
    ) {
        $this->setRunList($runList);
        $this->setDigitalPrintingParams($digitalPrintingParams);
        $this->setDevice($device);
    }

    /**
     * @param null|Device $device
     */
    public function setDevice(?Device $device = null) : void
    {
        $this->device = $device;
    }

    /**
     * @return null|Device
     */
    public function getDevice() : ?Device
    {
        return $this->device;
    }

    /**
     * Resource to define RIP parameters. Currently allows to pass the Caldera
     * PrintConfig data. In the future we could support some of JDF attributes
     * (Collate...)
     *
     * @param null|DigitalPrintingParams $digitalPrintingParams Resource to define RIP parameters.
     */
    public function setDigitalPrintingParams(?DigitalPrintingParams $digitalPrintingParams = null) : void
    {
        $this->digitalPrintingParams = $digitalPrintingParams;
    }

    /**
     * Resource to define RIP parameters. Currently allows to pass the Caldera
     * PrintConfig data. In the future we could support some of JDF attributes
     * (Collate...)
     *
     * @return null|DigitalPrintingParams Resource to define RIP parameters.
     */
    public function getDigitalPrintingParams() : ?DigitalPrintingParams
    {
        return $this->digitalPrintingParams;
    }

    /**
     * Ordered set of LayoutElement nodes. Allows to create a virtual document
     * spread over multiple files, or produce multiple documents stored in the
     * same file. Can have nested RunList elements. In that case the order is
     * defined by attribute defined in @PartIDKey of the root RunList node.
     *
     * @param RunList $runList Ordered set of LayoutElement nodes.
     */
    public function setRunList(RunList $runList) : void
    {
        $this->runList = $runList;
    }

    /**
     * Ordered set of LayoutElement nodes. Allows to create a virtual document
     * spread over multiple files, or produce multiple documents stored in the
     * same file. Can have nested RunList elements. In that case the order is
     * defined by attribute defined in @PartIDKey of the root RunList node.
     *
     * @return RunList Ordered set of LayoutElement nodes.
     */
    public function getRunList() : RunList
    {
        return $this->runList;
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
        $element = $dom->createElement('ResourcePool');

        $element->appendChild($this->getRunList()->getJDF($dom));

        if (! empty($this->getDigitalPrintingParams())) {
            $element->appendChild($this->getDigitalPrintingParams()->getJDF($dom));
        }

        if (! empty($this->getDevice())) {
            $element->appendChild($this->getDevice()->getJDF($dom));
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
    public static function fromJDFElement(\DOMElement $element): IJDFComponent
    {
        // Look at direct descendants for RunList
        $runListEl = null;
        foreach ($element->childNodes as $node) {
            if ($node->nodeName == 'RunList') {
                $runListEl = $node;
                break;
            }
        }

        // Make sure RunList was found.
        if ($runListEl == null) {
            throw new JDFException('Required ResourcePool sub-element RunList was not found.');
        }

        $runList = RunList::fromJDFElement($runListEl);

        if (! $runList instanceof RunList) {
            throw new JDFException('RunList::fromJDFElement() did not return a RunList.');
        }

        $dppEl = null;
        $digitalPrintingParams   = null;

        foreach ($element->childNodes as $node) {
            if ($node->nodeName == 'DigitalPrintingParams') {
                $dppEl = $node;
                break;
            }
        }

        if (! is_null($dppEl)) {
            $digitalPrintingParams = DigitalPrintingParams::fromJDFElement($dppEl);

            if (! $digitalPrintingParams instanceof DigitalPrintingParams) {
                throw new JDFException(
                    'DigitalPrintingParams::fromJDFElement() did not ' .
                    'return a DigitalPrintingParams'
                );
            }
        }

        $deviceEl = $element->getElementsByTagName('Device');
        $device = null;

        if (count($deviceEl) > 0) {
            $device = Device::fromJDFElement($deviceEl[0]);
        }

        return new ResourcePool(
            $runList,
            $digitalPrintingParams,
            $device
        );
    }
}
