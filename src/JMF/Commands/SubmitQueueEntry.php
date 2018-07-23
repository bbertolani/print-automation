<?php
declare(strict_types=1);

/**
* This file contains the RWC\Caldera\Commands\SubmitQueueEntry class.
*
* @author Brian Reich <breich@reich-consulting.net>
* @copyright Copyright (C) 2018 PrintFrog
* @license Proprietary
*/

namespace RWC\Caldera\JMF\Commands;

use RWC\Caldera\JMF\IJMFComponent;
use RWC\Caldera\JMF\JMFException;

/**
 * Command that submits a job request to the JMF workflow.
 *
 * @package RWC\Caldera\Commands
 */
class SubmitQueueEntry implements ICommand
{
    /**
     * @var string
     */
    protected $commandId;

    /**
     * @var QueueSubmissionParams
     */
    protected $queueSubmissionParams;

    /**
     * SubmitQueueEntry constructor.
     * @param QueueSubmissionParams $params
     * @param null|string $commandId
     */
    public function __construct(QueueSubmissionParams $params, ?string $commandId = null)
    {
        $commandId = $commandId ?? strtoupper(uniqid('C'));
        $this->setCommandId($commandId);
        $this->setQueueSubmissionParams($params);
    }

    /**
     * @param QueueSubmissionParams $params
     */
    public function setQueueSubmissionParams(QueueSubmissionParams $params) : void
    {
        $this->queueSubmissionParams = $params;
    }

    /**
     * @return QueueSubmissionParams
     */
    public function getQueueSubmissionParams() : QueueSubmissionParams
    {
        return $this->queueSubmissionParams;
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
        $command->setAttribute('Type', 'SubmitQueueEntry');
        $command->appendChild($this->getQueueSubmissionParams()->getJmf($domDocument));

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

        $submitParamsEl = $element->getElementsByTagName('QueueSubmissionParams');
        if ($submitParamsEl->length == 0) {
            throw new JMFException('SubmitQueueEntry contained no QueueSubmissionParams');
        }

        /**
         * @var $submitParams QueueSubmissionParams
         */
        $submitParams = QueueSubmissionParams::fromJMF($submitParamsEl[0]);
        return new SubmitQueueEntry($submitParams, $commandId);
    }
}
