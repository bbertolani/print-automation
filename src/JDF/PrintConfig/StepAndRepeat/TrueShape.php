<?php
/** @noinspection SpellCheckingInspection */
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\StepAndRepeat\TrueShape
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\StepAndRepeat;

/**
 * TrueShape step and repeat.  Contour nesting.
 *
 * @package RWC\Caldera\JDF\PrintConfig\StepAndRepeat
 */
class TrueShape extends TypeOption
{
    /**
     * Standard constructor.
     */
    public function __construct()
    {
        parent::__construct('TRUESHAPE', 2);
    }
}
