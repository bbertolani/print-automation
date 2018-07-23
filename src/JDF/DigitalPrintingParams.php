<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\DigitalPrintingParams class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF;

use RWC\Caldera\IJDFComponent;

/**
 * DigitalPrintingParams is a resource to define RIP parameters. Currently
 * allows to pass the Caldera PrintConfig data. In the future we could support
 * some of JDF's attributes (Collate...)
 *
 * @package RWC\Caldera\JDF
 */
class DigitalPrintingParams implements IJDFComponent
{
    protected $class;
    protected $dppId;
    protected $status;
    protected $printConfig;

    /**
     * DigitalPrintingParams constructor.
     *
     * @param string $class "Parameter"
     * @param string $dppId Unique id
     * @param string $status "Available"
     * @param null|PrintConfig $printConfig Caldera specific PrintConfig node.
     */
    public function __construct(
        string $class,
        string $dppId,
        string $status,
        ?PrintConfig $printConfig
    ) {
        $this->setClass($class);
        $this->setId($dppId);
        $this->setStatus($status);
        $this->setPrintConfig($printConfig);
    }

    /**
     * "Parameter"
     *
     * @param string $class "Parameter"
     */
    public function setClass(string $class) : void
    {
        $this->class = $class;
    }

    /**
     * "Parameter"
     *
     * @return string "Parameter"
     */
    public function getClass() : string
    {
        return $this->class;
    }

    /**
     * Unique ID.
     *
     * @param string $dppId Unique ID.
     */
    public function setId(string $dppId) : void
    {
        $this->dppId = $dppId;
    }

    /**
     * Unique ID.
     *
     * @return string Unique ID.
     */
    public function getId() : string
    {
        return $this->dppId;
    }

    /**
     * "Available"
     *
     * @param string $status "Available"
     */
    public function setStatus(string $status) : void
    {
        $this->status = $status;
    }

    /**
     * "Available"
     *
     * @return string "Available"
     */
    public function getStatus() : string
    {
        return $this->status;
    }

    /**
     * Caldera specific PrintConfig node.
     *
     * @param null|PrintConfig $printConfig Caldera specific PrintConfig node.
     */
    public function setPrintConfig(?PrintConfig $printConfig) : void
    {
        $this->printConfig = $printConfig;
    }

    /**
     * Caldera specific PrintConfig node.
     *
     * @return null|PrintConfig Caldera specific PrintConfig node.
     */
    public function getPrintConfig() : ?PrintConfig
    {
        return $this->printConfig;
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
        $element = $dom->createElement('DigitalPrintingParams');

        $element->setAttribute('Class', $this->getClass());
        $element->setAttribute('ID', $this->getId());
        $element->setAttribute('Status', $this->getStatus());

        if (! empty($this->getPrintConfig())) {
            $element->appendChild($this->getPrintConfig()->getJDF($dom));
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
        $classAtt = $element->getAttribute('Class');
        $idAtt = $element->getAttribute('ID');
        $statusAtt = $element->getAttribute('Status');
        $printConfigEl = $element->getElementsByTagName('PrintConfig');
        $printConfig = null;

        if (empty($classAtt)) {
            throw new JDFException('Required attribute "Class" of DigitalPrintingParams not found.');
        }

        if (empty($idAtt)) {
            throw new JDFException('Required attribute "ID" of DigitalPrintingParams not found.');
        }

        if (empty($statusAtt)) {
            throw new JDFException('Required attribute "Status" of DigitalPrintingParams not found.');
        }

        if (count($printConfigEl) > 0) {
            $printConfig = PrintConfig::fromJDFElement($printConfigEl[0]);
        }

        return new DigitalPrintingParams(
            $classAtt,
            $idAtt,
            $statusAtt,
            $printConfig
        );
    }
}
