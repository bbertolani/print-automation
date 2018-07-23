<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JMF\Notification class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JMF;

/**
 * Class Notification
 * @package RWC\Caldera
 */
class Notification implements IJMFComponent
{
    /**
     * "Error" or "Warning"
     *
     * @var string
     */
    protected $class;

    /**
     * Error message.
     *
     * @var string
     */
    protected $comment;

    /**
     * Notification constructor.
     *
     * @param string $class "Error" or "Warning"
     * @param null|string $comment Error message.
     */
    public function __construct(string $class, ?string $comment = null)
    {
        $this->setClass($class);
        $this->setComment($comment);
    }

    /**
     * "Error" or "Warning"
     *
     * @param string $class "Error" or "Warning"
     */
    public function setClass(string $class) : void
    {
        $this->class = $class;
    }

    /**
     * "Error" or "Warning"
     *
     * @return string "Error" or "Warning"
     */
    public function getClass() : string
    {
        return $this->class;
    }

    /**
     * Error message.
     *
     * @param null|string $comment Error message.
     */
    public function setComment(?string $comment = null) : void
    {
        $this->comment = $comment;
    }

    /**
     * Error message.
     *
     * @return null|string Error message.
     */
    public function getComment() : ?string
    {
        return $this->comment;
    }

    /**
     * Converts the IJMFComponent into a DOMElement for inclusion in a JMF Document.
     *
     * @param \DOMDocument $document The DOMDocument used to create the element.
     * @return \DOMElement Returns the converted element.
     */
    public function getJMF(\DOMDocument $document): \DOMElement
    {
        $element = $document->createElement('Notification');
        $element->setAttribute('Class', $this->getClass());

        if ($this->getComment() != null) {
            $commentEl = $document->createElement('Comment');
            $commentEl->appendChild($document->createTextNode($this->getComment()));
            $element->appendChild($commentEl);
        }

        return $element;
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
        $class = $element->getAttribute('Class');
        $comment = null;
        $commentEl = $element->getElementsByTagName('Comment');

        if (empty($class)) {
            throw new JMFException('Required attribute "Class" not found.');
        }

        // Null comment is not set.
        if ($commentEl->length > 0) {
            /**
             * @var $commentEl \DOMElement
             */
            $commentEl = $commentEl[0];

            $comment = $commentEl->textContent;
        }

        return new Notification($class, $comment);
    }
}
