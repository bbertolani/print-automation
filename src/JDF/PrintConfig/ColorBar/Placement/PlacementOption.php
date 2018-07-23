<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\ColorBar\Placement\PlacementOption class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF\PrintConfig\ColorBar\Placement;

use RWC\Caldera\JDF\PrintConfig\IndexableValue;
use RWC\Caldera\JDF\JDFException;
use RWC\Caldera\IJDFComponent;

/**
 * PlacementOption class.
 *
 * @package RWC\Caldera\JDF\PrintConfig\ColorBar\Placement
 */
abstract class PlacementOption extends IndexableValue
{
    /**
     * PlacementOption constructor.
     *
     * @param null|string $value The placement value.
     * @param int|null $index The index of the placement value.
     */
    public function __construct(?string $value = null, ?int $index = null)
    {
        parent::__construct('placement', $value, $index);
    }

    /**
     * Returns an array of all valid ColorTypeOption options.
     *
     * @return array Returns an array of all valid ColorTypeOption options.
     */
    public static function getOptions() : array
    {
        return [
            new Image(),
            new Page()
        ];
    }

    /**
     * Returns an PlacementOption option by index.
     *
     * @param int $index The Caldera index of the PlacementOption option.
     * @return null|PlacementOption Returns an ColorTypeOption option by index.
     */
    public static function getOptionByIndex(int $index) : ?PlacementOption
    {
        $options = self::getOptions();
        return array_reduce(
            $options,
            function (?PlacementOption $carry, PlacementOption $item) use ($index) {
                if ($item->getIndex() == $index) {
                    return $item;
                }

                return $carry;
            }
        );
    }/** @noinspection PhpMissingParentCallCommonInspection */

    /**
     * Creates a new instance of the IJDFComponent from a DOMElement.
     *
     * @param \DOMElement $element The DOMElement containing the component definition.
     * @return IJDFComponent Returns the Component.
     * @throws JDFException if the element does not describe an ActionOption.
     */
    public static function fromJDFElement(\DOMElement $element): IJDFComponent
    {
        $index = $element->getAttribute('idx');

        if (is_null($index) || $index === '') {
            throw new JDFException('Required attribute idx not specified.');
        }

        return PlacementOption::getOptionByIndex((int) $index);
    }
}
