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
 * Class FileSpecRef
 * @package RWC\Caldera\JDF
 */
class FileSpecRef implements IJDFComponent
{
    /**
     * The ID of a FileSpec resource.
     *
     * @var string
     */
    protected $rRef;

    /**
     * FileSpecRef constructor.
     *
     * @param string $rRef ID of a FileSpec Resource.
     */
    public function __construct(string $rRef)
    {
        $this->setRRef($rRef);
    }

    /**
     * Sets the ID of a FileSpec resource.
     *
     * @param string $rRef The id of a FileSpec resource.
     */
    public function setRRef(string $rRef) : void
    {
        $this->rRef = $rRef;
    }

    /**
     * ID of a FileSpec resource.
     *
     * @return string Returns the ID of a FileSpec resource.
     */
    public function getRRef() : string
    {
        return $this->rRef;
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
        $element = $dom->createElement('FileSpecRef');
        $element->setAttribute('rRef', $this->getRRef());

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
        // TODO: Implement fromJDFElement() method.
    }
}
