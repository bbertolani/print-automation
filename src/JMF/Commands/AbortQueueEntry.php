<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JMF\Commands\AbortQueueEntry interface.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JMF\Commands;

use RWC\Caldera\JMF\IJMFComponent;
use RWC\Caldera\JMF\JMFException;

/**
 * A command for aborting print jobs.
 *
 * @package RWC\Caldera\JMF\Commands
 */
class AbortQueueEntry implements ICommand
{
    /**
     * @var string
     */
    protected $commandId;

    /**
     * The queue entry removal parameters.
     *
     * @var AbortQueueEntryParams
     */
    protected $abortQueueEntryParams;

    /**
     * @return AbortQueueEntryParams
     */
    public function getAbortQueueEntryParams(): AbortQueueEntryParams
    {
        return $this->abortQueueEntryParams;
    }

    /**
     * @param AbortQueueEntryParams $abortQueueEntryParams
     */
    public function setAbortQueueEntryParams(AbortQueueEntryParams $abortQueueEntryParams): void
    {
        $this->abortQueueEntryParams = $abortQueueEntryParams;
    }

    /**
     * RemoveQueueEntry constructor.
     * @param AbortQueueEntryParams $params
     * @param null|string $commandId
     */
    public function __construct(AbortQueueEntryParams $params, ?string $commandId = null)
    {
        $commandId = $commandId ?? strtoupper(uniqid('C'));
        $this->setCommandId($commandId);
        $this->setAbortQueueEntryParams($params);
    }

    /**
     * Sets the id of the command.
     *
     * @param string $commandId The id of the command.
     */
    public function setCommandId(string $commandId) : void
    {
        $this->commandId = $commandId;
    }

    /**
     * Returns the id of the command.
     *
     * @return string Returns the id of the command.
     */
    public function getCommandId() : string
    {
        return $this->commandId;
    }

    /**
     * Returns a DOMElement that provides the Command XML.
     *
     * @param \DOMDocument $domDocument The document used to create the command.
     *
     * @return \DOMElement Returns the generated Command as a DOMElement.
     */
    public function getJMF(\DOMDocument $domDocument): \DOMElement
    {
        $command = $domDocument->createElement('Command');
        $command->setAttribute('ID', $this->getCommandId());
        $command->setAttribute('Type', 'AbortQueueEntry');
        $command->appendChild($this->getAbortQueueEntryParams()->getJmf($domDocument));

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
        $commandId = $element->getAttribute('ID');
        $type = $element->getAttribute('Type');

        if (empty($commandId)) {
            throw new JMFException('Command ID parameter cannot be empty.');
        }

        if (empty($type)) {
            throw new JMFException('Command Type parameter cannot be empty.');
        }

        $removeParamsEl = $element->getElementsByTagName('RemoveQueueEntryParams');
        if ($removeParamsEl->length == 0) {
            throw new JMFException(
                'RemoveQueueEntry contained no RemoveQueueEntryParams'
            );
        }

        /**
         * @var $params RemoveQueueEntryParams
         */
        $params = RemoveQueueEntryParams::fromJMF($removeParamsEl[0]);

        return new RemoveQueueEntry($params, $commandId);
    }

    /**
     * Creates and returns a RemoveQueueEntry command to delete a job with
     * a specifid JobID attribute.
     *
     * @param string $jobId The id of the job to delete.
     * @return RemoveQueueEntry Returns the RemoveQueueEntry command.
     */
    public static function createRemoveByJobId(string $jobId) : RemoveQueueEntry
    {
        return new RemoveQueueEntry(
            new RemoveQueueEntryParams(
                new QueueFilter('Full', $jobId)
            )
        );
    }
}
