<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JMF\ReturnCode class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JMF;

/**
 * Class ReturnCode
 * @package RWC\Caldera\JMF
 */
class ReturnCode
{
    const SUCCESS = 0;
    const GENERAL_ERROR = 1;
    const INTERNAL_ERROR = 2;
    const XML_PARSE_ERROR = 3;
    const COMMAND_NOT_IMPLEMENTED =5;
    const INVALID_PARAMS = 6;
    const INSUFFICIENT_PARAMS = 7;
    const NO_EXECUTABLE_NODES = 102;
    const UNKNOWN_QUEUE_ENTRY = 105;
    const FAILED_ENTRY_IS_RUNNING = 106;
    const FAILED_JOB_IN_REQUIRED_STATE = 113;
    const FAILED_JOB_IN_FINAL_STATE = 114;
    const URL_UNRESOLVED = 120;

    /**
     * Returns true if the specified return code is valid.
     *
     * @param int $code The return code to check.
     *
     * @return bool Returns true if the specified return code is valid.
     */
    public static function isValid(int $code)
    {
        $valid = [
            self::SUCCESS,
            self::GENERAL_ERROR,
            self::INTERNAL_ERROR,
            self::XML_PARSE_ERROR,
            self::COMMAND_NOT_IMPLEMENTED,
            self::NO_EXECUTABLE_NODES,
            self::INVALID_PARAMS,
            self::INSUFFICIENT_PARAMS,
            self::UNKNOWN_QUEUE_ENTRY,
            self::FAILED_ENTRY_IS_RUNNING,
            self::FAILED_JOB_IN_REQUIRED_STATE,
            self::FAILED_JOB_IN_FINAL_STATE,
            self::URL_UNRESOLVED
        ];

        return in_array($code, $valid);
    }

    /**
     * Returns a descriptive message for the specified return code.
     *
     * @param int $code The return code.
     * @return string Returns a description of the return code.
     */
    public static function getMessage(int $code) : string
    {
        if (! self::isValid($code)) {
            return "Invalid response code specified";
        }

        $valid = [
            self::SUCCESS => 'Request successful',
            self::GENERAL_ERROR => 'General error',
            self::INTERNAL_ERROR => 'Internal error',
            self::XML_PARSE_ERROR => 'Request could not be parsed as valid JDF/JMF',
            self::COMMAND_NOT_IMPLEMENTED => 'Requested command not implemented by Nexio',
            self::INVALID_PARAMS => 'Request provided invalid parameters',
            self::NO_EXECUTABLE_NODES => 'No runnable jobs found in JMF',
            self::INSUFFICIENT_PARAMS => 'Request provided insufficient parameters',
            self::UNKNOWN_QUEUE_ENTRY => 'An unknown queue entry was specified',
            self::FAILED_ENTRY_IS_RUNNING => 'Request cannot be completed because the requested entry is running',
            self::FAILED_JOB_IN_REQUIRED_STATE => 'Request cannot be completed ' .
                'because the job is in a state that cannot be changed',
            self::FAILED_JOB_IN_FINAL_STATE => 'Request cannot be completed ' .
                'because the requested job is in a finished state (pending return, completed, or aborted',
            self::URL_UNRESOLVED => 'Request cannot be completed because it specified an unresolvable URL'
        ];

        return $valid[$code];
    }
}
