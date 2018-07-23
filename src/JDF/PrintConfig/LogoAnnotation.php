<?php
/** @noinspection SpellCheckingInspection */
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\LogoAnnotation class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig;

use RWC\Caldera\AbstractJDFComponent;
use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;
use RWC\Caldera\JDF\PrintConfig\LogoAnnotation\LogoAnnotationPositionOption;

/**
 * Logo annotation settings
 *
 * @package RWC\Caldera\JDF\PrintConfig
 */
class LogoAnnotation extends AbstractJDFComponent implements IJDFComponent
{
    /**
     * Activates logo in annotation. New in 9.10
     *
     * @var bool|null
     */
    protected $enabled;

    /**
     * New in 9.10. Switches between using a scale for the logo or matching the
     * annotation size (old behavior)
     *
     * @var bool|null
     */
    protected $matchAnnotation;

    /**
     * New in 9.10. Set the scale of the logo (if match_annot is false).
     *
     * @var float|null
     */
    protected $scale;

    /**
     * New in 9.10. Position of the logo relatively to the annotations.
     *
     * @var LogoAnnotationPositionOption
     */
    protected $position;

    /**
     * Logo image (ImageData_t) UNDOCUMENTED. New in 9.10
     *
     * @var string|null
     */
    protected $path;

    /**
     * Enables printing of a standards target instead of a custom logo image.
     *
     * @var bool|null
     */
    protected $useTarget;

    /**
     * New in 9.10. If a target is used (use_target = true), defines the target
     * name to be printed.
     *
     * @var string|null
     */
    protected $target;

    /**
     * Activates logo in annotation. New in 9.10
     *
     * @param bool|null $enabled Activates logo in annotation. New in 9.10
     */
    public function setEnabled(?bool $enabled = null) : void
    {
        $this->enabled = $enabled;
    }

    /**
     * Activates logo in annotation. New in 9.10
     *
     * @return bool|null Activates logo in annotation. New in 9.10
     */
    public function getEnabled() : ?bool
    {
        return $this->enabled;
    }

    /**
     * LogoAnnotation constructor.
     *
     * @param bool|null $enabled
     * @param bool|null $matchAnnotation
     * @param float|null $scale
     * @param null|LogoAnnotationPositionOption $position
     * @param null|string $path
     * @param bool|null $useTarget
     * @param null|string $target
     */
    public function __construct(
        ?bool $enabled = null,
        ?bool $matchAnnotation = null,
        ?float $scale = null,
        ?LogoAnnotationPositionOption $position = null,
        ?string $path = null,
        ?bool $useTarget = null,
        ?string $target = null
    ) {
        $this->setEnabled($enabled);
        $this->setMatchAnnotation($matchAnnotation);
        $this->setScale($scale);
        $this->setPosition($position);
        $this->setPath($path);
        $this->setUseTarget($useTarget);
        $this->setTarget($target);
    }
    /**
     * New in 9.10. Switches between using a scale for the logo or matching the
     * annotation size (old behavior)
     *
     * @param bool|null $matchAnnotation Switches between using a scale for the logo or matching the annotation size
     */
    public function setMatchAnnotation(?bool $matchAnnotation = null) : void
    {
        $this->matchAnnotation = $matchAnnotation;
    }

    /**
     * New in 9.10. Switches between using a scale for the logo or matching the
     * annotation size (old behavior)
     *
     * @return bool|null Switches between using a scale for the logo or matching the annotation size
     */
    public function getMatchAnnotation() : ?bool
    {
        return $this->matchAnnotation;
    }

    /**
     * New in 9.10. Set the scale of the logo (if match_annot is false).
     *
     * @param float|null $scale New in 9.10. Set the scale of the logo (if match_annot is false).
     */
    public function setScale(?float $scale = null) : void
    {
        $this->scale = $scale;
    }

    /**
     * New in 9.10. Set the scale of the logo (if match_annot is false).
     *
     * @return float|null New in 9.10. Set the scale of the logo (if match_annot is false).
     */
    public function getScale() : ?float
    {
        return $this->scale;
    }

    /**
     * New in 9.10. Position of the logo relatively to the annotations.
     *
     * @param null|LogoAnnotationPositionOption $position Position of the logo relatively to the annotations.
     */
    public function setPosition(?LogoAnnotationPositionOption $position = null) : void
    {
        $this->position = $position;
    }

    /**
     * New in 9.10. Position of the logo relatively to the annotations.
     *
     * @return LogoAnnotationPositionOption New in 9.10. Position of the logo relatively to the annotations.
     */
    public function getPosition() : LogoAnnotationPositionOption
    {
        return $this->position;
    }

    /**
     * Logo image (ImageData_t) UNDOCUMENTED. New in 9.10
     *
     * @param null|string $path Logo image (ImageData_t) UNDOCUMENTED. New in 9.10
     */
    public function setPath(?string $path = null) : void
    {
        $this->path = $path;
    }

    /**
     * Logo image (ImageData_t) UNDOCUMENTED. New in 9.10
     *
     * @return null|string Logo image (ImageData_t) UNDOCUMENTED. New in 9.10
     */
    public function getPath() : ?string
    {
        return $this->path;
    }

    /**
     * New in 9.10. Enables printing of a standards target instead of a custom logo image.
     *
     * @param bool|null $useTarget Enables printing of a standards target instead of a custom logo image.
     */
    public function setUseTarget(?bool $useTarget = null) : void
    {
        $this->useTarget = $useTarget;
    }

    /**
     * Enables printing of a standards target instead of a custom logo image.
     *
     * @return bool|null Enables printing of a standards target instead of a custom logo image.
     */
    public function getUseTarget() : ?bool
    {
        return $this->useTarget;
    }

    /**
     * New in 9.10. If a target is used (use_target = true), defines the target
     * name to be printed.
     *
     * @param null|string $target Defines the target name to be printed.
     */
    public function setTarget(?string $target = null) : void
    {
        $this->target = $target;
    }

    /**
     * New in 9.10. If a target is used (use_target = true), defines the target
     * name to be printed.
     *
     * @return null|string Defines the target name to be printed.
     */
    public function getTarget() : ?string
    {
        return $this->target;
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

        if (! empty($this->getEnabled())) {
            $enabled = $dom->createElement('enabled');
            $enabled->appendChild($dom->createTextNode($this->getEnabled() ? 'true' : 'false'));
            $element->appendChild($enabled);
        }

        if (! empty($this->getMatchAnnotation())) {
            $matchAnnotation = $dom->createElement('match_annot');
            $matchAnnotation->appendChild($dom->createTextNode($this->getMatchAnnotation() ? 'true' : 'false'));
            $element->appendChild($matchAnnotation);
        }

        if (! empty($this->getScale())) {
            $scale = $dom->createElement('scale');
            $scale->appendChild($dom->createTextNode((string) $this->getScale()));
            $element->appendChild($scale);
        }

        if (! empty($this->getPosition())) {
            $element->appendChild($this->getPosition()->getJDF($dom));
        }

        if (! empty($this->getPosition())) {
            $element->appendChild($this->getPosition()->getJDF($dom));
        }

        if (! empty($this->getPath())) {
            $path = $dom->createElement('path');
            $path->appendChild($dom->createTextNode($this->getPath()));
            $element->appendChild($path);
        }

        if (! empty($this->getUseTarget())) {
            $useTarget = $dom->createElement('use_target');
            $useTarget->appendChild($dom->createTextNode($this->getUseTarget() ? 'true' : 'falses'));
            $element->appendChild($useTarget);
        }

        if (! empty($this->getTarget())) {
            $target = $dom->createElement('target');
            $target->appendChild($dom->createTextNode($this->getTarget()));
            $element->appendChild($target);
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
        $positionEl = $element->getElementsByTagName('position');
        $position = null;
        if (count($positionEl) > 0) {
            $position = LogoAnnotationPositionOption::fromJDFElement($positionEl[0]);
        }

        return new LogoAnnotation(
            self::getTagBooleanValue($element, 'enabled', false, null),
            self::getTagBooleanValue($element, 'match_annot', false, null),
            self::getTagFloatValue($element, 'scale', false, null),
            $position,
            self::getTagTextValue($element, 'path', false, null),
            self::getTagBooleanValue($element, 'use_target', false, null),
            self::getTagTextValue($element, 'target', false, null)
        );
    }
}
