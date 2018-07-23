<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\ColorBar\Side\Both class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\ColorBar\Side;

/**
 * Left class
 *
 * @package RWC\Caldera\JDF\PrintConfig\ColorBar\Side
 */
class Both extends SideOption
{
    /**
     * Page constructor.
     */
    public function __construct()
    {
        parent::__construct('BOTH', 3);
    }
}
