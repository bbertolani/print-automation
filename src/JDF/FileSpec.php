<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\FileSpec class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JDF;

use RWC\Caldera\IJDFComponent;

/**
 * Specifies an external file. Currently Containers, Compression, and aliases
 * not supported. There should be exactly one FileSpec in a LayoutElement.
 *
 * @package RWC\Caldera\JDF
 */
class FileSpec implements IJDFComponent
{
    /**
     * Location of the file. Can be absolute http/file or relative file URI.
     * Relative path to RunList/@Directory (only file://).
     *
     * @var string
     */
    protected $fileSpecUrl;

    /**
     * Optional. User-friendly file name. If not specified, the name is
     * extracted from the URL.
     *
     * @var null|string
     */
    protected $userFileName;

    /**
     * Optional. MD5 checksum of the file. Currently not verified.
     *
     * @var null|string
     */
    protected $checkSum;

    /**
     * "Parameter." Must be specified ONLY when placed directly in ResourcePool
     * (for use with FileSpecRef).
     *
     * @var null|string
     */
    protected $class;

    /**
     * "Unique resource identifier to be specified in rRef attribute of
     * FileSpecRef. Must be specified ONLY when placed directly in
     * ResourcePool (for use with FileSpecRef).
     *
     * @var null|string
     */
    protected $fileSpecId;

    /**
     * "Available" = resource can be used. All other values currently
     * interpreted as resource can not be used. Must be specified ONLY when
     * placed directly in ResourcePool (for use with FileSpecRef).
     *
     * @var null|string
     */
    protected $status;

    /**
     * FileSpec constructor.
     *
     * @param string $fileSpecUrl The url to the file.
     * @param null|string $userFileName The user-friendly filename.
     * @param null|string $checkSum MD5 checksum of the file.
     * @param null|string $class Always "Parameter"
     * @param null|string $fileSpecId The unique id.
     * @param null|string $status The file status. "Available" means file is ready for use.
     */
    public function __construct(
        string $fileSpecUrl,
        ?string $userFileName = null,
        ?string $checkSum = null,
        ?string $class = null,
        ?string $fileSpecId = null,
        ?string $status = null
    ) {
        $this->setUrl($fileSpecUrl);
        $this->setUserFileName($userFileName);
        $this->setCheckSum($checkSum);
        $this->setClass($class);
        $this->setId($fileSpecId);
        $this->setStatus($status);
    }

    /**
     * Location of the file. Can be absolute http/file or relative file URI.
     * Relative path to RunList/@Directory (only file://).
     *
     * @param string $fileSpecUrl Location of the file.
     */
    public function setUrl(string $fileSpecUrl) : void
    {
        $this->fileSpecUrl = $fileSpecUrl;
    }

    /**
     * Location of the file. Can be absolute http/file or relative file URI.
     * Relative path to RunList/@Directory (only file://).
     *
     * @return string Location of the file.
     */
    public function getUrl() : string
    {
        return $this->fileSpecUrl;
    }

    /**
     * Optional. User-friendly file name. If not specified, the name is
     * extracted from the URL.
     *
     * @param null|string $userFileName The user-friendly file name.
     */
    public function setUserFileName(?string $userFileName) : void
    {
        $this->userFileName = $userFileName;
    }

    /**
     * Optional. User-friendly file name. If not specified, the name is
     * extracted from the URL.
     *
     * @return null|string Returns the user friendly filename.
     */
    public function getUserFileName() : ?string
    {
        return $this->userFileName;
    }

    /**
     * Optional. MD5 checksum of the file. Currently not verified.
     *
     * @param null|string $checkSum The MD5 Checksum of the file.
     */
    public function setCheckSum(?string $checkSum) : void
    {
        $this->checkSum = $checkSum;
    }

    /**
     * Optional. MD5 checksum of the file. Currently not verified.
     *
     * @return null|string The MD5 checksum of the file.
     */
    public function getCheckSum() : ?string
    {
        return $this->checkSum;
    }


    /**
     * "Parameter." Must be specified ONLY when placed directly in ResourcePool
     * (for use with FileSpecRef).
     *
     * @param null|string $class "Parameter"
     */
    public function setClass(?string $class) : void
    {
        $this->class = $class;
    }

    /**
     * "Parameter." Must be specified ONLY when placed directly in ResourcePool
     * (for use with FileSpecRef).
     *
     * @return null|string "Parameter"
     */
    public function getClass() : ?string
    {
        return $this->class;
    }

    /**
     * Unique resource identifier to be specified in rRef attribute of
     * FileSpecRef. Must be specified ONLY when placed directly in
     * ResourcePool (for use with FileSpecRef).
     *
     * @param null|string $fileSpecId The unique id.
     */
    public function setId(?string $fileSpecId) : void
    {
        $this->fileSpecId = $fileSpecId;
    }

    /**
     * Unique resource identifier to be specified in rRef attribute of
     * FileSpecRef. Must be specified ONLY when placed directly in
     * ResourcePool (for use with FileSpecRef).
     *
     * @return null|string The resource identifier.
     */
    public function getId() : ?string
    {
        return $this->fileSpecId;
    }

    /**
     * "Available" = resource can be used. All other values currently
     * interpreted as resource can not be used. Must be specified ONLY when
     * placed directly in ResourcePool (for use with FileSpecRef).
     *
     * @param null|string $status The status
     */
    public function setStatus(?string $status) : void
    {
        $this->status = $status;
    }

    /**
     * "Available" = resource can be used. All other values currently
     * interpreted as resource can not be used. Must be specified ONLY when
     * placed directly in ResourcePool (for use with FileSpecRef).
     *
     * @return null|string Returns the status.
     */
    public function getStatus() : ?string
    {
        return $this->status;
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
        $element = $dom->createElement('FileSpec');

        $element->setAttribute('URL', $this->getUrl());

        if (! empty($this->getUserFileName())) {
            $element->setAttribute('UserFileName', $this->getUserFileName());
        }

        if (! empty($this->getCheckSum())) {
            $element->setAttribute('CheckSum', $this->getCheckSum());
        }

        if (! empty($this->getClass())) {
            $element->setAttribute('Class', $this->getClass());
        }

        if (! empty($this->getId())) {
            $element->setAttribute('ID', $this->getId());
        }

        if (! empty($this->getStatus())) {
            $element->setAttribute('Status', $this->getStatus());
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
        $urlAtt = $element->getAttribute('URL');
        $userFileNameAtt = $element->getAttribute('UserFileName');
        $checkSumAtt = $element->getAttribute('CheckSum');
        $classAtt = $element->getAttribute('Class');
        $idAtt = $element->getAttribute('ID');
        $statusAtt = $element->getAttribute('Status');

        if (empty($urlAtt)) {
            throw new JDFException('Required attribute "URL" not present in FileSpec.');
        }

        return new FileSpec(
            $urlAtt,
            empty($userFileNameAtt) ? null : $userFileNameAtt,
            empty($checkSumAtt) ? null : $checkSumAtt,
            empty($classAtt) ? null : $classAtt,
            empty($idAtt) ? null : $idAtt,
            empty($statusAtt) ? null : $statusAtt
        );
    }
}
