<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JMF\Commands\CommandFactory interface.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera\JMF\Commands;

use RWC\Caldera\JMF\IJMFComponent;
use RWC\Caldera\JMF\JMFException;
use RWC\Caldera\JMF\UnsupportedCommandException;

/**
 * Builds Commands from JMF element input.
 *
 * @package RWC\Caldera\JMF\Commands
 */
class CommandFactory
{
    /**
     * Converts the given DOMElement into the IJMFComponent type.
     *
     * @param \DOMElement $element The DOMElement to convert.
     * @return IJMFComponent Returns the converted IJMFComponent type.
     * @throws JMFException If a conversion error occurs.
     */
    public static function fromJMF(\DOMElement $element) : IJMFComponent
    {
        $commandType = $element->getAttribute('Type');

        switch ($commandType) {
            case 'SubmitQueueEntry':
                return SubmitQueueEntry::fromJMF($element);
            case 'RemoveQueueEntry':
                return RemoveQueueEntry::fromJMF($element);
            default:
                throw new UnsupportedCommandException(
                    "$commandType Command Type is not supported."
                );
        }
    }
}
