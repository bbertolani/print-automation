<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\LayoutElement class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF;

use RWC\Caldera\IJDFComponent;

/**
 * Contained in RunList to specify a file.
 *
 * @package RWC\Caldera\JDF
 */
class LayoutElement implements IJDFComponent
{
    /**
     * Child element to specify the file (see below). Can contain more than one
     * of these (unordered list)
     *
     * @var FileSpec[]
     */
    protected $fileSpecs;

    /**
     * Reference to a file (FileSpec). Used when the same file is referenced
     * more than once in the job (to select specific pages for example)
     *
     * @var FileSpecRef
     */
    protected $fileSpecRef;

    /**
     * LayoutElement constructor.
     *
     * @param FileSpec[] $fileSpecs
     * @param null|FileSpecRef $fileSpecRef
     */
    public function __construct(
        array $fileSpecs = [],
        ?FileSpecRef $fileSpecRef = null
    ) {
        $this->setFileSpecs($fileSpecs);
        $this->setFileSpecRef($fileSpecRef);
    }

    /**
     * Child element to specify the file (see below). Can contain
     * more than one of these (unordered list)
     *
     * @param array $fileSpecs Sets all FileSpecs at once.
     */
    public function setFileSpecs(array $fileSpecs = []) : void
    {
        $this->fileSpecs = [];

        foreach ($fileSpecs as $fileSpec) {
            $this->addFileSpec($fileSpec);
        }
    }

    /**
     * Child element to specify the file (see below). Can contain
     * more than one of these (unordered list)
     *
     * @return FileSpec[] Returns a list of FileSpecs
     */
    public function getFileSpecs() : array
    {
        return $this->fileSpecs;
    }

    /**
     * @param null|FileSpecRef $fileSpecRef
     */
    public function setFileSpecRef(?FileSpecRef $fileSpecRef) : void
    {
        $this->fileSpecRef = $fileSpecRef;
    }

    /**
     *
     * @return FileSpecRef
     */
    public function getFileSpecRef() : ?FileSpecRef
    {
        return $this->fileSpecRef;
    }

    /**
     * Child element to specify the file (see below). Can contain
     * more than one of these (unordered list)
     *
     * @param FileSpec $fileSpec The FileSpec to add.
     */
    public function addFileSpec(FileSpec $fileSpec) : void
    {
        $this->fileSpecs[] = $fileSpec;
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
        $element = $dom->createElement('LayoutElement');

        foreach ($this->getFileSpecs() as $fileSpec) {
            $element->appendChild($fileSpec->getJDF($dom));
        }
        if (! empty($this->getFileSpecRef())) {
            $element->appendChild($this->getFileSpecRef()->getJDF($dom));
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
        $fileSpecEls = $element->getElementsByTagName('FileSpec');
        $fileSpecs = [];
        $fileSpecRefEl = $element->getElementsByTagName('FileSpecRef');
        $fileSpecRef = null;

        foreach ($fileSpecEls as $fileSpecEl) {
            $fileSpecs[] = FileSpec::fromJDFElement($fileSpecEl);
        }

        if (empty($fileSpecs)) {
            throw new JDFException('Zero FileSpec sub-elements of LayoutElement were found.');
        }

        if (count($fileSpecRefEl) > 0) {
            $fileSpecRef = FileSpecRef::fromJDFElement($fileSpecRefEl[0]);
        }

        return new LayoutElement(
            $fileSpecs,
            $fileSpecRef
        );
    }
}
