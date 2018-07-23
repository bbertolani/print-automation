<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\Action\Spool class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\Action;

/**
 * Spool action (undocumented).
 *
 * @package RWC\Caldera\JDF\PrintConfig\PrintGab\Action
 */
class Spool extends ActionOption
{
    /**
     * PrintHold Constructor
     */
    public function __construct()
    {
        parent::__construct('SPOOL', 2);
    }
}