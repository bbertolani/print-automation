<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JMF\IJMFComponent interface.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JMF;

/**
 * An element of a JMF document.
 *
 * @package RWC\Caldera\JMF
 */
interface IJMFComponent
{
    /**
     * Converts the IJMFComponent into a DOMElement for inclusion in a JMF Document.
     *
     * @param \DOMDocument $document The DOMDocument used to create the element.
     * @return \DOMElement Returns the converted element.
     * @throws JMFException If a conversion error occurs.
     */
    public function getJMF(\DOMDocument $document) : \DOMElement;

    /**
     * Converts the given DOMElement into the IJMFComponent type.
     *
     * @param \DOMElement $element The DOMElement to convert.
     * @return IJMFComponent Returns the converted IJMFComponent type.
     * @throws JMFException If a conversion error occurs.
     */
    public static function fromJMF(\DOMElement $element) : IJMFComponent;
}
