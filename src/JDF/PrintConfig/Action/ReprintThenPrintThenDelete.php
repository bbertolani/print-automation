<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\Action\ReprintThenPrintThenDelete class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\Action;

/**
 * Rip then print then delete ripped file
 *
 * @package RWC\Caldera\JDF\PrintConfig\Action
 */
class ReprintThenPrintThenDelete extends ActionOption
{
    /**
     * Reprint constructor.
     */
    public function __construct()
    {
        parent::__construct('REPRINT_THEN_PRINT_THEN_DELETE', 7);
    }
}