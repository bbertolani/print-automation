<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\StepAndRepeat\Standard
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\StepAndRepeat;

/**
 * Standard step and repeat.
 *
 * @package RWC\Caldera\JDF\PrintConfig\StepAndRepeat
 */
class Standard extends TypeOption
{
    /**
     * Standard constructor.
     */
    public function __construct()
    {
        parent::__construct('STANDARD', 0);
    }
}
