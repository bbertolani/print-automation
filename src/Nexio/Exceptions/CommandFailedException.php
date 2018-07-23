<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\Nexio\Exceptions\CommandFailedException class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */


namespace RWC\Caldera\Nexio\Exceptions;

use RWC\Caldera\JMF\JMFResponse;
use RWC\Caldera\Nexio\NexioException as NexioException;
use Throwable;

/**
 * Class CommandFailedException
 * @package RWC\Caldera\Nexio\Exceptions
 */
class CommandFailedException extends NexioException
{
    /**
     * The JMF Response for the failed message.
     *
     * @var JMFResponse
     */
    protected $response;

    /**
     * @param JMFResponse $response The JMFResponse
     * @param string $message The error message.
     * @param int $code The error code.
     * @param Throwable|null $previous The previous error.
     */
    public function __construct(
        JMFResponse $response,
        $message = "",
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->setResponse($response);
    }
    /**
     * Returns the JMF Response containing the failure details.
     *
     * @return JMFResponse Returns the JMF Response containing the failure details.
     */
    public function getResponse(): JMFResponse
    {
        return $this->response;
    }

    /**
     * Sets the JMF Response containing the failure details.
     *
     * @param JMFResponse $response the JMF Response containing the failure details.
     */
    public function setResponse(JMFResponse $response): void
    {
        $this->response = $response;
    }

    /**
     * Creates and returns an appropriate CommandFailedException or child
     * Exception based on the erroneous JMF response provided.
     *
     * @param JMFResponse $response The JMF Response object.
     *
     * @return CommandFailedException Returns a CommandFailedException.
     */
    public static function fromJMFResponse(JMFResponse $response) : CommandFailedException
    {
        $notification = $response->getResponse()->getNotification();
        $message = '';
        $code = $response->getResponse()->getReturnCode();
        $previous = null;
        if ($notification != null) {
            $message = $notification->getComment();
            if ($message == 'Job with specified ID already exists') {
                return new JobExistsException($response, $message, $code, $previous);
            }
        }

        // Unknown command failure.
        return new CommandFailedException($response, $message, $code, $previous);
    }
}
