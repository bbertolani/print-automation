<?php
declare(strict_types=1);

/**
 * This file contains the PF\PrintJob\JDF class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF;

use RWC\Caldera\AbstractJDFComponent;
use RWC\Caldera\IJDFComponent;

/**
 * Class Device
 * @package RWC\Caldera\JDF
 */
class Device extends AbstractJDFComponent implements IJDFComponent
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var string
     */
    protected $resourceId;

    /**
     * @var string
     */
    protected $deviceId;

    /**
     * @var string
     */
    protected $status;

    /**
     * Device constructor.
     * @param string $class
     * @param string $resourceId
     * @param string $deviceId
     * @param string $status
     */
    public function __construct(
        string $class,
        string $resourceId,
        string $deviceId,
        string $status
    ) {
        $this->setClass($class);
        $this->setId($resourceId);
        $this->setDeviceId($deviceId);
        $this->setStatus($status);
    }

    /**
     * @param string $class
     */
    public function setClass(string $class) : void
    {
        $this->class = $class;
    }

    /**
     * @return string
     */
    public function getClass() : string
    {
        return $this->class;
    }

    /**
     * @param string $resourceId
     */
    public function setId(string $resourceId) : void
    {
        $this->resourceId = $resourceId;
    }

    /**
     * @return string
     */
    public function getId() : string
    {
        return $this->resourceId;
    }

    /**
     * @param string $deviceId
     */
    public function setDeviceId(string $deviceId) : void
    {
        $this->deviceId = $deviceId;
    }

    /**
     * @return string
     */
    public function getDeviceId() : string
    {
        return $this->deviceId;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status) : void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus() : string
    {
        return $this->status;
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
        $element = $dom->createElement('Device');
        $element->setAttribute('Class', $this->getClass());
        $element->setAttribute('ID', $this->getId());
        $element->setAttribute('DeviceID', $this->getDeviceId());
        $element->setAttribute('Status', $this->getStatus());

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
        $class = $element->getAttribute('Class');
        $resourceId = $element->getAttribute('ID');
        $deviceId = $element->getAttribute('DeviceID');
        $status = $element->getAttribute('Status');

        if (empty($class)) {
            throw new JDFException('Required attribute "Class" is missing.');
        }

        if (empty($resourceId)) {
            throw new JDFException('Required attribute "ID" is missing.');
        }

        if (empty($deviceId)) {
            throw new JDFException('Required attribute "DeviceID" is missing.');
        }

        if (empty($status)) {
            throw new JDFException('Required attribute "Status" is missing.');
        }

        return new Device($class, $resourceId, $deviceId, $status);
    }
}
