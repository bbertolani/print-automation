<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\TimeFormatter class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera;

/**
 * Formats timestamps in the format expected by Caldera.
 *
 * @package RWC\Caldera
 */
class TimeFormatter
{
    /**
     * Returns the specified timestamp in the time format expected by Caldera.
     *
     * @param int $timestamp The timestamp to format.
     *
     * @return string Returns the formatted timestamp.
     */
    public function format(int $timestamp) : string
    {
        return date('Ymd\TH:i:s\Z', $timestamp);
    }
}
