<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\Status\JobState\Discarded class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\Status\JobState;

use RWC\Caldera\Status\JobState;

/**
 * Job has been aborted
 *
 * @package RWC\Caldera\Status\JobState
 */
class Discarded extends JobState
{
    public function __construct()
    {
        parent::__construct(7, 'Finished');
    }
}
