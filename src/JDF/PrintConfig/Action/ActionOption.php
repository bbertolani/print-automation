<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\Action\ActionOption class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\Action;

use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;
use RWC\Caldera\JDF\PrintConfig\IndexableValue;

/**
 * Base for action field options that control the action selector.
 *
 * @package RWC\Caldera\JDF\PrintConfig\Action
 */
abstract class ActionOption extends IndexableValue
{
    /**
     * ActionOption constructor.
     *
     * @param null|string $value The option value.
     * @param int|null $index The option index.
     */
    public function __construct(?string $value = null, ?int $index = null)
    {
        parent::__construct(
            'action',
            $value,
            $index
        );
    }

    /**
     * Returns an array of all valid ActionOptions.
     *
     * @return ActionOption[] An array of valid ActionOptions.
     */
    public static function getOptions() : array
    {
        return [
            new File(),
            new Nest(),
            new PrintDiscard(),
            new PrintHold(),
            new Reprint(),
            new ReprintAndPrint(),
            new ReprintThenPrint(),
            new ReprintThenPrintThenDelete()
        ];
    }

    /**
     * @param int $index
     * @return null|ActionOption
     */
    public static function getOptionByIndex(int $index) : ?ActionOption
    {
        $options = self::getOptions();
        return array_reduce($options, function (?ActionOption $carry, ActionOption $item) use ($index) {
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

        return ActionOption::getOptionByIndex((int) $index);
    }
}
