<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\ColorBar\Placement\Image class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\ColorBar\Placement;

/**
 * Image place option.
 *
 * @package RWC\Caldera\JDF\PrintConfig\ColorBar\Placement
 */
class Image extends PlacementOption
{
    /**
     * Page constructor.
     */
    public function __construct()
    {
        parent::__construct('IMAGE', 1);
    }
}
