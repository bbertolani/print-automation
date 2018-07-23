<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\Image\Orient\Rotate180 class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\Image\Orient;

/**
 * Rotate 90 Degrees
 *
 * @package RWC\Caldera\JDF\PrintConfig\Image\Orient
 */
class Rotate180 extends OrientOption
{
    /**
     * Auto constructor.
     */
    public function __construct()
    {
        parent::__construct('_180', 5);
    }
}
