<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JMFMessage class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\Nexio;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use RWC\Caldera\JMF\JMFException;
use RWC\Caldera\JMF\JMFMessage;
use GuzzleHttp\Client as HttpClient;
use RWC\Caldera\JMF\JMFResponse;
use RWC\Caldera\JMF\ReturnCode;
use RWC\Caldera\Nexio\Exceptions\CommandFailedException;
use RWC\Caldera\Nexio\Exceptions\CommunicationsNexioException;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Nexio Bridge client.
 *
 * @package RWC\Caldera\Nexio
 */
class Client
{
    use LoggerAwareTrait;

    /**
     * URL to Nexio bridge.
     *
     * @var string
     */
    protected $nexioUrl;

    /**
     * Guzzle Http client.
     *
     * @var HttpClient
     */
    protected $client;

    /**
     * Client constructor.
     * @param string $url
     * @param HttpClient|null $client
     * @param null|LoggerInterface $logger
     */
    public function __construct(string $url, HttpClient $client = null, ?LoggerInterface $logger = null)
    {
        $logger = $logger ?? new NullLogger();

        $this->setLogger($logger);
        $this->setNexioUrl($url);
        $this->setClient($client);
    }

    /**
     * @param string $nexioUrl
     */
    public function setNexioUrl(string $nexioUrl) : void
    {
        $this->nexioUrl = $nexioUrl;
    }

    /**
     * @return string
     */
    public function getNexioUrl() : string
    {
        return $this->nexioUrl;
    }

    /**
     * @param HttpClient|null $client
     */
    public function setClient(?HttpClient $client = null)
    {
        $client = $client ?? new HttpClient();
        $this->client = $client;
    }

    /**
     * @return HttpClient
     */
    public function getClient() : HttpClient
    {
        return $this->client;
    }

    /**
     * @param JMFMessage $message
     * @return JMFResponse
     * @throws NexioException if communication with Nexio fails
     * @throws CommandFailedException if the Command fails
     */
    public function send(JMFMessage $message) : JMFResponse
    {
        $type     = get_class($message->getCommand());
        $nexioUrl = $this->getNexioUrl();

        try {
            $this->logger->info(
                "Sending $type command to Nexio at $nexioUrl"
            );

            $response = $this->getClient()->post(
                $nexioUrl,
                [
                    'body' => $message->getJMFString(),
                    'headers' => [
                        'Content-Type' => 'application/xml'
                    ]
                ]
            );

            $body     = (string) $response->getBody();

            $this->logger->debug('Raw Response: ' . $body);

            $response = JMFResponse::fromJMFString((string) $response->getBody());
            $returnCode = $response->getResponse()->getReturnCode();

            // Did Nexio-level error occur?
            if ($returnCode != ReturnCode::SUCCESS) {
                throw CommandFailedException::fromJMFResponse($response);
            }

            return $response;
        } catch (JMFException $jmfException) {
            throw new CommunicationsNexioException(
                "Failed to convert the JMFMessage to JMF XML:" .
                $jmfException->getMessage(),
                0,
                $jmfException
            );
        } catch (ServerException $serverException) {
            throw new CommunicationsNexioException(
                "An HTTP error occurred while sending a $type command " .
                "to Nexio at $nexioUrl: " . $serverException->getMessage(),
                0,
                $serverException
            );
        } catch (RequestException $requestException) {
            throw new CommunicationsNexioException(
                'Failed to make the request to Nexio: ' .
                $requestException->getMessage(),
                0,
                $requestException
            );
        }
    }
}
