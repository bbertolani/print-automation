<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\Action\Reprint class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\Action;

/**
 * Reprint (rip)
 *
 * @package RWC\Caldera\JDF\PrintConfig\Action
 */
class Reprint extends ActionOption
{
    /**
     * Reprint constructor.
     */
    public function __construct()
    {
        parent::__construct('REPRINT', 4);
    }
}