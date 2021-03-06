<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\PrintGab\Orient\Vertical class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\PrintGab\Orient;

/**
 * Portrait orientation.
 *
 * @package RWC\Caldera\JDF\PrintConfig\PrintGab\Orient
 */
class Vertical extends OrientOption
{
    /**
     * Vertical constructor.
     */
    public function __construct()
    {
        parent::__construct('VERTICAL', 1);
    }
}
