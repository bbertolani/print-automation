<?php
declare(strict_types=1);

/**
 * This file contains the PPF\Caldera\Status\JobState class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\Status;

use RWC\Caldera\AbstractJDFComponent;
use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;
use RWC\Caldera\Status\JobState\Aborted;
use RWC\Caldera\Status\JobState\Blocked;
use RWC\Caldera\Status\JobState\ComingUp;
use RWC\Caldera\Status\JobState\Discarded;
use RWC\Caldera\Status\JobState\Error;
use RWC\Caldera\Status\JobState\Finished;
use RWC\Caldera\Status\JobState\Running;
use RWC\Caldera\Status\JobState\Waiting;

/**
 * Class JobState
 * @package RWC\Caldera\Status
 */
class JobState extends AbstractJDFComponent implements IJDFComponent
{
    protected $index;
    protected $value;

    /**
     * JobState constructor.
     * @param int $index
     * @param string $value
     */
    public function __construct(int $index, string $value)
    {
        $this->setIndex($index);
        $this->setValue($value);
    }

    /**
     * @param int $index
     */
    public function setIndex(int $index) : void
    {
        $this->index = $index;
    }

    /**
     * @return int
     */
    public function getIndex() : int
    {
        return $this->index;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value) : void
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue() : string
    {
        return $this->value;
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
        $element = $dom->createElement('job_state');
        $element->setAttribute('idx', $this->getIndex());
        $element->appendChild($dom->createTextNode($this->getValue()));

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
        $index = $element->getAttribute('idx');
        $value = $element->textContent;
        if (empty($value)) {
            throw new JDFException('job_state present but has no value.');
        }

        return self::getOptionByValue($value);
    }

    /**
     * Returns an array of all valid JobStates.
     *
     * @return JobState[] An array of valid JobStates.
     */
    public static function getOptions() : array
    {
        return [
            new Aborted(),
            new Blocked(),
            new ComingUp(),
            new Discarded(),
            new Error(),
            new Finished(),
            new Running(),
            new Waiting()
        ];
    }

    /**
     * Returns the JobState with the matching value.
     *
     * @param string $value The text value.
     * @return null|JobState Returns the JobState with the matching value.
     */
    public static function getOptionByValue(string $value) : ?JobState
    {
        $options = self::getOptions();
        return array_reduce($options, function (?JobState $carry, JobState $item) use ($value) {
            if ($item->getValue() == $value) {
                return $item;
            }

            return $carry;
        });
    }

    /**
     * @param int $index
     * @return null|JobState
     */
    public static function getOptionByIndex(int $index) : ?JobState
    {
        $options = self::getOptions();
        return array_reduce($options, function (?JobState $carry, JobState $item) use ($index) {
            if ($item->getIndex() == $index) {
                return $item;
            }

            return $carry;
        });
    }/** @noinspection PhpMissingParentCallCommonInspection */
}
