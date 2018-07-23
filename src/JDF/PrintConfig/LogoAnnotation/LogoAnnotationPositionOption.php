<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\LogoAnnotation\LogoAnnotationPositionOption
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF\PrintConfig\LogoAnnotation;

use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;
use RWC\Caldera\JDF\PrintConfig\IndexableValue;

/**
 * Class LogoAnnotationPositionOption
 * @package RWC\Caldera\JDF\PrintConfig\Image\Orient
 */
abstract class LogoAnnotationPositionOption extends IndexableValue
{
    /**
     * LogoAnnotationPositionOption constructor.
     *
     * @param null|string $value The orientation value.
     * @param int|null $index The index of the orientation value.
     */
    public function __construct(?string $value = null, ?int $index = null)
    {
        parent::__construct('position', $value, $index);
    }

    /**
     * Returns an array of all valid LogoAnnotation options.
     *
     * @return array Returns an array of all valid LogoAnnotation options.
     */
    public static function getOptions() : array
    {
        return [
            new Above(),
            new Left()
        ];
    }

    /**
     * Returns an LogoAnnotation option by index.
     *
     * @param int $index The Caldera index of the Orientation option.
     * @return null|LogoAnnotationPositionOption Returns an Image Orientation option by index.
     */
    public static function getOptionByIndex(int $index) : ?LogoAnnotationPositionOption
    {
        $options = self::getOptions();
        return array_reduce(
            $options,
            function (?LogoAnnotationPositionOption $carry, LogoAnnotationPositionOption $item) use ($index) {
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

        return LogoAnnotationPositionOption::getOptionByIndex((int) $index);
    }
}
