<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\RunList class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF;

use RWC\Caldera\IJDFComponent;

/**
 * Class RunList
 * @package RWC\Caldera\JDF
 */
class RunList implements IJDFComponent
{
    protected $class;
    protected $runListId;
    protected $status;
    protected $directory;
    protected $docCopies;
    protected $pages;
    protected $partIdKeys;
    protected $runNo;
    protected $descriptiveName;
    protected $layoutElement;

    /**
     * RunList constructor.
     * @param string $class
     * @param string $id
     * @param string $status
     * @param null|string $directory
     * @param int|null $docCopies
     * @param null|string $pages
     * @param null|string $partIdKeys
     * @param int|null $run
     * @param null|string $descriptiveName
     * @param null|LayoutElement $layoutElement
     */
    public function __construct(
        string $class,
        string $id,
        string $status,
        ?string $directory = null,
        ?int $docCopies = null,
        ?string $pages = null,
        ?string $partIdKeys = null,
        ?int $run = null,
        ?string $descriptiveName = null,
        ?LayoutElement $layoutElement = null
    ) {
        $this->setClass($class);
        $this->setRunListId($id);
        $this->setStatus($status);
        $this->setDirectory($directory);
        $this->setDocCopies($docCopies);
        $this->setPages($pages);
        $this->setPartIdKeys($partIdKeys);
        $this->setRunNo($run);
        $this->setDescriptiveName($descriptiveName);
        $this->setLayoutElement($layoutElement);
    }

    /**
     * @param null|LayoutElement $layoutElement
     */
    public function setLayoutElement(?LayoutElement $layoutElement = null) : void
    {
        $this->layoutElement = $layoutElement;
    }

    /**
     * @return null|LayoutElement
     */
    public function getLayoutElement() : ?LayoutElement
    {
        return $this->layoutElement;
    }

    /**
     * @param null|string $descriptiveName
     */
    public function setDescriptiveName(?string $descriptiveName = null) : void
    {
        $this->descriptiveName = $descriptiveName;
    }

    /**
     * @return null|string
     */
    public function getDescriptiveName() : ?string
    {
        return $this->descriptiveName;
    }

    /**
     * @param int|null $runNo
     */
    public function setRunNo(?int $runNo = null) : void
    {
        $this->runNo = $runNo;
    }

    /**
     * @return int|null
     */
    public function getRunNo() : ?int
    {
        return $this->runNo;
    }

    /**
     * @param null|string $partIdKeys
     */
    public function setPartIdKeys(?string $partIdKeys) : void
    {
        $this->partIdKeys = $partIdKeys;
    }

    /**
     * @return null|string
     */
    public function getPartIdKeys() : ?string
    {
        return $this->partIdKeys;
    }

    /**
     * @param null|string $pages
     */
    public function setPages(?string $pages = null) : void
    {
        $this->pages = $pages;
    }

    /**
     * @return null|string
     */
    public function getPages() : ?string
    {
        return $this->pages;
    }

    /**
     * @param int|null $docCopies
     */
    public function setDocCopies(?int $docCopies = null) : void
    {
        $this->docCopies = $docCopies;
    }

    /**
     * @return int|null
     */
    public function getDocCopies() : ?int
    {
        return $this->docCopies;
    }

    /**
     * @param null|string $directory
     */
    public function setDirectory(?string $directory = null) : void
    {
        $this->directory = $directory;
    }

    /**
     * @return null|string
     */
    public function getDirectory() : ?string
    {
        return $this->directory;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status) : void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus() : string
    {
        return $this->status;
    }

    /**
     * Sets the unique identifier of the RunList.
     *
     * @param string $runListId The unique identifier of the RunList.
     */
    public function setRunListId(string $runListId) : void
    {
        $this->runListId = $runListId;
    }

    /**
     * Returns the unique identifier of the RunList.
     *
     * @return string Returns the unique identifier of the RunList.
     */
    public function getRunListId() : string
    {
        return $this->runListId;
    }

    /**
     * Sets the class of the RunList. Always equal to "Parameter".
     *
     * @param string $class The class of the RunList. Always equal to "Parameter".
     */
    public function setClass(string $class) : void
    {
        $this->class = $class;
    }

    /**
     * Returns the class of the RunList. Always equal to "Parameter".
     *
     * @return string Returns the class of the RunList. Always equal to "Parameter".
     */
    public function getClass() : string
    {
        return $this->class;
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
        $element = $dom->createElement('RunList');

        // Required attributes.
        $element->setAttribute('Class', $this->getClass());
        $element->setAttribute('ID', $this->getRunListId());
        $element->setAttribute('Status', $this->getStatus());

        if (! empty($this->getDirectory())) {
            $element->setAttribute('Directory', $this->getDirectory());
        }

        if (! empty($this->getDocCopies())) {
            $element->setAttribute('DocCopies', (string) $this->getDocCopies());
        }

        if (! empty($this->getPages())) {
            $element->setAttribute('Pages', $this->getPages());
        }

        if (! empty($this->getPartIdKeys())) {
            $element->setAttribute('PartIDKeys', $this->getPartIdKeys());
        }

        if (! empty($this->getRunNo())) {
            $element->setAttribute('Run', (string) $this->getRunNo());
        }

        if (! empty($this->getDescriptiveName())) {
            $element->setAttribute('DescriptiveName', $this->getDescriptiveName());
        }

        if (! empty($this->getLayoutElement())) {
            $element->appendChild($this->getLayoutElement()->getJDF($dom));
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
        $class  = $element->getAttribute('Class');
        $id     = $element->getAttribute('ID');
        $status = $element->getAttribute('Status');
        $directory = $element->getAttribute('Directory');
        $docCopies = $element->getAttribute('DocCopies');
        $pages = $element->getAttribute('Pages');
        $partIdKeys = $element->getAttribute('PartIDKeys');
        $run = $element->getAttribute('Run');
        $descriptiveName = $element->getAttribute('DescriptiveName');
        $layoutElementEl = $element->getElementsByTagName('LayoutElement');

        if (empty($class)) {
            throw new JDFException('Required attribute "Class" of RunList not found.');
        }

        if (empty($id)) {
            throw new JDFException('Required attribute "ID" of RunList not found.');
        }

        if (empty($status)) {
            throw new JDFException('Required attribute "Status" of RunList not found.');
        }

        $docCopies = empty($docCopies) ? null : $docCopies;
        $pages = empty($pages) ? null : $pages;
        $partIdKeys = empty($partIdKeys) ? null : $partIdKeys;
        $run = empty($run) ? null : $run;
        $directory = empty($directory) ? null : $directory;
        $descriptiveName = empty($descriptiveName) ? null : $descriptiveName;

        $layoutElement = null;
        if (count($layoutElementEl) > 0) {
            $layoutElement = LayoutElement::fromJDFElement($layoutElementEl[0]);
        }

        return new RunList(
            $class,
            $id,
            $status,
            $directory,
            $docCopies,
            $pages,
            $partIdKeys,
            $run,
            $descriptiveName,
            $layoutElement
        );
    }
}
