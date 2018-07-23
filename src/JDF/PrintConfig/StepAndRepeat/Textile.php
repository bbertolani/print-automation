<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\StepAndRepeat\Textile
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\StepAndRepeat;

/**
 * Textile step and repeat.
 *
 * @package RWC\Caldera\JDF\PrintConfig\StepAndRepeat
 */
class Textile extends TypeOption
{
    /**
     * Standard constructor.
     */
    public function __construct()
    {
        parent::__construct('TEXTILE', 1);
    }
}
