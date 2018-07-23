<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\LogoAnnotation\Left
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF\PrintConfig\LogoAnnotation;

/**
 * Automatic orientation
 *
 * @package RWC\Caldera\JDF\PrintConfig\Image\Orient
 */
class Left extends LogoAnnotationPositionOption
{
    /**
     * Left constructor.
     */
    public function __construct()
    {
        parent::__construct('LEFT', 0);
    }
}
