<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\NestingMode\NoStepAndRepeat
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\NestingMode;

/**
 * NoStepAndRepeat nesting mode option. Unused since 9.10.
 *
 * @package RWC\Caldera\JDF\PrintConfig\NestingMode
 */
class NoStepAndRepeat extends NestingModeOption
{
    public function __construct()
    {
        /** @noinspection SpellCheckingInspection */
        parent::__construct('METHOD_NOSR', 0);
    }
}
