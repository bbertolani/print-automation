<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\Commands\QueueEntryDef class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JMF\Commands;

use RWC\Caldera\JMF\IJMFComponent;
use RWC\Caldera\JMF\JMFException;

/**
 * Defines a queue definition filter.
 *
 * @package RWC\Caldera\JMF\Commands
 */
class QueueEntryDef implements IJMFComponent
{
    /**
     * The unique id of the queue entry.
     *
     * @var string|null
     */
    protected $queueEntryId;

    /**
     * QueueEntryDef constructor.
     *
     * @param null|string $queueEntryId The unique id of the queue entry.
     */
    public function __construct(?string $queueEntryId)
    {
        $this->queueEntryId = $queueEntryId;
    }

    /**
     * Returns the unique id of the queue entry.
     *
     * @return null|string Returns the unique id of the queue entry.
     */
    public function getQueueEntryId(): ?string
    {
        return $this->queueEntryId;
    }

    /**
     * Sets the unique id of the queue entry.
     *
     * @param null|string $queueEntryId The unique id of the queue entry.
     */
    public function setQueueEntryId(?string $queueEntryId): void
    {
        $this->queueEntryId = $queueEntryId;
    }


    /**
     * Returns a DOMElement containing the JMF for the QueueSubmissionParams.
     *
     * @param \DOMDocument $domDocument The DOMDocument used to generate the element.
     *
     * @return \DOMElement Returns the generated element.
     */
    public function getJmf(\DOMDocument $domDocument) : \DOMElement
    {
        $command = $domDocument->createElement('QueueEntryDef');

        if (! empty($this->getQueueEntryId())) {
            $command->setAttribute('QueueEntryID', $this->getQueueEntryId());
        }

        return $command;
    }

    /**
     * Converts the given DOMElement into the IJMFComponent type.
     *
     * @param \DOMElement $element The DOMElement to convert.
     * @return IJMFComponent Returns the converted IJMFComponent type.
     * @throws JMFException If a conversion error occurs.
     */
    public static function fromJMF(\DOMElement $element): IJMFComponent
    {
        if (! $element->tagName == 'QueueEntryDef') {
            throw new JMFException(
                'Not a QueueEntryDef element'
            );
        }

        $queueEntryId = $element->hasAttribute('QueueEntryID') ?
            $element->getAttribute('QueueEntryID') : null;

        return new QueueEntryDef($queueEntryId);
    }
}
