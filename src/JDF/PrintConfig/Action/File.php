<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\Action\File class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\Action;

/**
 * File action (undocumented)
 *
 * @package RWC\Caldera\JDF\PrintConfig\Action
 */
class File extends ActionOption
{
    /**
     * PrintDiscard constructor.
     */
    public function __construct()
    {
        parent::__construct('FILE', 3);
    }
}