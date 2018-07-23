<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\Image class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig;

use RWC\Caldera\AbstractJDFComponent;
use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;
use RWC\Caldera\JDF\PrintConfig\Image\Orient\OrientOption;

/**
 * Class Image
 * @package RWC\Caldera\JDF\PrintConfig
 */
class Image extends AbstractJDFComponent
{
    /**
     * Enable image clipping.
     *
     * @var bool|null
     */
    protected $clip;

    /**
     * Image dimension in inches.
     *
     * @var float
     */
    protected $width;

    /**
     * Image dimension in inches.
     *
     * @var float
     */
    protected $height;

    /**
     * Position in inches, relative to the page.
     *
     * @var float
     */
    protected $positionX;

    /**
     * Position in inches, relative to the page.
     *s
     * @var float
     */
    protected $positionY;

    /**
     * Image orientation
     *
     * @var \RWC\Caldera\JDF\PrintConfig\Image\Orient\OrientOption
     */
    protected $orient;

    /**
     * Enable image centering
     *
     * @var bool
     */
    protected $center;

    /**
     * Enable image to be scaled to the full page (or template)
     *
     * @var bool
     */
    protected $full;

    /**
     * Attempt to scale the image at scale 100%
     *
     * @var bool
     */
    protected $scale100Phys;

    /**
     * Image scale. Not used if “scale100_phys” or “full” set to true. If both
     * image dimensions and scale are set, the scale has priority.
     *
     * @var float
     */
    protected $scaleXPhys;

    /**
     * Image scale. Not used if “scale100_phys” or “full” set to true. If both
     * image dimensions and scale are set, the scale has priority.
     *
     * @var float
     */
    protected $scaleYPhys;

    /**
     * Mirror the whole page horizontally.
     *
     * @var bool
     */
    protected $mirror;

    /**
     * Toggles preserving the image dimensions ratio, as defined by the image
     * dimensions or scale.
     *
     * @var bool
     */
    protected $keepRatio;

    /**
     * Define which pages will be printed with multi-page documents. Not used if
     * "allpages” = true
     *
     * @var int
     */
    protected $pageFrom;

    /**
     * Define which pages will be printed with multi-page documents. Not used if
     * "allpages” = true
     *
     * @var int
     */
    protected $pageTo;

    /**
     * Define which pages will be printed with multi-page documents. Not used if
     * "allpages” = true
     *
     * @var bool
     */
    protected $allPages;

    public function __construct(
        ?bool $clip = null,
        ?float $width = null,
        ?float $height = null,
        ?float $positionX = null,
        ?float $positionY = null,
        ?OrientOption $orient = null,
        ?bool $center = null,
        ?bool $full = null,
        ?bool $scale100Phys = null,
        ?float $scaleXPhys = null,
        ?float $scaleYPhys = null,
        ?bool $mirror = null,
        ?bool $keepRatio = null,
        ?int $pageFrom = null,
        ?int $pageTo = null,
        ?bool $allPages = null
    ) {
        $this->setClip($clip);
        $this->setWidth($width);
        $this->setHeight($height);
        $this->setPositionX($positionX);
        $this->setPositionY($positionY);
        $this->setOrient($orient);
        $this->setCenter($center);
        $this->setFull($full);
        $this->setScale100Phys($scale100Phys);
        $this->setScaleXPhys($scaleXPhys);
        $this->setScaleYPhys($scaleYPhys);
        $this->setMirror($mirror);
        $this->setKeepRatio($keepRatio);
        $this->setPageFrom($pageFrom);
        $this->setPageTo($pageTo);
        $this->setAllPages($allPages);
    }

    /**
     * Enable image clipping.
     *
     * @param bool $clip Enable image clipping.
     */
    public function setClip(bool $clip) : void
    {
        $this->clip = $clip;
    }

    /**
     * Enable image clipping.
     *s
     * @return bool Enable image clipping.
     */
    public function getClip() : bool
    {
        return $this->clip;
    }

    /**
     * Image dimension in inches.
     *
     * @param float $width Image dimension in inches.
     */
    public function setWidth(float $width) : void
    {
        $this->width = $width;
    }

    /**
     * Image dimension in inches.
     *
     * @return float Image dimension in inches.
     */
    public function getWidth() : float
    {
        return $this->width;
    }

    /**
     * Image dimension in inches.
     *
     * @param float $height Image dimension in inches.
     */
    public function setHeight(float $height) : void
    {
        $this->height = $height;
    }

    /**
     * Image dimension in inches.
     *
     * @return float Image dimension in inches.
     */
    public function getHeight() : float
    {
        return $this->height;
    }

    /**
     * Position in inches, relative to the page.
     *s
     * @param float $positionY Position in inches, relative to the page.
     */
    public function setPositionY(float $positionY) : void
    {
        $this->positionY = $positionY;
    }

    /**
     * Position in inches, relative to the page.
     *
     * @return float Position in inches, relative to the page.
     */
    public function getPositionY() : float
    {
        return $this->positionY;
    }

    /**
     * Position in inches, relative to the page.
     *
     * @param float $positionX Position in inches, relative to the page.
     */
    public function setPositionX(float $positionX) : void
    {
        $this->positionX = $positionX;
    }

    /**
     * Position in inches, relative to the page.
     *
     * @return float Position in inches, relative to the page.
     */
    public function getPositionX() : float
    {
        return $this->positionX;
    }

    /**
     * Image orientation
     *
     * @param OrientOption $orient Image orientation
     */
    public function setOrient(OrientOption $orient) : void
    {
        $this->orient = $orient;
    }

    /**
     * Image orientation
     *
     * @return OrientOption Image orientation
     */
    public function getOrient() : OrientOption
    {
        return $this->orient;
    }

    /**
     * Enable image centering
     *
     * @param bool $center Enable image centering
     */
    public function setCenter(bool $center) : void
    {
        $this->center = $center;
    }

    /**
     * Enable image centering
     *
     * @return bool Enable image centering
     */
    public function getCenter() : bool
    {
        return $this->center;
    }

    /**
     * Enable image to be scaled to the full page (or template)
     *
     * @param bool $full Enable image to be scaled to the full page (or template)
     */
    public function setFull(bool $full) : void
    {
        $this->full = $full;
    }

    /**
     * Enable image to be scaled to the full page (or template)
     *
     * @return bool Enable image to be scaled to the full page (or template)
     */
    public function getFull() : bool
    {
        return $this->full;
    }

    /**
     * Attempt to scale the image at scale 100%
     *
     * @param bool $scale100Phys Attempt to scale the image at scale 100%
     */
    public function setScale100Phys(bool $scale100Phys) : void
    {
        $this->scale100Phys = $scale100Phys;
    }

    /**
     * Attempt to scale the image at scale 100%
     *
     * @return bool Attempt to scale the image at scale 100%
     */
    public function getScale100Phys() : bool
    {
        return $this->scale100Phys;
    }

    /**
     * Image scale. Not used if “scale100_phys” or “full” set to true. If both
     * image dimensions and scale are set, the scale has priority.
     *
     * @param float $scaleYPhys Y Image Scale
     */
    public function setScaleYPhys(float $scaleYPhys = 1.0) : void
    {
        $this->scaleYPhys = $scaleYPhys;
    }

    /**
     * Image scale. Not used if “scale100_phys” or “full” set to true. If both
     * image dimensions and scale are set, the scale has priority.
     *
     * @return float Y Image Scale
     */
    public function getScaleYPhys() : float
    {
        return $this->scaleYPhys;
    }

    /**
     * Image scale. Not used if “scale100_phys” or “full” set to true. If both
     * image dimensions and scale are set, the scale has priority.
     *
     * @param float $scaleXPhys X Image Scale
     */
    public function setScaleXPhys(float $scaleXPhys = 1.0) : void
    {
        $this->scaleXPhys = $scaleXPhys;
    }

    /**
     * Image scale. Not used if “scale100_phys” or “full” set to true. If both
     * image dimensions and scale are set, the scale has priority.
     *
     * @return float X Image scale.
     */
    public function getScaleXPhys() : float
    {
        return $this->scaleXPhys;
    }

    /**
     * Mirror the whole page horizontally.
     *
     * @param bool $mirror Mirror the whole page horizontally.
     */
    public function setMirror(bool $mirror) : void
    {
        $this->mirror = $mirror;
    }

    /**
     * Mirror the whole page horizontally.
     *
     * dimensions or scale.
     *
     * @return bool Mirror the whole page horizontally.
     */
    public function getMirror() : bool
    {
        return $this->mirror;
    }

    /**
     * Toggles preserving the image dimensions ratio, as defined by the image
     * dimensions or scale.
     *
     * @param bool $keepRatio Toggles preserving the image dimensions ratio
     */
    public function setKeepRatio(bool $keepRatio) : void
    {
        $this->keepRatio = $keepRatio;
    }

    /**
     * Toggles preserving the image dimensions ratio, as defined by the image
     * dimensions or scale.
     *
     * @return bool Toggles preserving the image dimensions ratio.
     */
    public function getKeepRatio() : bool
    {
        return $this->keepRatio;
    }

    /**
     * Define which pages will be printed with multi-page documents.
     *
     * @param int $pageFrom Define which pages will be printed with multi-page documents.
     */
    public function setPageFrom(int $pageFrom) : void
    {
        $this->pageFrom = $pageFrom;
    }

    /**
     * Define which pages will be printed with multi-page documents.
     *
     * @return int Define which pages will be printed with multi-page documents.
     */
    public function getPageFrom() : int
    {
        return $this->pageFrom;
    }

    /**
     * Define which pages will be printed with multi-page documents. Not used if
     * "allpages” = true
     *
     * @param int $pageTo Define which pages will be printed with multi-page docs.
     */
    public function setPageTo(int $pageTo) : void
    {
        $this->pageTo = $pageTo;
    }

    /**
     * Define which pages will be printed with multi-page documents. Not used if
     * “allpages” = true
     *
     * @return int Define which pages will be printed with multi-page documents.
     */
    public function getPageTo() : int
    {
        return $this->pageTo;
    }

    /**
     * Force printing all pages with multi-page documents
     *
     * @param bool $allPages Force printing all pages with multi-page documents
     */
    public function setAllPages(bool $allPages) : void
    {
        $this->allPages = $allPages;
    }

    /**
     * Force printing all pages with multi-page documents
     *
     * @return bool Force printing all pages with multi-page documents
     */
    public function getAllPages() : bool
    {
        return $this->allPages;
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
        // TODO Complete
        $element = $dom->createElement('img');

        $element->setAttribute('clip', $this->getClip() ? 'true': 'false');

        $width = $dom->createElement('w');
        $width->appendChild($dom->createTextNode((string) $this->getWidth()));
        $element->appendChild($width);

        $height = $dom->createElement('h');
        $height->appendChild($dom->createTextNode((string) $this->getHeight()));
        $element->appendChild($height);

        $xPosition = $dom->createElement('x');
        $xPosition->appendChild($dom->createTextNode((string) $this->getPositionX()));
        $element->appendChild($xPosition);

        $yPosition = $dom->createElement('y');
        $yPosition->appendChild($dom->createTextNode((string) $this->getPositionY()));
        $element->appendChild($yPosition);

        $element->appendChild($this->getOrient()->getJDF($dom));

        $center = $dom->createElement('center');
        $center->appendChild($dom->createTextNode($this->getCenter() ? 'true' : 'false'));
        $element->appendChild($center);

        $full = $dom->createElement('full');
        $full->appendChild($dom->createTextNode($this->getFull() ? 'true' : 'false'));
        $element->appendChild($full);

        $scale100Phys = $dom->createElement('scale100_phys');
        $scale100Phys->appendChild($dom->createTextNode($this->getScale100Phys() ? 'true' : 'false'));
        $element->appendChild($scale100Phys);

        $scaleXPhys = $dom->createElement('scale_x_phys');
        $scaleXPhys->appendChild($dom->createTextNode((string) $this->getScaleXPhys()));
        $element->appendChild($scaleXPhys);

        $scaleYPhys = $dom->createElement('scale_y_phys');
        $scaleYPhys->appendChild($dom->createTextNode((string) $this->getScaleYPhys()));
        $element->appendChild($scaleYPhys);

        $mirror = $dom->createElement('mirror');
        $mirror->appendChild($dom->createTextNode($this->getMirror() ? 'true' : 'false'));
        $element->appendChild($mirror);

        $keepRatio = $dom->createElement('keep_ratio');
        $keepRatio->appendChild($dom->createTextNode($this->getKeepRatio() ? 'true' : 'false'));
        $element->appendChild($keepRatio);

        $pageFrom = $dom->createElement('page_from');
        $pageFrom->appendChild($dom->createTextNode((string)$this->getPageFrom()));
        $element->appendChild($pageFrom);

        $pageTo = $dom->createElement('page_to');
        $pageFrom->appendChild($dom->createTextNode((string)$this->getPageTo()));
        $element->appendChild($pageTo);

        /** @noinspection SpellCheckingInspection */
        $allPages = $dom->createElement('allpages');
        $allPages->appendChild($dom->createTextNode((string)$this->getAllPages()));
        $element->appendChild($allPages);
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
        $clip = self::getTagBooleanValue($element, 'clip');
        $width = self::getTagFloatValue($element, 'width');
        $height = self::getTagFloatValue($element, 'height');
        $positionX = self::getTagFloatValue($element, 'positionX');
        $positionY = self::getTagFloatValue($element, 'positionY');
        $orientEls = $element->getElementsByTagName('orient');
        $orient = null;

        if (count($orientEls) > 0) {
            $orient = Image\Orient\OrientOption::fromJDFElement($orientEls[0]);
        }

        $center = self::getTagBooleanValue($element, 'center');
        $full = self::getTagBooleanValue($element, 'full');
        $scale100Phys = self::getTagBooleanValue($element, 'scale100_phys');
        $scaleXPhys = self::getTagFloatValue($element, 'scale_x_phys');
        $scaleYPhys = self::getTagFloatValue($element, 'scale_y_phys');
        $mirror = self::getTagBooleanValue($element, 'mirror');
        $keepRatio = self::getTagBooleanValue($element, 'keep_ratio');
        $pageFrom = self::getTagIntegerValue($element, 'page_from');
        $pageTo = self::getTagIntegerValue($element, 'page_to');
        $allPages = self::getTagBooleanValue($element, 'allpages');

        return new Image(
            $clip,
            $width,
            $height,
            $positionX,
            $positionY,
            $orient,
            $center,
            $full,
            $scale100Phys,
            $scaleXPhys,
            $scaleYPhys,
            $mirror,
            $keepRatio,
            $pageFrom,
            $pageTo,
            $allPages
        );
    }
}
