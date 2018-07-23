<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JMF\UnsupportedCommandException interface.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JMF;

/**
 * Thrown when JMF contains an unsupported command type.
 *
 * @package RWC\Caldera\JMF
 */
class UnsupportedCommandException extends JMFException
{
}
