<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\Status\JobState\Blocked class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\Status\JobState;

use RWC\Caldera\Status\JobState;

/**
 * Job has been blocked.
 *
 * @package RWC\Caldera\Status\JobState
 */
class Blocked extends JobState
{
    public function __construct()
    {
        parent::__construct(2, 'Blocked');
    }
}
