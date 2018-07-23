<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\LogoAnnotation\Above
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF\PrintConfig\LogoAnnotation;

/**
 * Above orientation
 *
 * @package RWC\Caldera\JDF\PrintConfig\Image\Orient
 */
class Above extends LogoAnnotationPositionOption
{
    /**
     * Left constructor.
     */
    public function __construct()
    {
        parent::__construct('ABOVE', 1);
    }
}
