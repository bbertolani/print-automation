<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\MarkSetup\Custom
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF\PrintConfig\MarkSetup;

/**
 * CompBlack
 *
 * @package RWC\Caldera\JDF\PrintConfig\Image\Orient
 */
class Custom extends ColorTypeOption
{
    /**
     * Auto constructor.
     */
    public function __construct()
    {
        /** @noinspection SpellCheckingInspection */
        parent::__construct('CUSTOM', 2);
    }
}
