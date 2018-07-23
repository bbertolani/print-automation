<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JMF\Response class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JMF;

/**
 * Class Response
 * @package RWC\Caldera\JMF
 */
class Response implements IJMFComponent
{
    /**
     * @var string
     */
    protected $responseId;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    protected $returnCode;

    /**
     * @var string
     */
    protected $refId;

    /**
     * @var Notification|null
     */
    protected $notification;

    /**
     * Response constructor.
     * @param string $responseId
     * @param string $type
     * @param string $refId
     * @param int $returnCode
     * @param null|Notification $notification
     */
    public function __construct(
        string $responseId,
        string $type,
        string $refId,
        int $returnCode,
        ?Notification $notification = null
    ) {
        $this->setResponseId($responseId);
        $this->setType($type);
        $this->setRefId($refId);
        $this->setReturnCode($returnCode);
        $this->setNotification($notification);
    }

    /**
     * @param null|Notification $notification
     */
    public function setNotification(?Notification $notification = null) : void
    {
        $this->notification = $notification;
    }

    /**
     * @return null|Notification
     */
    public function getNotification() : ?Notification
    {
        return $this->notification;
    }

    /**
     * @param string $responseId
     */
    public function setResponseId(string $responseId) : void
    {
        $this->responseId = $responseId;
    }

    /**
     * @return string
     */
    public function getResponseId() : string
    {
        return $this->responseId;
    }

    /**
     * @param string $type
     */
    public function setType(string $type) : void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }

    /**
     * @param int $returnCode
     */
    public function setReturnCode(int $returnCode) : void
    {
        $this->returnCode = $returnCode;
    }

    /**
     * @return int
     */
    public function getReturnCode() : int
    {
        return $this->returnCode;
    }

    /**
     * @return string
     */
    public function getRefId() : string
    {
        return $this->refId;
    }

    /**
     * @param string $refId
     */
    public function setRefId(string $refId) : void
    {
        $this->refId = $refId;
    }
    /**
     * Converts the IJMFComponent into a DOMElement for inclusion in a JMF Document.
     *
     * @param \DOMDocument $document The DOMDocument used to create the element.
     * @return \DOMElement Returns the converted element.
     */
    public function getJMF(\DOMDocument $document): \DOMElement
    {
        $responseEl = $document->createElement('Response');
        $responseEl->setAttribute('refID', $this->getRefId());
        $responseEl->setAttribute('ID', $this->getResponseId());
        $responseEl->setAttribute('Type', $this->getType());
        $responseEl->setAttribute('ReturnCode', (string) $this->getReturnCode());

        if ($this->getNotification() !== null) {
            $responseEl->appendChild($this->getNotification()->getJMF($document));
        }

        return $responseEl;
    }

    /**
     * Converts the given DOMElement into the IJMFComponent type.
     *
     * @param \DOMElement $element The DOMElement to convert.
     * @return IJMFComponent Returns the converted IJMFComponent type.
     * @throws JMFException If a conversion error occurs.
     */
    public static function fromJMF(\DOMElement $element): IJMFComponent
    {
        $refId = $element->getAttribute('refID');
        $responseId = $element->getAttribute('ID');
        $type = $element->getAttribute('Type');
        $returnCode = $element->getAttribute('ReturnCode');
        $notificationEl = $element->getElementsByTagName('Notification');

        if (empty($refId)) {
            throw new JMFException('Required attribute "refID" not found.');
        }

        if (empty($responseId)) {
            throw new JMFException('Required attribute "responseId" not found.');
        }

        if (empty($type)) {
            throw new JMFException('Required attribute "Type" not found.');
        }

        // Don't test for empty because ReturnCode can be 0, which empty() considers empty!
        if ('' == $returnCode) {
            throw new JMFException('Required attribute "ReturnCode" not found.');
        }
        $notification = null;

        if ($notificationEl->length > 0) {
            $notification = Notification::fromJMF($notificationEl[0]);
        }

        return new Response(
            $responseId,
            $type,
            $refId,
            (int) $returnCode,
            $notification
        );
    }
}
