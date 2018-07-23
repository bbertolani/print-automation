<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\Commands\RemoveQueueEntryParams class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JMF\Commands;

use RWC\Caldera\JMF\IJMFComponent;
use RWC\Caldera\JMF\JMFException;

/**
 * RemoveQueueEntryParams specifies which entries to delete from the Nexio
 * Queue.
 *
 * @package RWC\Caldera\JMF\Commands
 */
class RemoveQueueEntryParams implements IJMFComponent
{
    /**
     * The QueueFilter which tells the command which jobs to remove.
     *
     * @var QueueFilter
     */
    protected $queueFilter;

    /**
     * Creates a RemoveQueueEntryParams.
     *
     * @param QueueFilter $queueFilter
     */
    public function __construct(QueueFilter $queueFilter)
    {
        $this->setQueueFilter($queueFilter);
    }

    /**
     * Returns the QueueFilter which specifies which jobs to delete.
     *
     * @return QueueFilter Returns the QueueFilter.
     */
    public function getQueueFilter(): QueueFilter
    {
        return $this->queueFilter;
    }

    /**
     * Sets the QueueFilter which specifies which jobs to delete.
     *
     * @param QueueFilter $queueFilter The QueueFilter.
     */
    public function setQueueFilter(QueueFilter $queueFilter): void
    {
        $this->queueFilter = $queueFilter;
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
        $command = $domDocument->createElement('RemoveQueueEntryParams');
        $command->appendChild($this->getQueueFilter()->getJmf($domDocument));

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
        $queueFilterElements = $element->getElementsByTagName('QueueFilter');

        if (count($queueFilterElements) == 0) {
            throw new JMFException(
                'Required sub-element QueueFilter not present.'
            );
        }

        /** @var $queueFilter QueueFilter */
        $queueFilter = QueueFilter::fromJMF($queueFilterElements[0]);

        return new RemoveQueueEntryParams($queueFilter);
    }
}
