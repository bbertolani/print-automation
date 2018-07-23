<?php
/** @noinspection SpellCheckingInspection */
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\MarkSetup class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig;

use RWC\Caldera\AbstractJDFComponent;
use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;
use RWC\Caldera\JDF\PrintConfig\MarkSetup\Color;
use RWC\Caldera\JDF\PrintConfig\MarkSetup\ColorTypeOption;

/**
 * MarkSetup settings
 *
 * @package RWC\Caldera\JDF\PrintConfig
 */
class MarkSetup extends AbstractJDFComponent implements IJDFComponent
{
    /**
     * Marks color setup
     *
     * @var ColorTypeOption
     */
    protected $colorType;

    /**
     * Custom marks color definition (Color_t). UNDOCUMENTED
     *
     * @var Color|null
     */
    protected $color;

    /**
     * MarkSetup constructor.
     * @param ColorTypeOption $colorType
     * @param null|Color $color
     */
    public function __construct(ColorTypeOption $colorType, ?Color $color = null)
    {
        $this->setColorType($colorType);
        $this->setColor($color);
    }

    /**
     * Marks color setup
     *
     * @param ColorTypeOption $colorType Marks color setup
     */
    public function setColorType(ColorTypeOption $colorType) : void
    {
        $this->colorType = $colorType;
    }

    /**
     * Marks color setup
     *
     * @return ColorTypeOption Marks color setup
     */
    public function getColorType() : ColorTypeOption
    {
        return $this->colorType;
    }

    /**
     * Custom marks color definition (Color_t). UNDOCUMENTED
     *
     * @param null|Color $color Custom marks color definition (Color_t). UNDOCUMENTED
     */
    public function setColor(?Color $color = null) : void
    {
        $this->color = $color;
    }

    /**
     * Custom marks color definition (Color_t). UNDOCUMENTED
     *
     * @return null|Color Custom marks color definition (Color_t). UNDOCUMENTED
     */
    public function getColor() : ?Color
    {
        return $this->color;
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

        if (! is_null($this->getColorType())) {
            $element->appendChild($this->getColorType()->getJDF($dom));
        }

        if (! is_null($this->getColor())) {
            $element->appendChild($this->getColor()->getJDF($dom));
        }

        return $element;
    }

    /**
     * Creates a new instance of the IJDFComponent from a DOMElement.
     *
     * @param \DOMElement $element The DOMElement containing the component definition.
     * @return \RWC\Caldera\IJDFComponent Returns the Component.
     * @throws JDFException if the DOMElement does not define a valid component descriptor.
     */
    public static function fromJDFElement(\DOMElement $element): IJDFComponent
    {
        $colorTypeEl = $element->getElementsByTagName('colortype');

        if (count($colorTypeEl) == 0) {
            throw new JDFException('Required sub-element colortype not found.');
        }

        $colorEl = $element->getElementsByTagName('color');
        $color = null;

        if (count($colorEl) > 0) {
            $color = Color::fromJDFElement($colorEl[0]);
        }
        /**
         * @var $colorType ColorTypeOption
         */
        $colorType = ColorTypeOption::fromJDFElement($colorTypeEl[0]);

        return new MarkSetup(
            $colorType,
            $color
        );
    }
}
