<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\Image\Orient\Horizontal
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\Image\Orient;

/**
 * Vertical (portrait) orientation
 *
 * @package RWC\Caldera\JDF\PrintConfig\Image\Orient
 */
class Horizontal extends OrientOption
{
    /**
     * Auto constructor.
     */
    public function __construct()
    {
        parent::__construct('HORIZONTAL', 2);
    }
}
