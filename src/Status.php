<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\Status class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera;

use RWC\Caldera\JDF\JDFException;
use RWC\Caldera\Status\Contents;
use RWC\Caldera\Status\JobState;
use RWC\Caldera\Status\InkCons;

/**
 * Class Status
 * @package RWC\Caldera\JDF
 */
class Status extends AbstractJDFComponent implements IJDFComponent
{
    protected $jobId;
    protected $jobName;
    protected $jobState;
    protected $jobError;
    protected $numberPrinted;
    protected $createTime;
    protected $beginTime;
    protected $operationEndTime;
    protected $printTime;
    protected $jobMode;
    protected $printWidth;
    protected $printHeight;
    protected $mediaWidth;
    protected $mediaHeight;
    protected $mediaUsageRatio;
    protected $inkCons;
    protected $serverName;
    protected $serverHost;
    protected $fileSpecUrl;

    /**
     * @var Contents
     */
    protected $contents;

    /**
     * Status constructor.
     * @param int $jobId
     * @param string|null $jobName
     * @param JobState $jobState
     * @param int|null $createTime
     * @param string $jobMode
     * @param string $serverName
     * @param string $serverHost
     * @param null|string $jobError
     * @param int|null $numberPrinted
     * @param int|null $beginTime
     * @param int|null $operationEndTime
     * @param int|null $printTime
     * @param float|null $printWidth
     * @param float|null $printHeight
     * @param float|null $mediaWidth
     * @param float|null $mediaHeight
     * @param float|null $mediaUsageRatio
     * @param null|InkCons $inkCons
     * @param null|string $fileSpecUrl
     * @param null|Contents $contents
     */
    public function __construct(
        int $jobId,
        ?string $jobName,
        JobState $jobState,
        ?int $createTime,
        ?string $jobMode,
        ?string $serverName,
        ?string $serverHost,
        ?string $jobError = null,
        ?int $numberPrinted = null,
        ?int $beginTime = null,
        ?int $operationEndTime = null,
        ?int $printTime = null,
        ?float $printWidth = null,
        ?float $printHeight = null,
        ?float $mediaWidth = null,
        ?float $mediaHeight = null,
        ?float $mediaUsageRatio = null,
        ?InkCons $inkCons = null,
        ?string $fileSpecUrl = null,
        ?Contents $contents = null
    ) {
        $this->setJobId($jobId);
        $this->setJobName($jobName);
        $this->setJobState($jobState);
        $this->setCreateTime($createTime);
        $this->setJobMode($jobMode);
        $this->setServerName($serverName);
        $this->setServerHost($serverHost);
        $this->setJobError($jobError);
        $this->setNumberPrinted($numberPrinted);
        $this->setBeginTime($beginTime);
        $this->setOperationEndTime($operationEndTime);
        $this->setPrintTime($printTime);
        $this->setPrintWidth($printWidth);
        $this->setPrintHeight($printHeight);
        $this->setMediaWidth($mediaWidth);
        $this->setMediaHeight($mediaHeight);
        $this->setMediaUsageRatio($mediaUsageRatio);
        $this->setInkCons($inkCons);
        $this->setFileSpecUrl($fileSpecUrl);
    }

    /**
     * Describes the content of the print job.
     *
     * @param null|Contents $contents Describes the content of the print job.s
     */
    public function setContents(?Contents $contents = null) : void
    {
        $this->contents = $contents;
    }

    /**
     * Describes the content of the print job.
     *
     * @return null|Contents Describes the content of the print job.
     */
    public function getContents() : ?Contents
    {
        return $this->contents;
    }

    /**
     * Sets the complete URL to the file to which the status is relative.
     *
     * @param null|string $fileSpecUrl the complete URL to the file to which the status is relative.
     */
    public function setFileSpecUrl(?string $fileSpecUrl) : void
    {
        $this->fileSpecUrl = $fileSpecUrl;
    }

    /**
     * Returns the complete URL to the file to which the status is relative.
     *
     * @return null|string Returns the complete URL to the file to which the status is relative.
     */
    public function getFileSpecUrl() : ?string
    {
        return $this->fileSpecUrl;
    }

    /**
     * @param string|null $serverHost
     */
    public function setServerHost(?string $serverHost) : void
    {
        $this->serverHost = $serverHost;
    }

    /**
     * @return string|null
     */
    public function getServerHost() : ?string
    {
        return $this->serverHost;
    }

    /**
     * @param string|null $serverName
     */
    public function setServerName(?string $serverName) : void
    {
        $this->serverName = $serverName;
    }

    /**
     * @return string|null
     */
    public function getServerName() : ?string
    {
        return $this->serverName;
    }

    /**
     * @param null|InkCons $inkCons
     */
    public function setInkCons(?InkCons $inkCons) : void
    {
        $this->inkCons = $inkCons;
    }

    /**
     * @return null|InkCons
     */
    public function getInkCons() : ?InkCons
    {
        return $this->inkCons;
    }

    /**
     * @param float|null $mediaUsageRatio
     */
    public function setMediaUsageRatio(?float $mediaUsageRatio = null) : void
    {
        $this->mediaUsageRatio = $mediaUsageRatio;
    }

    /**
     * @return float|null
     */
    public function getMediaUsageRatio() : ?float
    {
        return $this->mediaUsageRatio;
    }

    /**
     * @param float|null $mediaHeight
     */
    public function setMediaHeight(?float $mediaHeight) : void
    {
        $this->mediaHeight = $mediaHeight;
    }

    /**
     * @return float|null
     */
    public function getMediaHeight() : ?float
    {
        return $this->mediaHeight;
    }

    /**
     * @param float|null $mediaWidth
     */
    public function setMediaWidth(?float $mediaWidth = null) : void
    {
        $this->mediaWidth = $mediaWidth;
    }

    /**
     * @return float|null
     */
    public function getMediaWidth() : ?float
    {
        return $this->mediaWidth;
    }

    /**
     * @param float|null $printHeight
     */
    public function setPrintHeight(?float $printHeight = null) : void
    {
        $this->printHeight = $printHeight;
    }

    /**
     * @return float|null
     */
    public function getPrintHeight() : ?float
    {
        return $this->printHeight;
    }

    /**
     * @param float|null $printWidth
     */
    public function setPrintWidth(?float $printWidth = null) : void
    {
        $this->printWidth = $printWidth;
    }

    /**
     * @return float|null
     */
    public function getPrintWidth() : ?float
    {
        return $this->printWidth;
    }

    /**
     * @param string|null $jobMode
     */
    public function setJobMode(?string $jobMode) : void
    {
        $this->jobMode = $jobMode;
    }

    /**
     * @return string|null
     */
    public function getJobMode() : ?string
    {
        return $this->jobMode;
    }

    /**
     * @param int|null $printTime
     */
    public function setPrintTime(?int $printTime = null): void
    {
        $this->printTime = $printTime;
    }

    /**
     * @return int|null
     */
    public function getPrintTime() : ?int
    {
        return $this->printTime;
    }

    /**
     * @param int|null $operationEndTime
     */
    public function setOperationEndTime(?int $operationEndTime = null) : void
    {
        $this->operationEndTime = $operationEndTime;
    }

    /**
     * @return int|null
     */
    public function getOperationEndTime() : ?int
    {
        return $this->operationEndTime;
    }

    /**
     * @param int|null $beginTime
     */
    public function setBeginTime(?int $beginTime = null) : void
    {
        $this->beginTime = $beginTime;
    }

    /**
     * @return int|null
     */
    public function getBeginTime() : ?int
    {
        return $this->beginTime;
    }

    /**
     * @param int|null $createTime
     */
    public function setCreateTime(?int $createTime) : void
    {
        $this->createTime = $createTime;
    }

    /**
     * @return int|null
     */
    public function getCreateTime() : ?int
    {
        return $this->createTime;
    }

    /**
     * @param int|null $numberPrinted
     */
    public function setNumberPrinted(?int $numberPrinted = null) : void
    {
        $this->numberPrinted = $numberPrinted;
    }

    /**
     * @return int|null
     */
    public function getNumberPrinted() : ?int
    {
        return $this->numberPrinted;
    }

    /**
     * @param null|string $jobError
     */
    public function setJobError(?string $jobError = null) : void
    {
        $this->jobError = $jobError;
    }

    /**
     * @return null|string
     */
    public function getJobError() : ?string
    {
        return $this->jobError;
    }

    /**
     * Sets the state of the job.
     * @param JobState $jobState
     */
    public function setJobState(JobState $jobState) : void
    {
        $this->jobState = $jobState;
    }

    /**
     * Returns the state of the job.
     *
     * @return JobState Returns the state of the job.
     */
    public function getJobState() : JobState
    {
        return $this->jobState;
    }

    /**
     * Returns the name of the job as shown in Caldera Spooler.
     *
     * @return string|null Returns the name o-f the job as shown in the Caldera Spooler.
     */
    public function getJobName() : ?string
    {
        return $this->jobName;
    }

    /**
     * Sets the name of the job as shown in the Caldera Spooler.
     *
     * @param string|null $jobName The name of the job as shown in the Caldera Spooler.
     */
    public function setJobName(?string $jobName) : void
    {
        $this->jobName = $jobName;
    }

    /**
     * Returns the Caldera internal ID of the job.
     *
     * @return int Returns the Caldera internal ID of the job.
     */
    public function getJobId() : int
    {
        return $this->jobId;
    }

    /**
     * Sets the Caldera internal ID of the job. This is the same value as the
     * first part of the Job Export XML file.
     *
     * @param int $jobId The internal ID of the job.
     */
    public function setJobId(int $jobId) : void
    {
        $this->jobId = $jobId;
    }

    /**
     * Generates a DOMElement representing the JDFComponent.
     *
     * @param \DOMDocument $dom The DOMDocument use to generate the element.
     *
     * @return \DOMElement Returns the generated DOMElement for the component.
     */
    public function getJDF(\DOMDocument $dom): \DOMElement
    {
        $element = $dom->createElementNS(Configurations::XML_CALDERA_NAMESPACE, 'Status');

        // Add FileSpecURL="..."
        if (! is_null($this->getFileSpecUrl())) {
            $element->setAttribute('FileSpecURL', $this->getFileSpecUrl());
        }

        // Add <job_id/>
        $jobId = $dom->createElement('job_id');
        $jobId->appendChild($dom->createTextNode((string) $this->getJobId()));
        $element->appendChild($jobId);

        // Add <job_name/>
        $jobName = $dom->createElement('job_name');
        $jobName->appendChild($dom->createTextNode($this->getJobName()));
        $element->appendChild($jobName);

        // Add <job_state>
        $element->appendChild($this->getJobState()->getJDF($dom));

        // Add <job_error/>
        if (! is_null($this->getJobError())) {
            $jobError = $dom->createElement('job_error');
            $jobError->appendChild($dom->createTextNode($this->getJobError()));
            $element->appendChild($jobError);
        }

        // Add <nb_jobs/>
        if (! is_null($this->getNumberPrinted())) {
            $jobError = $dom->createElement('nb_printed');
            $jobError->appendChild($dom->createTextNode((string)$this->getNumberPrinted()));
            $element->appendChild($jobError);
        }

        // Set <create_time/>
        $createTimeEl = $dom->createElement('create_time');
        $createTimeEl->appendChild($dom->createTextNode((new TimeFormatter())->format($this->getCreateTime())));
        $element->appendChild($createTimeEl);

        // Set <begin_time/>
        if (! is_null($this->getBeginTime())) {
            $beginTime = $dom->createElement('begin_time');
            $beginTime->appendChild($dom->createTextNode((new TimeFormatter())->format($this->getBeginTime())));
            $element->appendChild($beginTime);
        }

        // Set <op_time/>
        if (! is_null($this->getOperationEndTime())) {
            $time = $dom->createElement('op_time');
            $time->appendChild($dom->createTextNode((new TimeFormatter())->format($this->getOperationEndTime())));
            $element->appendChild($time);
        }

        // Set <print_time/>
        if (! is_null($this->getPrintTime())) {
            $time = $dom->createElement('print_time');
            $time->appendChild($dom->createTextNode((new TimeFormatter())->format($this->getPrintTime())));
            $element->appendChild($time);
        }

        // Sets <job_mode/>
        $jobModeEl = $dom->createElement('job_mode');
        $jobModeEl->appendChild($dom->createTextNode($this->getJobMode()));
        $element->appendChild($jobModeEl);

        // Set <print_width/>
        if (! is_null($this->getPrintWidth())) {
            $printWidthEl = $dom->createElement('print_width');
            $printWidthEl->appendChild($dom->createTextNode((string) $this->getPrintWidth()));
            $element->appendChild($printWidthEl);
        }

        // Set <print_height/>
        if (! is_null($this->getPrintHeight())) {
            $printHeightEl = $dom->createElement('print_height');
            $printHeightEl->appendChild($dom->createTextNode((string) $this->getPrintHeight()));
            $element->appendChild($printHeightEl);
        }

        // Set <media_width/>
        if (! is_null($this->getMediaWidth())) {
            $mediaWidthEl = $dom->createElement('media_width');
            $mediaWidthEl->appendChild($dom->createTextNode((string) $this->getMediaWidth()));
            $element->appendChild($mediaWidthEl);
        }

        // Set <media_height/>
        if (! is_null($this->getMediaHeight())) {
            $mediaHeightEl = $dom->createElement('media_height');
            $mediaHeightEl->appendChild($dom->createTextNode((string) $this->getMediaHeight()));
            $element->appendChild($mediaHeightEl);
        }

        // Set <media_usage_ratio/>
        if (! is_null($this->getMediaUsageRatio())) {
            $mediaUsageRatio = $dom->createElement('media_usage_ratio');
            $mediaUsageRatio->appendChild($dom->createTextNode((string) $this->getMediaUsageRatio()));
            $element->appendChild($mediaUsageRatio);
        }

        // Set <ink_cons ... />
        if (! is_null($this->getInkCons())) {
            $element->appendChild($this->getInkCons()->getJDF($dom));
        }

        $serverNameEl = $dom->createElement('server_name');
        $serverNameEl->appendChild($dom->createTextNode($this->getServerName()));
        $element->appendChild($serverNameEl);

        $serverHostEl = $dom->createElement('server_host');
        $serverHostEl->appendChild($dom->createTextNode($this->getServerHost()));
        $element->appendChild($serverHostEl);

        if (! is_null($this->getContents())) {
            $element->appendChild($this->getContents()->getJDF($dom));
        }

        return $element;
    }

    /**
     * Creates a new instance of the IJDFComponent from a DOMElement.
     *
     * @param \DOMElement $element The DOMElement containing the component definition.
     * @return IJDFComponent Returns the Component.
     * @throws JDFException if the DOMElement does not define a valid component descriptor.
     */
    public static function fromJDFElement(\DOMElement $element): IJDFComponent
    {
        $fileSpecUrl = $element->getAttribute('FileSpecURL');

        $jobId = self::getTagIntegerValue($element, 'job_id', false);
        $jobName = self::getTagTextValue($element, 'job_name', false);

        $jobStateEl = $element->getElementsByTagName('job_state');
        $jobState = null;

        if (count($jobStateEl) > 0) {
            $jobState = JobState::fromJDFElement($jobStateEl[0]);
        }

        $contentsEls = $element->getElementsByTagName('contents');
        $contents = null;

        if (count($contentsEls) > 0) {
            $contents = Contents::fromJDFElement($contentsEls[0]);
        }

        $error = self::getTagTextValue($element, 'job_error');
        $nbPrinted = self::getTagIntegerValue($element, 'nb_printed');
        $createTime = self::getTagTimestampValue($element, 'create_time', false);
        $jobMode = self::getTagTextValue($element, 'job_mode');
        $serverName = self::getTagTextValue($element, 'server_name');
        $serverHost = self::getTagTextValue($element, 'server_host');
        $beginTime = self::getTagTimestampValue($element, 'begin_time', false);
        $operationEndTime = self::getTagTimestampValue($element, 'op_time', false);
        $printTime = self::getTagIntegerValue($element, 'print_time_sec', false);
        $printWidth = self::getTagFloatValue($element, 'print_width');
        $printHeight = self::getTagFloatValue($element, 'print_height');
        $mediaWidth = self::getTagFloatValue($element, 'media_width');
        $mediaHeight = self::getTagFloatValue($element, 'media_height');
        $mediaUsageRatio = self::getTagFloatValue($element, 'media_usage_ratio');
        $inkCons = null;
        $inkConsEl = $element->getElementsByTagName('ink_cons');

        if (count($inkConsEl) > 0) {
            $inkCons = InkCons::fromJDFElement($inkConsEl[0]);
        }

        return new Status(
            $jobId,
            $jobName,
            $jobState,
            $createTime,
            $jobMode,
            $serverName,
            $serverHost,
            $error,
            $nbPrinted,
            $beginTime,
            $operationEndTime,
            $printTime,
            $printWidth,
            $printHeight,
            $mediaWidth,
            $mediaHeight,
            $mediaUsageRatio,
            $inkCons,
            $fileSpecUrl,
            $contents
        );
    }
}
