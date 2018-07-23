<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\PrintGab\Orient\OrientOption class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\PrintGab\Orient;

use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;
use RWC\Caldera\JDF\PrintConfig\IndexableValue;

/**
 * Base for orient field options that control the template orientation.
 *
 * @package RWC\Caldera\JDF\PrintConfig\PrintGab\Orient
 */
abstract class OrientOption extends IndexableValue
{
    /**
     * OrientOption constructor.
     *
     * @param null|string $value The option value.
     * @param int|null $index The option index.
     */
    public function __construct(?string $value = null, ?int $index = null)
    {
        parent::__construct(
            'orient',
            $value,
            $index
        );
    }

    /**
     * Returns an array of all valid Image Orientation options.
     *
     * @return array Returns an array of all valid Image Orientation options.
     */
    public static function getOptions() : array
    {
        return [
            new Auto(),
            new Horizontal(),
            new Vertical()
        ];
    }

    /**
     * Returns an Image Orientation option by index.
     *
     * @param int $index The Caldera index of the Orientation option.
     * @return null|OrientOption Returns an Image Orientation option by index.
     */
    public static function getOptionByIndex(int $index) : ?OrientOption
    {
        $options = self::getOptions();
        return array_reduce($options, function (?OrientOption $carry, OrientOption $item) use ($index) {
            if ($item->getIndex() == $index) {
                return $item;
            }

            return $carry;
        });
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

        return OrientOption::getOptionByIndex((int) $index);
    }
}
