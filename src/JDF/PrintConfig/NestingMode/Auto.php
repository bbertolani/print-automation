<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\NestingMode\Auto class
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\NestingMode;

/**
 * Auto S&R. Use “nb_copies” to determine automatically values of
 * “nb_copies_sr” and “nb_pages_sr”. Note that the number of printed copies can
 * differ from “nb_copies”.
 *
 * @package RWC\Caldera\JDF\PrintConfig\NestingMode
 */
class Auto extends NestingModeOption
{
    public function __construct()
    {
        /** @noinspection SpellCheckingInspection */
        parent::__construct('METHOD_AUTO', 2);
    }
}
