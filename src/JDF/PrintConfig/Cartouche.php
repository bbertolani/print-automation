<?php
/** @noinspection SpellCheckingInspection */
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\Cartouche class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig;

use RWC\Caldera\AbstractJDFComponent;
use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;

/**
 * Annotation settings.
 *
 * @package RWC\Caldera\JDF\PrintConfig
 */
class Cartouche extends AbstractJDFComponent implements IJDFComponent
{
    /**
     * Activates printing of annotations below the image.
     *
     * @var bool|null
     */
    protected $enable;

    /**
     * Height of the annotation area.
     *
     * @var float|null
     */
    protected $height;

    /**
     * Height of annotation font in inches.
     *
     * @var float|null
     */
    protected $textHeight;

    /**
     * Additional text to show in the annotation zone.
     *
     * @var string|null
     */
    protected $text;

    /**
     * Toggles displaying more details in the annotations.
     *
     * @var bool|null
     */
    protected $full;

    /**
     * Cartouche constructor.
     * @param bool|null $enabled
     * @param float|null $height
     * @param float|null $textHeight
     * @param null|string $text
     * @param bool|null $full
     */
    public function __construct(
        ?bool $enabled = null,
        ?float $height = null,
        ?float $textHeight = null,
        ?string $text = null,
        ?bool $full = null
    ) {
        $this->setEnable($enabled);
        $this->setHeight($height);
        $this->setTextHeight($textHeight);
        $this->setText($text);
        $this->setFull($full);
    }

    /**
     * Toggles displaying more details in the annotations.
     *
     * @param bool|null $full Toggles displaying more details in the annotations.
     */
    public function setFull(?bool $full = null) : void
    {
        $this->full = $full;
    }

    /**
     * Toggles displaying more details in the annotations.
     *
     * @return bool|null Toggles displaying more details in the annotations.
     */
    public function getFull() : ?bool
    {
        return $this->full;
    }

    /**
     * Additional text to show in the annotation zone.
     *
     * @param null|string $text Additional text to show in the annotation zone.
     */
    public function setText(?string $text = null) : void
    {
        $this->text = $text;
    }

    /**
     * Additional text to show in the annotation zone.
     *
     * @return null|string Additional text to show in the annotation zone.
     */
    public function getText() : ?string
    {
        return $this->text;
    }

    /**
     * Height of annotation font in inches.
     *
     * @param null|float $textHeight Height of annotation font.
     */
    public function setTextHeight(?float $textHeight = null) : void
    {
        $this->textHeight = $textHeight;
    }

    /**
     * Height of annotation font.
     *
     * @return null|float Height of annotation font.
     */
    public function getTextHeight() : ?float
    {
        return $this->textHeight;
    }

    /**
     * Height of the annotation area.
     *
     * @param float|null $height Height of the annotation area.
     */
    public function setHeight(?float $height = null) : void
    {
        $this->height = $height;
    }

    /**
     * Height of the annotation area.
     *
     * @return float|null Height of the annotation area.
     */
    public function getHeight() : ?float
    {
        return $this->height;
    }

    /**
     * Activates printing of annotations below the image.
     *
     * @param bool|null $enable Activates printing of annotations below the image.
     */
    public function setEnable(?bool $enable = null) : void
    {
        $this->enable = $enable;
    }

    /**
     * Activates printing of annotations below the image.
     *
     * @return bool|null Activates printing of annotations below the image.
     */
    public function getEnable() : ?bool
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
        $element = $dom->createElement('cartouche');

        if (! is_null($this->getEnable())) {
            $enable = $dom->createElement('enable');
            $enable->appendChild($dom->createTextNode($this->getEnable() ? 'true' : 'false'));
            $element->appendChild($enable);
        }

        if (! is_null($this->getHeight())) {
            $height = $dom->createElement('height');
            $height->appendChild($dom->createTextNode($this->getHeight() ? 'true' : 'false'));
            $element->appendChild($height);
        }

        if (! is_null($this->getTextHeight())) {
            $textHeight = $dom->createElement('textheight');
            $textHeight->appendChild($dom->createTextNode($this->getTextHeight() ? 'true' : 'false'));
            $element->appendChild($textHeight);
        }

        if (! is_null($this->getText())) {
            $text = $dom->createElement('text');
            $text->appendChild($dom->createTextNode($this->getText()));
            $element->appendChild($text);
        }

        if (! is_null($this->getFull())) {
            $full = $dom->createElement('full');
            $full->appendChild($dom->createTextNode($this->getFull() ? 'true' : 'false'));
            $element->appendChild($full);
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
        return new Cartouche(
            self::getTagBooleanValue($element, 'enable', false, null),
            self::getTagFloatValue($element, 'height', false, null),
            self::getTagFloatValue($element, 'textheight', false, null),
            self::getTagTextValue($element, 'text', false, null),
            self::getTagBooleanValue($element, 'full', false, null)
        );
    }
}
