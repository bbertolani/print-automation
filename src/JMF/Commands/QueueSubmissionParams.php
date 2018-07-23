<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\Commands\SubmitQueueEntryParams class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JMF\Commands;

use RWC\Caldera\JMF\IJMFComponent;
use RWC\Caldera\JMF\JMFException;

/**
 * QueueSubmissionParams provides parameters for a SubmitQueueEntry Command.
 *
 * The QueueSubmissionParams block specifies the URL of the JDF job definition
 * which will be submitted to Caldera, as well as the return JDF and return JMF
 * URLs if the workflow chooses to use them. In addition it provides several
 * other useful submission parameters including GangName and GangPolicy.
 *
 * @package RWC\Caldera\Commands
 */
class QueueSubmissionParams implements IJMFComponent
{
    /** @noinspection PhpPropertyNamingConventionInspection */
    /**
     * The URL of the JDF job definition.
     *
     * @var string
     */
    protected $jobUrl;

    /**
     * The Return JDF URL.
     *
     * @var string|null
     */
    protected $returnUrl;

    /**
     * The ReturnJMF URL.
     *
     * @var string|null
     */
    protected $returnJmf;

    /**
     * The RefID
     *
     * @var string|null
     */
    protected $refId;
    /**
     * The Hold flag
     *
     * @var bool|null
     */
    protected $hold;

    /**
     * The GangName
     *
     * @var string|null
     */
    protected $gangName;

    /**
     * The GangPolicy
     *
     * @var string|null
     */
    protected $gangPolicy;

    /**
     * Creates a new QueueSubmissionParams.
     *
     * @param string $url The URL of the JDF job definition.
     * @param null|string $returnUrl The JDF return URL.
     * @param null|string $returnJmf The JMF return URL.
     * @param null|string $refId The reference id.
     * @param bool|null $hold The hold flag.
     * @param null|string $gangName The gang name.
     * @param null|string $gangPolicy The ganging policy.
     */
    public function __construct(
        string $url,
        ?string $returnUrl = null,
        ?string $returnJmf = null,
        ?string $refId = null,
        ?bool $hold = null,
        ?string $gangName = null,
        ?string $gangPolicy = null
    ) {

        $this->setJobUrl($url);
        $this->setReturnUrl($returnUrl);
        $this->setReturnJmf($returnJmf);
        $this->setRefId($refId);
        $this->setHold($hold);
        $this->setGangName($gangName);
        $this->setGangPolicy($gangPolicy);
    }

    /**
     * Sets the JMF URL.
     *
     * URL of the JDF file. “file://”, “http://” or “https://”
     *
     * @param string $jobUrl The JMF URL
     */
    public function setJobUrl(string $jobUrl) : void
    {
        $this->jobUrl = $jobUrl;
    }

    /**
     * Returns the JDF URL.
     *
     * @return string Returns the JMF URL.
     */
    public function getJobUrl() : string
    {
        return $this->jobUrl;
    }

    /**
     * Sets the Return URL.
     *
     * URL where to send the JDF file after the job is completed or aborted.
     * The URL must support directly JDF input (no JMF). Must be explicit URL
     * if file://
     *
     * @param null|string $returnUrl
     */
    public function setReturnUrl(?string $returnUrl = null) : void
    {
        $this->returnUrl = $returnUrl;
    }

    /**
     * Returns the Return URL.
     *
     * @return null|string Returns the Return URL.
     */
    public function getReturnUrl() : ?string
    {
        return $this->returnUrl;
    }

    /**
     * Sets the ReturnJMF URL.
     *
     * URL where to send ReturnQueueEntry command after the job is completed or
     * aborted. The URL must accept a MIME package with both JMF command and JDF
     * ticket referenced by “cid” URL scheme. See “Job submission scenarios”
     * later in the doc. (Added in Caldera 11.1)
     *
     * @param null|string $returnJmf The ReturnJMF URL.
     */
    public function setReturnJmf(?string $returnJmf = null) : void
    {
        $this->returnJmf = $returnJmf;
    }

    /**
     * Returns the ReturnJMF URL.
     *
     * @return null|string Returns the ReturnJMF URL.
     */
    public function getReturnJmf() : ?string
    {
        return $this->returnJmf;
    }

    /**
     * Sets the RefID.
     *
     * If the job submission is triggered by a RequestQueueEntry command, this
     * attribute is REQUIRED and must have the same value as Command/@ID that
     * triggered the job submission.
     *
     * @param null|string $refId The RefID
     */
    public function setRefId(?string $refId = null) : void
    {
        $this->refId = $refId;
    }

    /**
     * Returns the RefId.
     *
     * @return null|string Returns the RefId.
     */
    public function getRefId() : ?string
    {
        return $this->refId;
    }

    /**
     * Sets the Hold flag.
     *
     * “true”: The job is inserted in “Held” status (even if the Bridge is
     * configured to not hold jobs) “false” (default): The job is inserted in
     * ”Waiting” status (if the Bridge is configured to hold jobs
     * automatically, the job is inserted in “Held” status even if Hold=”false”)
     *
     * @param bool|null $hold The hold flag.
     */
    public function setHold(?bool $hold = null) : void
    {
        $this->hold = $hold;
    }

    /**
     * Returns the hold flag.
     *
     * @return bool|null Returns the Hold flag.
     */
    public function getHold() : ?bool
    {
        return $this->hold;
    }

    /**
     * Sets the gang name to which the job belongs. This allows to sort jobs in
     * image bar and to nest them together. Specified value should not contain
     * any space.
     *
     * @param null|string $gangName The GangName.
     */
    public function setGangName(?string $gangName = null) : void
    {
        $this->gangName = $gangName;
    }

    /**
     * Returns the GangName.
     *
     * @return null|string Returns the GangName.
     */
    public function getGangName() : ?string
    {
        return $this->gangName;
    }

    /**
     * Specifies the ganging policy.
     *
     * “Gang”: Add job to the gang specified by GangName. This is default if a
     * GangName is specified. “NoGang”: Ignore the GangName, no ganging is
     * performed. This is the default when no GangName is specified.
     * “GangAndForce”: Currently identical to “Gang”.
     *
     * @param null|string $gangPolicy The GangPolicy.
     * @throws \InvalidArgumentException if an invalid gang policy is specified.
     */
    public function setGangPolicy(?string $gangPolicy = null) : void
    {
        $valid = ['Gang', 'NoGang', 'GangAndForce'];
        if (! (is_null($gangPolicy) || in_array($gangPolicy, $valid))) {
            throw new \InvalidArgumentException("GangPolicy must be one of " .
                implode(', ', $valid));
        }

        $this->gangPolicy = $gangPolicy;
    }

    /**
     * Returns the GangPolicy.
     *
     * @return null|string Returns the GangPolicy.
     */
    public function getGangPolicy() : ?string
    {
        return $this->gangPolicy;
    }

    /**
     * Returns a DOMElement containing the JMF for the QueueSubmissionParams.
     *
     * @param \DOMDocument $domDocument The DOMDocument used to generate the element.
     *
     * @return \DOMElement Returns the generated element.
     */
    public function getJmf(\DOMDocument $domDocument) : \DOMElement
    {
        $command = $domDocument->createElement('QueueSubmissionParams');

        $command->setAttribute('URL', $this->getJobUrl());

        if ($this->getReturnUrl() !== null) {
            $command->setAttribute('ReturnURL', $this->getReturnUrl());
        }

        if ($this->getReturnJmf() !== null) {
            $command->setAttribute('ReturnJMF', $this->getReturnJmf());
        }

        if ($this->getRefId() !== null) {
            $command->setAttribute('refID', $this->getRefId());
        }

        if ($this->getHold() !== null) {
            $command->setAttribute('Hold', ($this->getHold() ? 'true' : 'false'));
        }

        if ($this->getGangName() !== null) {
            $command->setAttribute('GangName', $this->getGangName());
        }

        if ($this->getGangPolicy() !== null) {
            $command->setAttribute('GangPolicy', $this->getGangPolicy());
        }

        return $command;
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
        $jobUrl = $element->getAttribute('URL');
        $returnUrl = $element->getAttribute('ReturnURL');
        $returnJmf = $element->getAttribute('ReturnJMF');
        $refId = $element->getAttribute('refID');
        $hold = strtolower($element->getAttribute('Hold'));
        $gangName = $element->getAttribute('GangName');
        $gangPolicy = $element->getAttribute('GangPolicy');

        // Null out optional, empty attributes
        if (empty($returnUrl)) {
            $returnUrl = null;
        }
        if (empty($returnJmf)) {
            $returnJmf = null;
        }

        if (empty($refId)) {
            $refId = null;
        }

        // Make sure Hold is a value value
        switch ($hold) {
            case '':
                $hold = null;
                break;
            case 'true':
                $hold = true;
                break;
            case 'false':
                $hold = false;
                break;
            default:
                throw new JMFException("Value of Hold attribute was invalid (\"$hold\").");
        }

        if (empty($gangName)) {
            $gangName = null;
        }

        if (empty($gangPolicy)) {
            $gangPolicy = null;
        }

        return new QueueSubmissionParams(
            $jobUrl,
            $returnUrl,
            $returnJmf,
            $refId,
            $hold,
            $gangName,
            $gangPolicy
        );
    }
}
