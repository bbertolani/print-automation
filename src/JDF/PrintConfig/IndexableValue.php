<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\IndexableValue class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig;

use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;

/**
 * Wraps a common PrintConfig structure for values configurable within the
 * Caldera user interface.  These values specify a text value as well as the
 * selectable index of that value within Caldera's dropdown menus.
 *
 * @package RWC\Caldera\JDF\PrintConfig
 */
class IndexableValue implements IJDFComponent
{
    protected $index;
    protected $value;
    protected $element;

    /**
     * IndexableValue constructor.
     *
     * @param string $element
     * @param null|string $value
     * @param int|null $index
     */
    public function __construct(
        string $element,
        ?string $value = null,
        ?int $index = null
    ) {
        $this->setElement($element);
        $this->setValue($value);
        $this->setIndex($index);
    }

    /**
     * Sets the tag name.
     *
     * @param string $element Sets the tag name.
     */
    public function setElement(string $element) : void
    {
        $this->element = $element;
    }

    /**
     * Returns the tag name.
     *
     * @return string Returns the tag name.
     */
    public function getElement() : string
    {
        return $this->element;
    }

    /**
     * Sets the value
     *
     * @param null|string $value The value.
     */
    public function setValue(?string $value) : void
    {
        $this->value = $value;
    }

    /**
     * Returns the value.
     *
     * @return null|string Returns the value.
     */
    public function getValue() : ?string
    {
        return $this->value;
    }

    /**
     * Sets the numerical index.
     *
     * @param int|null $index The numerical index.
     */
    public function setIndex(?int $index) : void
    {
        $this->index = $index;
    }

    /**
     * Returns the numerical index.
     *
     * @return int|null Returns the numerical index.
     */
    public function getIndex() : ?int
    {
        return $this->index;
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
        $element = $dom->createElement($this->getElement());

        if (! empty($this->getIndex())) {
            $element->setAttribute('idx', (string) $this->getIndex());
        }

        if (! empty($this->getValue())) {
            $element->appendChild($dom->createTextNode($this->getValue()));
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
        $tagName = $element->tagName;
        $index   = (int) $element->getAttribute('idx');
        $value   = $element->nodeValue;

        $index = empty($index) ? null : $index;
        $value = empty($value) ? null : $value;

        return new self($tagName, $value, $index);
    }
}
