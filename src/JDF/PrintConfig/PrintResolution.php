<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\PrintGab\PrintResolution class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF\PrintConfig;

use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;

/**
 * Printer resolution.
 *
 * @package RWC\Caldera\JDF\PrintConfig
 */
class PrintResolution extends IndexableValue
{
    /**
     * The internal resolution.
     *
     * @var int|null
     */
    protected $internalResolution;

    /**
     * PrintResolution constructor.
     *
     * @param string $value The printer resolution.
     * @param int|null $index The resolution index (optional).
     * @param int|null $internalResolution The Internal resolution (optional).
     */
    public function __construct(
        string $value,
        ?int $index = null,
        ?int $internalResolution = null
    ) {
        parent::__construct('res_id', $value, $index);
        $this->setInternalResolution($internalResolution);
    }

    /**
     * Internal resolution value (optional).
     *
     * @param int|null $internalResolution Internal resolution value (optional).
     */
    public function setInternalResolution(?int $internalResolution = null) : void
    {
        $this->internalResolution = $internalResolution;
    }

    /**
     * Internal resolution value (optional).
     *
     * @return int|null Internal resolution value (optional).
     */
    public function getInternalResolution() : ?int
    {
        return $this->internalResolution;
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
        $element = parent::getJDF($dom);

        if (! empty($this->getInternalResolution())) {
            $element->setAttribute('res', (string) $this->getInternalResolution());
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
        $index   = (int) $element->getAttribute('idx');
        $value   = $element->nodeValue;
        $internalResolution = (int) $element->getAttribute('res');

        $index = empty($index) ? null : $index;
        $internalResolution = empty($internalResolution) ? null : $internalResolution;

        if (empty($value)) {
            throw new JDFException('No node value specified');
        }

        return new self($value, $index, $internalResolution);
    }
}
