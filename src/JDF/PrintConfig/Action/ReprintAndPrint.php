<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\Action\ReprintAndPrint class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace PF\Caldera\JDF\PrintConfig\Action;

/**
 * Print and keep ripped files
 *
 * @package RWC\Caldera\JDF\PrintConfig\Action
 */
class ReprintAndPrint extends ActionOption
{
    /**
     * Reprint constructor.
     */
    public function __construct()
    {
        parent::__construct('REPRINT_AND_PRINT', 5);
    }
}