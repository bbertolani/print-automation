<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\NestingMode\Custom class
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\NestingMode;

/**
 * Manual S&R. Use “nb_copies_sr” and “nb_pages_sr”
 *
 * @package RWC\Caldera\JDF\PrintConfig\NestingMode
 */
class Custom extends NestingModeOption
{
    public function __construct()
    {
        /** @noinspection SpellCheckingInspection */
        parent::__construct('METHOD_CUSTOM  ', 3);
    }
}
