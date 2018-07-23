<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\NestingMode\FullStepAndRepeat class
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\NestingMode;

/**
 * Full Step & Repeat nesting mode option.
 *
 * @package RWC\Caldera\JDF\PrintConfig\NestingMode
 */
class FullStepAndRepeat extends NestingModeOption
{
    public function __construct()
    {
        /** @noinspection SpellCheckingInspection */
        parent::__construct('METHOD_FULLSR', 1);
    }
}
