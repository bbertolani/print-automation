<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\MarkSetup\ColorTypeOption
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF\PrintConfig\MarkSetup;

/**
 * ColorTypeOption
 *
 * @package RWC\Caldera\JDF\PrintConfig\Image\Orient
 */
class PureBlack extends ColorTypeOption
{
    /**
     * Auto constructor.
     */
    public function __construct()
    {
        /** @noinspection SpellCheckingInspection */
        parent::__construct('PUREBLACK', 0);
    }
}
