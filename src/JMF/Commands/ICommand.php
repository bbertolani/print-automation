<?php
declare(strict_types=1);

namespace RWC\Caldera\JMF\Commands;

use RWC\Caldera\JMF\IJMFComponent;

/**
 * Interface for JMF commands such as SubmitQueueEntry.
 *
 * @package RWC\Caldera
 */
interface ICommand extends IJMFComponent
{
    /**
     * Sets the unique id of the command.
     *
     * @param string $id The unique id of the command.
     */
    public function setCommandId(string $id) : void;

    /**
     * Returns the unique id of the command.
     *
     * @return string Returns the unique id of the command.
     */
    public function getCommandId() : string;
}
