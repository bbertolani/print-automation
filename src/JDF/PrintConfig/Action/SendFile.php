<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\PrintConfig\Action\SendFile class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\PrintConfig\Action;

/**
 * Undocumented
 *
 * @package RWC\Caldera\JDF\PrintConfig\Action
 */
class SendFile extends ActionOption
{
    /**
     * SendFile constructor.
     */
    public function __construct()
    {
        parent::__construct('SENDFILE', 9);
    }
}