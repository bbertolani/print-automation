<?php
/** @noinspection SpellCheckingInspection */
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\StepAndRepeat class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig;

use RWC\Caldera\AbstractJDFComponent;
use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;
use RWC\Caldera\JDF\PrintConfig\StepAndRepeat\TypeOption;

/**
 * StepAndRepeat settings
 *
 * @package RWC\Caldera\JDF\PrintConfig
 */
class StepAndRepeat extends AbstractJDFComponent implements IJDFComponent
{
    /**
     * New in 9.10. Enables Step & Repeat feature.
     *
     * @var bool|null
     */
    protected $enable;

    /**
     * New in 9.10. Define the type of Step & Repeat.
     *
     * @var TypeOption|null
     */
    protected $type;

    /**
     * Specific parameters for textile (from 9.10) and contour nesting
     * (from 9.20) step&repeat. Parameter description available upon request.
     *
     * @var string|null
     */
    protected $textile;

    /**
     * Specific parameters for textile (from 9.10) and contour nesting
     * (from 9.20) step&repeat. Parameter description available upon request.
     *
     * @var string|null
     */
    protected $trueShape;

    /**
     * StepAndRepeat constructor.
     * @param bool|null $enabled
     * @param null|TypeOption $typeOption
     * @param null|string $textile
     * @param null|string $trueShape
     */
    public function __construct(
        ?bool $enabled = null,
        ?TypeOption $typeOption = null,
        ?string $textile = null,
        ?string $trueShape = null
    ) {
        $this->setEnabled($enabled);
        $this->setType($typeOption);
        $this->setTextile($textile);
        $this->setTrueShape($trueShape);
    }

    /**
     * Specific parameters for textile (from 9.10) and contour nesting
     * (from 9.20) step&repeat. Parameter description available upon request.
     *
     * @param null|string $trueShape Specific parameters for trueshape.
     */
    public function setTrueShape(?string $trueShape = null) : void
    {
        $this->trueShape = $trueShape;
    }

    /**
     * Specific parameters for textile (from 9.10) and contour nesting
     * (from 9.20) step&repeat. Parameter description available upon request.
     *
     * @return null|string Specific parameters for trueshape.
     */
    public function getTrueShape() : ?string
    {
        return $this->trueShape;
    }

    /**
     * Specific parameters for textile (from 9.10) and contour nesting
     * (from 9.20) step&repeat. Parameter description available upon request.
     *
     * @param null|string $textile Specific parameters for textile.
     */
    public function setTextile(?string $textile = null) : void
    {
        $this->textile = $textile;
    }

    /**
     * Specific parameters for textile (from 9.10) and contour nesting
     * (from 9.20) step&repeat. Parameter description available upon request.
     *
     * @return null|string Returns specific parameters for textile.
     */
    public function getTextile() : ?string
    {
        return $this->textile;
    }

    /**
     * New in 9.10. Define the type of Step & Repeat.
     *
     * @param null|TypeOption $type New in 9.10. Define the type of Step & Repeat.
     */
    public function setType(?TypeOption $type = null) : void
    {
        $this->type = $type;
    }

    /**
     * New in 9.10. Define the type of Step & Repeat.
     *
     * @return null|TypeOption New in 9.10. Define the type of Step & Repeat.
     */
    public function getType() : ?TypeOption
    {
        return $this->type;
    }

    /**
     * New in 9.10. Enables Step & Repeat feature.
     *
     * @param bool|null $enable New in 9.10. Enables Step & Repeat feature.
     */
    public function setEnabled(?bool $enable = null) : void
    {
        $this->enable = $enable;
    }

    /**
     * New in 9.10. Enables Step & Repeat feature.
     *
     * @return bool|null New in 9.10. Enables Step & Repeat feature.
     */
    public function getEnabled() : ?bool
    {
        return $this->enable;
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
        $element = $dom->createElement('logo_annot');

        if (! is_null($this->getEnabled())) {
            $enabled = $dom->createElement('enabled');
            $enabled->appendChild($dom->createTextNode($this->getEnabled() ? 'true' : 'false'));
            $element->appendChild($enabled);
        }

        if (! is_null($this->getType())) {
            $element->appendChild($this->getType()->getJDF($dom));
        }

        if (! is_null($this->getTextile())) {
            $textile = $dom->createElement('textile');
            $textile->appendChild($dom->createTextNode($this->getTextile()));
            $element->appendChild($textile);
        }

        if (! is_null($this->getTrueShape())) {
            $trueShape = $dom->createElement('trueshape');
            $trueShape->appendChild($dom->createTextNode($this->getTextile()));
            $element->appendChild($trueShape);
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
        $typeEl = $element->getElementsByTagName('type');
        $type = null;

        if (count($typeEl) > 0) {
            $type = TypeOption::fromJDFElement($typeEl[0]);
        }
        return new StepAndRepeat(
            self::getTagBooleanValue($element, 'enabled', false, null),
            $type,
            self::getTagTextValue($element, 'textile', false, null),
            self::getTagTextValue($element, 'trueshape', false, null)
        );
    }
}
