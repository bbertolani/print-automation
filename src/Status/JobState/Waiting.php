<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\Status\JobState\Waiting class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\Status\JobState;

use RWC\Caldera\Status\JobState;

/**
 * Job it waiting.
 *
 * @package RWC\Caldera\Status\JobState
 */
class Waiting extends JobState
{
    public function __construct()
    {
        parent::__construct(0, 'Waiting');
    }
}
