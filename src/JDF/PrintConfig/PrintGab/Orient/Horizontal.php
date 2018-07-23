<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\PrintGab\Orient\Horizontal class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\PrintGab\Orient;

/**
 * Landscape orientation.
 *
 * @package RWC\Caldera\JDF\PrintConfig\PrintGab\Orient
 */
class Horizontal extends OrientOption
{
    /**
     * Horizontal constructor.
     */
    public function __construct()
    {
        parent::__construct('HORIZONTAL', 2);
    }
}
