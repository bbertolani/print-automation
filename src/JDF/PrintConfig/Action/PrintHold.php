<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\Action\PrintHold class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\Action;

/**
 * Print and hold. (undocumented)
 *
 * @package RWC\Caldera\JDF\PrintConfig\Action
 */
class PrintHold extends ActionOption
{
    /**
     * PrintHold Constructor
     */
    public function __construct()
    {
        parent::__construct('PRINT_HOLD', 1);
    }
}