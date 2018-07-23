<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\ColorBar\Placement\Page class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\ColorBar\Placement;

/**
 * Page place option.
 *
 * @package RWC\Caldera\JDF\PrintConfig\ColorBar\Placement
 */
class Page extends PlacementOption
{
    /**
     * Page constructor.
     */
    public function __construct()
    {
        parent::__construct('PAGE', 0);
    }
}
