<?php
/** @noinspection SpellCheckingInspection */
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\CropMarks class.
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
 * Class Image
 * @package RWC\Caldera\JDF\PrintConfig
 */
class CropMarks extends AbstractJDFComponent implements IJDFComponent
{
    /**
     * Enables printing crop marks. The marks are activated independently (see below)
     *
     * @var bool|null
     */
    protected $enabled;

    /**
     * Generate given crop mark.
     *
     * @var bool|null
     */
    protected $standard;

    /**
     * Generate given crop mark.
     *
     * @var bool|null
     */
    protected $frame;

    /**
     * Generate given crop mark.
     *
     * @var bool|null
     */
    protected $corner;

    /**
     * Generate given crop mark.
     *
     * @var bool|null
     */
    protected $tombo;

    /**
     * Generate given crop mark.
     *
     * @var bool|null
     */
    protected $target;

    /**
     * Generate given crop mark.
     *
     * @var bool|null
     */
    protected $date;

    /**
     * Generate given crop mark.
     *
     * @var bool|null
     */
    protected $filename;

    /**
     * Generate given crop mark.
     *
     * @var bool|null
     */
    protected $pageNumber;

    /**
     * Margin to apply between the image and the crop marks. The margin is the same
     * on all 4 sides.
     *
     * @var float|null
     */
    protected $marginInch;

    /**
     * Bleeding to apply when generating the crop marks.
     *
     * @var float|null
     */
    protected $bleedInch;

    /**
     * New in 9.20: Allows to use user defined cropmarks thickness (as defined by
     * <cm_width_inch>)
     *
     * @var bool|null
     */
    protected $useCmThickness;

    /**
     * New in 9.20: Set the cropmark line width (thickness) if use_cm_thickness is true.
     *
     * @var float|null
     */
    protected $widthInch;

    /**
     * New in 9.20: Set the cropmark line length. This affect also additional space
     * around the image (if required by selected cropmarks). Before 9.20 this was fixed
     * to 0.25 inch.
     *
     * @var float|null
     */
    protected $lengthInch;

    /**
     * Text to be displayed in the crop marks area on the bottom of the image.
     *
     * @var string|null
     */
    protected $freeText;

    /**
     * CropMarks constructor.
     *
     * @param bool|null $enabled Enable cropmarks
     * @param bool|null $standard Enable standard cropmarks
     * @param bool|null $frame Enable frame cropmarks
     * @param bool|null $corner Enable corner cropmarks
     * @param bool|null $tombo Enable tombo cropmarks
     * @param bool|null $target Enable target cropmarks
     * @param bool|null $date Enable date in cropmarks
     * @param bool|null $filename Enable filename in cropmarks
     * @param bool|null $pageNumber Enable page number in crop marks
     * @param float|null $marginInch Set crop mark margin, in inches
     * @param float|null $bleedInch Set bleed size, in inches.
     * @param bool|null $useCmThickness Use override crop mark thickness.
     * @param float|null $widthInch Width of cropmarks
     * @param float|null $lengthInch Length of crop marks
     * @param null|string $freeText Free text to display in crop marks.
     */
    public function __construct(
        ?bool $enabled = null,
        ?bool $standard = null,
        ?bool $frame = null,
        ?bool $corner = null,
        ?bool $tombo = null,
        ?bool $target = null,
        ?bool $date = null,
        ?bool $filename = null,
        ?bool $pageNumber = null,
        ?float $marginInch = null,
        ?float $bleedInch = null,
        ?bool $useCmThickness = null,
        ?float $widthInch = null,
        ?float $lengthInch = null,
        ?string $freeText = null
    ) {
        $this->setEnabled($enabled);
        $this->setStandard($standard);
        $this->setFrame($frame);
        $this->setCorner($corner);
        $this->setTombo($tombo);
        $this->setTarget($target);
        $this->setDate($date);
        $this->setFilename($filename);
        $this->setPageNumber($pageNumber);
        $this->setMarginInch($marginInch);
        $this->setBleedInch($bleedInch);
        $this->setUseCropMarksThickness($useCmThickness);
        $this->setWidthInches($widthInch);
        $this->setLengthInches($lengthInch);
        $this->setFreeText($freeText);
    }
    /**
     * Text to be displayed in the crop marks area on the bottom of the image.
     *
     * @param null|string $freeText Text to be displayed in the crop marks area on the bottom of the image.
     */
    public function setFreeText(?string $freeText = null) : void
    {
        $this->freeText = $freeText;
    }

    /**
     * Text to be displayed in the crop marks area on the bottom of the image.
     *
     * @return null|string Text to be displayed in the crop marks area on the bottom of the image.
     */
    public function getFreeText() : ?string
    {
        return $this->freeText;
    }

    /**
     * New in 9.20: Set the cropmark line length. This affect also additional
     * space around the image (if required by selected cropmarks). Before 9.20
     * this was fixed to 0.25 inch.
     *
     * @param float|null $lengthInches Set the cropmark line length.
     */
    public function setLengthInches(?float $lengthInches = null) : void
    {
        $this->lengthInch = $lengthInches;
    }

    /**
     * New in 9.20: Set the cropmark line length. This affect also additional
     * space around the image (if required by selected cropmarks). Before 9.20
     * this was fixed to 0.25 inch.
     *
     * @return float|null  Set the cropmark line length.
     */
    public function getLengthInches() : ?float
    {
        return $this->lengthInch;
    }

    /**
     * New in 9.20: Set the cropmark line width (thickness) if use_cm_thickness is true.
     *
     * @param float|null $widthInches New in 9.20: Set the cropmark line width (thickness) if use_cm_thickness is true.
     */
    public function setWidthInches(?float $widthInches = null) : void
    {
        $this->widthInch = $widthInches;
    }

    /**
     * New in 9.20: Set the cropmark line width (thickness) if use_cm_thickness is true.
     *
     * @return float|null Set the cropmark line width (thickness) if use_cm_thickness is true.
     */
    public function getWidthInches() : ?float
    {
        return $this->widthInch;
    }

    /**
     * New in 9.20: Allows to use user defined cropmarks thickness (as defined
     * by <cm_width_inch>).
     *s
     * @param bool|null $useCmThickness Allows to use user defined cropmarks thickness.s
     */
    public function setUseCropMarksThickness(?bool $useCmThickness = null) : void
    {
        $this->useCmThickness = $useCmThickness;
    }

    /**
     * New in 9.20: Allows to use user defined cropmarks thickness (as defined
     * by <cm_width_inch>).
     *
     * @return bool|null : Allows to use user defined cropmarks thickness.
     */
    public function getUseCropMarksThickness() : ?bool
    {
        return $this->useCmThickness;
    }

    /**
     * Bleeding to apply when generating the crop marks.
     *
     * @param float|null $bleedInch Bleeding to apply when generating the crop marks.
     */
    public function setBleedInch(?float $bleedInch) : void
    {
        $this->bleedInch = $bleedInch;
    }

    /**
     * Bleeding to apply when generating the crop marks.
     *
     * @return float|null Bleeding to apply when generating the crop marks.
     */
    public function getBleedInch() : ?float
    {
        return $this->bleedInch;
    }

    /**
     * Margin to apply between the image and the crop marks. The margin is the
     * same on all 4 sides.
     *
     * @param float|null $marginInch Margin to apply between the image and the crop marks.
     */
    public function setMarginInch(?float $marginInch = null) : void
    {
        $this->marginInch = $marginInch;
    }

    /**
     * Margin to apply between the image and the crop marks. The margin is the
     * same on all 4 sides.
     *
     * @return float|null Margin to apply between the image and the crop marks.
     */
    public function getMarginInch() : ?float
    {
        return $this->marginInch;
    }

    /**
     * Enables printing crop marks. The marks are activated independently (see below)
     *
     * @param bool|null $enabled Enables printing crop marks. The marks are activated independently (see below)z
     */
    public function setEnabled(?bool $enabled = null) : void
    {
        $this->enabled = $enabled;
    }

    /**
     * Enables printing crop marks. The marks are activated independently (see below)
     *
     * @return bool|null Enables printing crop marks. The marks are activated independently (see below)s
     */
    public function getEnabled() : ?bool
    {
        return $this->enabled;
    }

    /**
     * Generate given crop mark.
     *
     * @param bool|null $standard Generate given crop mark.
     */
    public function setStandard(?bool $standard = null) : void
    {
        $this->standard = $standard;
    }

    /**
     * Generate given crop mark.
     *
     * @return bool|null Generate given crop mark.
     */
    public function getStandard() : ?bool
    {
        return $this->standard;
    }

    /**
     * Generate given crop mark.
     *
     * @param bool|null $frame Generate given crop mark.
     */
    public function setFrame(?bool $frame = null) : void
    {
        $this->frame = $frame;
    }

    /**
     * Generate given crop mark.
     *
     * @return bool|null Generate given crop mark.
     */
    public function getFrame() : ?bool
    {
        return $this->frame;
    }

    /**
     * Generate given crop mark.
     *
     * @param bool|null $corner Generate given crop mark.
     */
    public function setCorner(?bool $corner = null) : void
    {
        $this->corner = $corner;
    }

    /**
     * Generate given crop mark.
     *
     * @return bool|null Generate given crop mark.
     */
    public function getCorner() : ?bool
    {
        return $this->corner;
    }

    /**
     * Generate given crop mark.
     *
     * @param bool|null $tombo Generate given crop mark.
     */
    public function setTombo(?bool $tombo = null) : void
    {
        $this->tombo = $tombo;
    }

    /**
     * Generate given crop mark.
     *
     * @return bool|null Generate given crop mark.
     */
    public function getTombo() : ?bool
    {
        return $this->tombo;
    }

    /**
     * Generate given crop mark.
     *
     * @param bool|null $target Generate given crop mark.
     */
    public function setTarget(?bool $target = null) : void
    {
        $this->target = $target;
    }

    /**
     * Generate given crop mark.
     *
     * @return bool|null Generate given crop mark.
     */
    public function getTarget() : ?bool
    {
        return $this->target;
    }

    /**
     * Generate given crop mark.
     *
     * @param bool|null $date Generate given crop mark.
     */
    public function setDate(?bool $date = null) : void
    {
        $this->date = $date;
    }

    /**
     * Generate given crop mark.
     *
     * @return bool|null Generate given crop mark.
     */
    public function getDate() : ?bool
    {
        return $this->date;
    }

    /**
     * Generate given crop mark.
     *
     * @param bool|null $filename Generate given crop mark.
     */
    public function setFilename(?bool $filename = null) : void
    {
        $this->filename = $filename;
    }

    /**
     * Generate given crop mark.
     *
     * @return bool|null Generate given crop mark.
     */
    public function getFilename() : ?bool
    {
        return $this->filename;
    }

    /**
     * Generate given crop mark.
     *
     * @param bool|null $pageNumber Generate given crop mark.
     */
    public function setPageNumber(?bool $pageNumber = null) : void
    {
        $this->pageNumber = $pageNumber;
    }

    /**
     * Generate given crop mark.
     *
     * @return bool|null Generate given crop mark.
     */
    public function getPageNumber() : ?bool
    {
        return $this->pageNumber;
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
        $element = $dom->createElement('cropmarks');

        if (! is_null($this->getEnabled())) {
            $enabled = $dom->createElement('cm_enabled');
            $enabled->appendChild($dom->createTextNode($this->getEnabled() ? 'true' : 'false'));
            $element->appendChild($enabled);
        }

        if (! is_null($this->getStandard())) {
            $standard = $dom->createElement('cm_standard');
            $standard->appendChild($dom->createTextNode($this->getStandard() ? 'true' : 'false'));
            $element->appendChild($standard);
        }

        if (! is_null($this->getFrame())) {
            $frame = $dom->createElement('cm_frame');
            $frame->appendChild($dom->createTextNode($this->getFrame() ? 'true' : 'false'));
            $element->appendChild($frame);
        }

        if (! is_null($this->getCorner())) {
            $corner = $dom->createElement('cm_corner');
            $corner->appendChild($dom->createTextNode($this->getCorner() ? 'true' : 'false'));
            $element->appendChild($corner);
        }

        if (! is_null($this->getTombo())) {
            $tombo = $dom->createElement('cm_tombo');
            $tombo->appendChild($dom->createTextNode($this->getTombo() ? 'true' : 'false'));
            $element->appendChild($tombo);
        }

        if (! is_null($this->getTarget())) {
            $target = $dom->createElement('cm_target');
            $target->appendChild($dom->createTextNode($this->getTarget() ? 'true' : 'false'));
            $element->appendChild($target);
        }

        if (! is_null($this->getDate())) {
            $date = $dom->createElement('cm_date');
            $date->appendChild($dom->createTextNode($this->getDate() ? 'true' : 'false'));
            $element->appendChild($date);
        }

        if (! is_null($this->getFilename())) {
            $filename = $dom->createElement('cm_filename');
            $filename->appendChild($dom->createTextNode($this->getFilename() ? 'true' : 'false'));
            $element->appendChild($filename);
        }

        if (! is_null($this->getPageNumber())) {
            $pageNumber = $dom->createElement('cm_page_number');
            $pageNumber->appendChild($dom->createTextNode($this->getPageNumber() ? 'true' : 'false'));
            $element->appendChild($pageNumber);
        }

        if (! is_null($this->getMarginInch())) {
            $marginInch = $dom->createElement('cm_margin_inch');
            $marginInch->appendChild($dom->createTextNode($this->getMarginInch() ? 'true' : 'false'));
            $element->appendChild($marginInch);
        }

        if (! is_null($this->getBleedInch())) {
            $bleedInch = $dom->createElement('cm_bleed_inch');
            $bleedInch->appendChild($dom->createTextNode($this->getBleedInch() ? 'true' : 'false'));
            $element->appendChild($bleedInch);
        }

        if (! is_null($this->getUseCropMarksThickness())) {
            $cmThickness = $dom->createElement('use_cm_thickness');
            $cmThickness->appendChild($dom->createTextNode($this->getUseCropMarksThickness() ? 'true' : 'false'));
            $element->appendChild($cmThickness);
        }

        if (! is_null($this->getWidthInches())) {
            $widthInches = $dom->createElement('cm_width_inch');
            $widthInches->appendChild($dom->createTextNode($this->getWidthInches() ? 'true' : 'false'));
            $element->appendChild($widthInches);
        }

        if (! is_null($this->getLengthInches())) {
            $lengthInches = $dom->createElement('cm_length_inch');
            $lengthInches->appendChild($dom->createTextNode($this->getLengthInches() ? 'true' : 'false'));
            $element->appendChild($lengthInches);
        }

        if (! is_null($this->getFreeText())) {
            $freeText = $dom->createElement('cm_free_text');
            $freeText->appendChild($dom->createTextNode($this->getFreeText() ? 'true' : 'false'));
            $element->appendChild($freeText);
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
        return new CropMarks(
            self::getTagBooleanValue($element, 'cm_enabled', false, null),
            self::getTagBooleanValue($element, 'cm_standard', false, null),
            self::getTagBooleanValue($element, 'cm_frame', false, null),
            self::getTagBooleanValue($element, 'cm_corner', false, null),
            self::getTagBooleanValue($element, 'cm_tombo', false, null),
            self::getTagBooleanValue($element, 'cm_target', false, null),
            self::getTagBooleanValue($element, 'cm_date', false, null),
            self::getTagBooleanValue($element, 'cm_filename', false, null),
            self::getTagBooleanValue($element, 'cm_page_number', false, null),
            self::getTagFloatValue($element, 'cm_margin_inch', false, null),
            self::getTagFloatValue($element, 'cm_bleed_inch', false, null),
            self::getTagBooleanValue($element, 'use_cm_thickness', false, null),
            self::getTagFloatValue($element, 'cm_width_inch', false, null),
            self::getTagFloatValue($element, 'cm_length_inch', false, null),
            self::getTagTextValue($element, 'cm_free_text', false, null)
        );
    }
}
