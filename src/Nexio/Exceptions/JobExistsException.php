<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\Nexio\Exceptions\JobExistsException class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\Nexio\Exceptions;

/**
 * An Exception thrown when job submissions fail because a job with the same
 * id already exists in Nexio.
 *
 * @package RWC\Caldera\Nexio\Exceptions
 */
class JobExistsException extends CommandFailedException
{
}
