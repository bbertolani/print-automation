<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\NestingMode\NestingModeOption
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace PF\Caldera\JDF\PrintConfig\NestingMode;

use RWC\Caldera\IJDFComponent;
use PF\Caldera\JDF\JDFException;
use RWC\Caldera\JDF\PrintConfig\IndexableValue;

/**
 * Base for nesting_mode field options.
 *
 * @package RWC\Caldera\JDF\PrintConfig\PrintGab\Orient
 */
abstract class NestingModeOption extends IndexableValue
{
    /**
     * NestingModeOption constructor.
     *
     * @param null|string $value The option value.
     * @param int|null $index The option index.
     */
    public function __construct(?string $value = null, ?int $index = null)
    {
        parent::__construct(
            'nesting_mode',
            $value,
            $index
        );
    }

    /**
     * Returns an array of all valid NestingModeOptions.
     *
     * @return NestingModeOption[] An array of valid NestingModeOption.
     */
    public static function getOptions(): array
    {
        return [
            new Auto(),
            new Custom(),
            new FullStepAndRepeat(),
            new NoStepAndRepeat()
        ];
    }

    /**
     * @param int $index
     * @return null|NestingModeOption
     */
    public static function getOptionByIndex(int $index): ?NestingModeOption
    {
        $options = self::getOptions();
        return array_reduce($options, function (?NestingModeOption $carry, NestingModeOption $item) use ($index) {
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

        if (empty($index)) {
            throw new JDFException('Required attribute idx not specified.');
        }

        return NestingModeOption::getOptionByIndex((int)$index);
    }
}
