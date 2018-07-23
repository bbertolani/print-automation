<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\ResourceLinkPool class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\ResourceLinkPool;

use RWC\Caldera\AbstractJDFComponent;

/**
 * Links to a RunList resource.
 *
 * @package RWC\Caldera\JDF
 */
abstract class AbstractLink extends AbstractJDFComponent
{
    /**
     * Usage of the RunLink. Either "Input" or "Output".
     *
     * @var string
     */
    protected $usage;

    /**
     * Reference to the ID of the RunLink.
     *
     * @var string
     */
    protected $rRef;

    /**
     * The XML tag generated for this Link.
     *
     * @var string
     */
    protected $element;

    /**
     * AbstractLink constructor.
     *
     * @param string $element The name of the XML tag to generate.
     * @param string $usage Usage of the Link ("Input" or "Output").
     * @param string $rRef Reference ID of the linked resource.
     */
    public function __construct(string $element, string $usage, string $rRef)
    {
        $this->setUsage($usage);
        $this->setRRef($rRef);
        $this->setElement($element);
    }

    /**
     * Sets the XML tag to generate.
     *
     * @param string $element The XML tag to generate.
     */
    public function setElement(string $element) : void
    {
        $this->element = $element;
    }

    /**
     * Returns the XML tag to generate.
     *
     * @return string Returns the XML tag to generate.
     */
    public function getElement() : string
    {
        return $this->element;
    }

    /**
     * Sets the Usage of the Link.
     *
     * The Usage of the RunLink is either "Input" or "Output". The "Input"
     * usage means that the resource is an input. The "Output" usage means that
     * the resource is output. This is currently ignored by Caldera but could
     * be used later to output ripped files for archival.
     *
     * @param string $usage The usage.
     * @throws \InvalidArgumentException if $usage is invalid.
     */
    public function setUsage(string $usage) : void
    {
        $values = ['Input', 'Output'];

        if (! in_array($usage, $values)) {
            throw new \InvalidArgumentException('Usage must be one of ' .
                implode(', ', $values));
        }

        $this->usage = $usage;
    }

    /**
     * Returns the Usage of the RunLink (Input or Output).
     *
     * @return string Returns the Usage of the RunLink.
     */
    public function getUsage() : string
    {
        return $this->usage;
    }

    /**
     * Sets the reference to the ID of the RunLink.
     *
     * @param string $rRef Sets the reference to the ID of the RunLink.
     */
    public function setRRef(string $rRef) : void
    {
        $this->rRef = $rRef;
    }

    /**'
     * Returns the reference to the ID of the RunLink.
     *
     * @return string Returns the reference to the ID of the RunLink.
     */
    public function getRRef() : string
    {
        return $this->rRef;
    }
}
