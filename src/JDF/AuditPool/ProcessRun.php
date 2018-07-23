<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\AuditPool\ProcessRun class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\AuditPool;

use RWC\Caldera\IJDFComponent;
use RWC\Caldera\JDF\JDFException;
use RWC\Caldera\TimeFormatter;

/**
 * Information about running the process. This element log the end of a process
 * run. Any subsequent elements belong to the next run.
 *
 * @package RWC\Caldera\JDF\AuditPool
 */
class ProcessRun extends AbstractAuditPoolElement
{
    /**
     * Status of the process at the end of run (Aborted, Completed)
     *
     * @var string
     */
    protected $endStatus;

    /**
     * Date and time at which the process started.
     *
     * @var int
     */
    protected $startTime;

    /**
     * Date and time at which the process ended.
     *
     * @var int
     */
    protected $endTime;

    /**
     * ResourceAudit constructor.
     *
     * @param string $endStatus Status of the process at the end of run (Aborted, Completed)
     * @param int $startTime Date and time at which the process started.
     * @param int $endTime Date and time at which the process ended.
     * @param int $timestamp The timestamp when the ProcessRun was created.
     * @param null|string $agentName The name of the Agent that created the JDF.
     * @param null|string $agentVersion The version of the Agent that created the JDF.
     */
    public function __construct(
        string $endStatus,
        int $startTime,
        int $endTime,
        int $timestamp,
        ?string $agentName = null,
        ?string $agentVersion = null
    ) {
        parent::__construct($timestamp, $agentName, $agentVersion);
        $this->setEndStatus($endStatus);
        $this->setStartTime($startTime);
        $this->setEndTime($endTime);
    }

    /**
     * Date and time at which the process started.
     *
     * @param int $startTime Date and time at which the process started.
     */
    public function setStartTime(int $startTime) : void
    {
        $this->startTime = $startTime;
    }

    /**
     * Date and time at which the process started.
     *
     * @return int Date and time at which the process started.
     */
    public function getStartTime() : int
    {
        return $this->startTime;
    }

    /**
     * Date and time at which the process ended.
     *
     * @param int $endTime Date and time at which the process ended.s
     */
    public function setEndTime(int $endTime) : void
    {
        $this->endTime = $endTime;
    }

    /**
     * Date and time at which the process ended.
     *
     * @return int Date and time at which the process ended.
     */
    public function getEndTime() : int
    {
        return $this->endTime;
    }

    /**
     * Status of the process at the end of run (Aborted, Completed)
     *
     * @param string $endStatus Status of the process at the end of run (Aborted, Completed)
     */
    public function setEndStatus(string $endStatus) : void
    {
        $this->endStatus = $endStatus;
    }

    /**
     * Status of the process at the end of run (Aborted, Completed)
     *
     * @return string Status of the process at the end of run (Aborted, Completed)
     */
    public function getEndStatus() : string
    {
        return $this->endStatus;
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
        $element = $dom->createElement('ProcessRun');
        $this->decorateElement($element);

        $element->setAttribute('End', (new TimeFormatter())->format($this->getEndTime()));
        $element->setAttribute('Start', (new TimeFormatter())->format($this->getStartTime()));
        $element->setAttribute('EndStatus', $this->getEndStatus());

        return $element;
    }

    /**
     * Creates a new instance of the IJDFComponent from a DOMElement.
     *
     * @param \DOMElement $element The DOMElement containing the component definition.
     * @return IJDFComponent Returns the Component.
     * @throws JDFException if the DOMElement does not define a valid component descriptor.
     */
    public static function fromJDFElement(\DOMElement $element) : IJDFComponent
    {
        $timestampAtt    = $element->getAttribute('TimeStamp');
        $agentNameAtt    = $element->getAttribute('AgentName');
        $agentVersionAtt = $element->getAttribute('AgentVersion');
        $startTimeAtt    = $element->getAttribute('Start');
        $endTimeAtt      = $element->getAttribute('End');
        $endStatusAtt    = $element->getAttribute('EndStatus');

        if (empty($startTimeAtt)) {
            throw new JDFException('Required ProcessRun attribute "Start" was not found.');
        }

        if (empty($endTimeAtt)) {
            throw new JDFException('Required ProcessRun attribute "End" was not found.');
        }

        if (empty($endStatusAtt)) {
            throw new JDFException('Required ProcessRun attribute "EndStatus" was not found.');
        }

        if (empty($timestampAtt)) {
            throw new JDFException('Required Created elements attribute "TimeStamp" was not found.');
        }

        $timestamp    = strtotime($timestampAtt);
        $agentName    = empty($agentNameAtt) ? null : $agentNameAtt;
        $agentVersion = empty($agentVersionAtt) ? null : $agentVersionAtt;
        $startTime    = strtotime($startTimeAtt);
        $endTime      = strtotime($endTimeAtt);
        $endStatus    = $endStatusAtt;

        return new ProcessRun(
            $endStatus,
            $startTime,
            $endTime,
            $timestamp,
            $agentName,
            $agentVersion
        );
    }
}
