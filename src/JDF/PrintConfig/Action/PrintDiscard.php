<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\Action\PrintDiscard class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\Action;

/**
 * Print action. Prints then discards (default action).
 *
 * @package RWC\Caldera\JDF\PrintConfig\Action
 */
class PrintDiscard extends ActionOption
{
    /**
     * PrintDiscard constructor.
     */
    public function __construct()
    {
        parent::__construct('PRINT', 0);
    }
}