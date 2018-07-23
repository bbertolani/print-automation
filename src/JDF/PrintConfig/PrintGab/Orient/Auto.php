<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\PrintGab\Orient\Auto class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\PrintGab\Orient;

/**
 * Automatic orientation.
 *
 * @package RWC\Caldera\JDF\PrintConfig\PrintGab\Orient
 */
class Auto extends OrientOption
{
    /**
     * Auto constructor.
     */
    public function __construct()
    {
        parent::__construct('AUTO', 0);
    }
}
