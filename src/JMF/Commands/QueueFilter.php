<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\Commands\QueueFilter class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JMF\Commands;

use RWC\Caldera\JMF\IJMFComponent;
use RWC\Caldera\JMF\JMFException;

/**
 * Describes the print jobs that should be returned in a query or affected by
 * a command.
 *
 * @package RWC\Caldera\JMF\Commands
 */
class QueueFilter implements IJMFComponent
{
    /**
     * Specifies the level of detail to return from the query
     * (None, Brief, JobPhase).
     *
     * @var string|null
     */
    protected $queueEntryDetails;

    /**
     * List only jobs with specified JobID.
     *
     * @var string|null
     */
    protected $jobId;

    /**
     * List only jobs with specified JobPartID.
     *
     * @var string|null
     */
    protected $jobPartId;

    /**
     * Lists only jobs with submission time older then or equal to specified
     * timestamp.
     *
     * @var int|null
     */
    protected $olderThan;

    /**
     * Lists only jobs with submission time newer than or equal to
     * specified timestamp.
     *
     * @var int|null
     */
    protected $newerThan;

    /**
     * List only jobs belonging to the specified gangs.
     *
     * @var array|null
     */
    protected $gangNames;

    /**
     * List only jobs for specified device. Multiple devices are allowed.
     *
     * @var Device[]|null
     */
    protected $device;

    /**
     * List only specific queue entries.
     *
     * @var QueueEntryDef
     */
    protected $queueEntryDef;

    /**
     * Returns the level of queue entry details (None, Brief, JobPhase)
     *
     * @return null|string Returns the level of queue entry details (None, Brief, JobPhase)
     */
    public function getQueueEntryDetails(): ?string
    {
        return $this->queueEntryDetails;
    }

    /**
     * Sets the level of queue entry details (None, Brief, JobPhase)
     *
     * @param null|string $queueEntryDetails The level of queue entry details (None, Brief, JobPhase)
     */
    public function setQueueEntryDetails(?string $queueEntryDetails): void
    {
        $this->queueEntryDetails = $queueEntryDetails;
    }

    /**
     * Returns the job id.
     *
     * @return null|string Returns the job id.
     */
    public function getJobId(): ?string
    {
        return $this->jobId;
    }

    /**
     * Sets the job id.
     *
     * @param null|string $jobId Sets the job id.
     */
    public function setJobId(?string $jobId): void
    {
        $this->jobId = $jobId;
    }

    /**
     * Returns the job part id.
     *
     * @return null|string The job part id.
     */
    public function getJobPartId(): ?string
    {
        return $this->jobPartId;
    }

    /**
     * Sets the job part id.
     *
     * @param null|string $jobPartId The job part id
     */
    public function setJobPartId(?string $jobPartId): void
    {
        $this->jobPartId = $jobPartId;
    }

    /**
     * Returns the timestamp which print jobs must be submitted before to be
     * returned.
     *
     * @return int|null Returns the older than timestamp.
     */
    public function getOlderThan(): ?int
    {
        return $this->olderThan;
    }

    /**
     * Sets the timestamp that print jobs must have been submitted before to be returned.
     *
     * @param int|null $olderThan The older than timestamp
     */
    public function setOlderThan(?int $olderThan): void
    {
        $this->olderThan = $olderThan;
    }

    /**
     * Returns the timestamp which print jobs must have been printed after to
     * be returned.
     *
     * @return int|null Returns the newer than timestamp.
     */
    public function getNewerThan(): ?int
    {
        return $this->newerThan;
    }

    /**
     * Sets the timestamp in which print jobs must have been submitted after to
     * be returned.
     *
     * @param int|null $newerThan The newer than timestamp.
     */
    public function setNewerThan(?int $newerThan): void
    {
        $this->newerThan = $newerThan;
    }

    /**
     * Returns a list of gang names that a job must belong to to be returned.
     *
     * @return array|null Returns the list of gang names.
     */
    public function getGangNames(): ?array
    {
        return $this->gangNames;
    }

    /**
     * Sets the list of gang names a job must belong to to be returned.
     *
     * @param array|null $gangNames A list of gang names.
     */
    public function setGangNames(?array $gangNames): void
    {
        $this->gangNames = $gangNames;
    }

    /**
     * Returns a list of Devices a job must be sent to to be returned.
     *
     * @return null|Device[] Returns a list of Devices.
     */
    public function getDevice(): ?array
    {
        return $this->device;
    }

    /**
     * Sets a list of Devices a job must be sent to to be returned.
     *
     * @param null|Device[] $device A list of Devices.
     */
    public function setDevice(?array $device): void
    {
        $this->device = $device;
    }

    /**
     * Returns the QueueEntryDef which must match for a job to be returned.
     *
     * @return QueueEntryDef|null Returns the QueueEntryDef.
     */
    public function getQueueEntryDef(): ?QueueEntryDef
    {
        return $this->queueEntryDef;
    }

    /**
     * Sets the QueueEntryDef which must match for a job to be returned.
     *
     * @param QueueEntryDef|null $queueEntryDef The QueueEntryDef.
     */
    public function setQueueEntryDef(?QueueEntryDef $queueEntryDef): void
    {
        $this->queueEntryDef = $queueEntryDef;
    }

    /**
     * Creates a new QueueFilter.
     *
     * @param null|string $queueEntryDetails The level of details to return (None, Brief, JobPhase).
     * @param null|string $jobId The job id filter
     * @param null|string $jobPartId The job part id filter.
     * @param int|null $olderThan Only return jobs submitted before this timestamp.
     * @param int|null $newerThan Only return jobs submitted after this timestamp.
     * @param array|null $gangNames Only return jobs in a listed gang.
     * @param array|null $device Only return jobs in one of these devices.
     * @param null|QueueEntryDef $queueEntryDef Only return jobs with a matching queue definition.
     */
    public function __construct(
        ?string $queueEntryDetails = 'Brief',
        ?string $jobId = null,
        ?string $jobPartId = null,
        ?int $olderThan = null,
        ?int $newerThan = null,
        ?array $gangNames = null,
        ?array $device = null,
        ?QueueEntryDef $queueEntryDef = null
    ) {
        $this->setQueueEntryDetails($queueEntryDetails);
        $this->setJobId($jobId);
        $this->setJobPartId($jobPartId);
        $this->setOlderThan($olderThan);
        $this->setNewerThan($newerThan);
        $this->setGangNames(empty($gangNames) ? [] : $gangNames);
        $this->setDevice(empty($device) ? [] : $device);
        $this->setQueueEntryDef($queueEntryDef);
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
        $command = $domDocument->createElement('QueueFilter');

        if (! empty($this->getJobId())) {
            $command->setAttribute('JobID', $this->getJobId());
        }

        if (! empty($this->getJobPartId())) {
            $command->setAttribute('JobPartID', $this->getJobPartId());
        }

        if (! empty($this->getOlderThan())) {
            // Set as ISO
            $command->setAttribute(
                'OlderThan',
                date('c', $this->getOlderThan())
            );
        }

        if (! empty($this->getNewerThan())) {
            // Set as ISO
            $command->setAttribute(
                'NewerThan',
                date('c', $this->getNewerThan())
            );
        }

        if (! empty($this->getGangNames())) {
            $command->setAttribute(
                'GangNames',
                implode(' ', $this->getGangNames())
            );
        }

        if (! empty($this->getDevice())) {
            foreach ($this->getDevice() as $device) {
                $command->appendChild($device->getJmf($domDocument));
            }
        }

        if (! empty($this->getQueueEntryDef())) {
            $command->appendChild($this->getQueueEntryDef()->getJmf($domDocument));
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
        if (! $element->tagName == 'QueueFilter') {
            throw new JMFException('Element is not a QueueFilter');
        }

        $queueEntryDetails = $element->hasAttribute('QueueEntryDetails') ?
            $element->getAttribute('QueueEntryDetails') : 'Brief';
        $jobId = $element->hasAttribute('JobID') ?
            $element->getAttribute('JobID') : null;
        $jobPartId = $element->hasAttribute('JobPartID') ?
            $element->getAttribute('JobPartID') : null;
        $olderThan = $element->hasAttribute('OlderThan') ?
            strtotime($element->getAttribute('OlderThan')) : null;
        $newerThan = $element->hasAttribute('NewerThan') ?
            strtotime($element->getAttribute('NewerThan')) : null;
        $gangNames = $element->hasAttribute('GangNames') ?
            explode(' ', $element->getAttribute('GangNames')) : [];
        $deviceEls = $element->getElementsByTagName('Device');
        $devices = [];

        foreach ($deviceEls as $deviceEl) {
            $devices[] = Device::fromJMF($deviceEl);
        }

        $queueEntryDefEls = $element->getElementsByTagName('QueueEntryDef');
        $queueEntryDef = null;

        if (count($queueEntryDefEls) > 0) {
            $queueEntryDef = QueueEntryDef::fromJMF($queueEntryDefEls[0]);
        }

        return new QueueFilter(
            $queueEntryDetails,
            $jobId,
            $jobPartId,
            $olderThan,
            $newerThan,
            $gangNames,
            $devices,
            $queueEntryDef
        );
    }
}
