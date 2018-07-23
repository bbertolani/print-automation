<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\Image\Orient\DefaultOrient
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\Image\Orient;

/**
 * Default (no rotation)
 *
 * @package RWC\Caldera\JDF\PrintConfig\Image\Orient
 */
class DefaultOrient extends OrientOption
{
    /**
     * Auto constructor.
     */
    public function __construct()
    {
        parent::__construct('DEFAULT', 3);
    }
}
