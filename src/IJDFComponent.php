<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\IJDFComponent interface.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera;

use RWC\Caldera\JDF\JDFException;

/**
 * A subsection of a JDF file (job definition).
 *
 * Interface IJDFComponent
 * @package RWC\Caldera\Commands
 */
interface IJDFComponent
{
    /**
     * Generates a DOMElement representing the JDFComponent.
     *
     * @param \DOMDocument $dom The DOMDocument use to generate the element.
     *
     * @return \DOMElement Returns the generated DOMElement for the component.
     */
    public function getJDF(\DOMDocument $dom) : \DOMElement;

    /**
     * Creates a new instance of the IJDFComponent from a DOMElement.
     *
     * @param \DOMElement $element The DOMElement containing the component definition.
     * @return IJDFComponent Returns the Component.
     * @throws JDFException if the DOMElement does not define a valid component descriptor.
     */
    public static function fromJDFElement(\DOMElement $element) : IJDFComponent;
}
