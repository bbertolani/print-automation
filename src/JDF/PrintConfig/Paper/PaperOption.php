<?php
/** @noinspection PhpMissingParentCallCommonInspection */
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\Paper\PaperOption
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF\PrintConfig\Paper;

use RWC\Caldera\JDF\PrintConfig\IndexableValue;
use RWC\Caldera\IJDFComponent;

/**
 * Class OrientOption
 * @package RWC\Caldera\JDF\PrintConfig\Image\Orient
 */
class PaperOption extends IndexableValue
{
    /**
     * OrientOption constructor.
     *
     * @param null|string $value The orientation value.
     * @param int|null $index The index of the orientation value.
     */
    public function __construct(?string $value = null, ?int $index = null)
    {
        parent::__construct('paper', $value, $index);
    }

    /**
     * Creates a new instance of the IJDFComponent from a DOMElement.
     *
     * @param \DOMElement $element The DOMElement containing the component definition.
     * @return IJDFComponent Returns the Component.
     */
    public static function fromJDFElement(\DOMElement $element): IJDFComponent
    {
        $index = (int)$element->getAttribute('idx');
        $value = $element->nodeValue;

        $index = empty($index) ? null : $index;
        $value = empty($value) ? null : $value;

        return new PaperOption($value, $index);
    }
}
