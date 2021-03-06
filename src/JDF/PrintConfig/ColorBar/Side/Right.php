<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\ColorBar\Side\Right class.
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
class Right extends SideOption
{
    /**
     * Page constructor.
     */
    public function __construct()
    {
        parent::__construct('RIGHT', 2);
    }
}
