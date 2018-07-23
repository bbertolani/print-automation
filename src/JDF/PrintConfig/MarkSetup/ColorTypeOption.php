<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\MarkSetup\ColorTypeOption
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF\PrintConfig\MarkSetup;

use RWC\Caldera\JDF\JDFException;
use RWC\Caldera\JDF\PrintConfig\IndexableValue;
use RWC\Caldera\IJDFComponent;

/**
 * ColorTypeOption
 *
 * @package RWC\Caldera\JDF\PrintConfig\Image\Orient
 */
abstract class ColorTypeOption extends IndexableValue
{
    /**
     * OrientOption constructor.
     *
     * @param null|string $value The orientation value.
     * @param int|null $index The index of the orientation value.
     */
    public function __construct(?string $value = null, ?int $index = null)
    {
        /** @noinspection SpellCheckingInspection */
        parent::__construct('colortype', $value, $index);
    }

    /**
     * Returns an array of all valid ColorTypeOption options.
     *
     * @return array Returns an array of all valid ColorTypeOption options.
     */
    public static function getOptions() : array
    {
        return [
            new CompBlack(),
            new Custom(),
            new PureBlack()
        ];
    }

    /**
     * Returns an ColorTypeOption option by index.
     *
     * @param int $index The Caldera index of the ColorTypeOption option.
     * @return null|ColorTypeOption Returns an ColorTypeOption option by index.
     */
    public static function getOptionByIndex(int $index) : ?ColorTypeOption
    {
        $options = self::getOptions();
        return array_reduce(
            $options,
            function (?ColorTypeOption $carry, ColorTypeOption $item) use ($index) {
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

        return ColorTypeOption::getOptionByIndex((int) $index);
    }
}
