<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\Commands\Device class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JMF\Commands;

use RWC\Caldera\JMF\IJMFComponent;
use RWC\Caldera\JMF\JMFException;

/**
 * A Device which can be included as a filter in a QueueFilter.
 *
 * @package RWC\Caldera\JMF\Commands
 */
class Device implements IJMFComponent
{
    /**
     * Limit to device id.
     *
     * @var string|null
     */
    protected $deviceId;

    /**
     * Limit to device model.
     *
     * @var string|null
     */
    protected $modelName;

    /**
     * Returns the device id filter.
     *
     * @return null|string Returns the device id filter.
     */
    public function getDeviceId(): ?string
    {
        return $this->deviceId;
    }

    /**
     * Sets the device id filter.
     *
     * @param null|string $deviceId The device id filter.
     */
    public function setDeviceId(?string $deviceId): void
    {
        $this->deviceId = $deviceId;
    }

    /**
     * Returns the device model filter.
     *
     * @return null|string Returns the device model filter.
     */
    public function getModelName(): ?string
    {
        return $this->modelName;
    }

    /**
     * Sets the device model filter.
     *
     * @param null|string $modelName The device model filter.
     */
    public function setModelName(?string $modelName): void
    {
        $this->modelName = $modelName;
    }

    /**
     * Device constructor.
     *
     * @param null|string $deviceId The device id filter.
     * @param null|string $modelName The model name filter.
     */
    public function __construct(
        ?string $deviceId = null,
        ?string $modelName = null
    ) {
        $this->setDeviceId($deviceId);
        $this->setModelName($modelName);
    }
    /**
     * Returns a DOMElement containing the JMF for the QueueSubmissionParams.
     *
     * @param \DOMDocument $domDocument The DOMDocument used to generate the element.
     *
     * @return \DOMElement Returns the generated element.
     */
    public function getJmf(\DOMDocument $domDocument) : \DOMElement
    {
        $command = $domDocument->createElement('Device');

        if (! empty($this->getDeviceId())) {
            $command->setAttribute('DeviceID', $this->getDeviceId());
        }

        if (! empty($this->getModelName())) {
            $command->setAttribute('ModelName', $this->getModelName());
        }

        return $command;
    }

    /**
     * Converts the given DOMElement into the IJMFComponent type.
     *
     * @param \DOMElement $element The DOMElement to convert.
     * @return IJMFComponent Returns the converted IJMFComponent type.
     * @throws JMFException If a conversion error occurs.
     */
    public static function fromJMF(\DOMElement $element): IJMFComponent
    {
        if (! $element->tagName == 'Device') {
            throw new JMFException(
                'Not a Device element'
            );
        }

        $deviceId = $element->hasAttribute('DeviceID') ? $element->getAttribute('DeviceID') : null;
        $modelName = $element->hasAttribute('ModelName') ? $element->getAttribute('ModelName') : null;

        return new Device($deviceId, $modelName);
    }
}
