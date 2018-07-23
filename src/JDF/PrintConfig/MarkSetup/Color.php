<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\CropMarks class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF\PrintConfig\MarkSetup;

use RWC\Caldera\AbstractJDFComponent;
use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;
use RWC\Caldera\JDF\PrintConfig\MarkSetup\Color\CMYK;

/**
 * Class Color
 * @package RWC\Caldera\JDF\PrintConfig\MarkSetup
 */
abstract class Color extends AbstractJDFComponent implements IJDFComponent
{
    /**
     * @var string
     */
    protected $mode;

    /**
     * Color constructor.
     * @param string $mode
     */
    public function __construct(string $mode)
    {
        $this->setMode($mode);
    }

    /**
     * @param string $mode
     */
    public function setMode(string $mode) : void
    {
        $this->mode = $mode;
    }

    /**
     * @return string
     */
    public function getMode() : string
    {
        return $this->mode;
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
        $modeEl= $element->getElementsByTagName('mode');

        if (count($modeEl) == 0) {
            throw new JDFException('mode sub-element is required');
        }

        $mode = $modeEl[0]->textContent;

        switch ($mode) {
            case 'CMYK':
                return CMYK::fromJDFElement($element);
            default:
                throw new JDFException("Unsupported color mode $mode");
        }
    }
}
