<?php
/** @noinspection SpellCheckingInspection */
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\AbstractJDFComponent class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera;

use RWC\Caldera\JDF\JDFException;

/**
 * Base class for JDF Components. Provides helper methods for working with JDF.
 *
 * @package RWC\Caldera
 */
abstract class AbstractJDFComponent implements IJDFComponent
{
    /**
     * Returns the value of a tag.
     *
     * The DOMElement passed as the first parameter is the parent element of the
     * tag to select. The $tag parameter specifies the name of the tag to
     * select. The $required parameter specifies whether or not a value is
     * required.  If required is true then the tag must have a value or a
     * JDFException is thrown.  If required is false, if the tag does not exist
     * or the tag does not have a value, then the default value specified by the
     * $default parameter will be returned.
     *
     * @param \DOMElement $parent The parent DOM element.
     * @param string $tag The name of the tag to return.
     * @param bool|null $required True to require an explicit value.
     * @param null|string $default The default value if node has no value.
     *
     * @return null|string Returns the value of the node, or null.
     * @throws JDFException If a value is required and none is found.
     */
    protected static function getTagTextValue(
        \DOMElement $parent,
        string $tag,
        ?bool $required = false,
        ?string $default = null
    ) : ?string {
        $elements = $parent->getElementsByTagName($tag);
        $value = $default;

        if (count($elements) > 0) {
            $element = $elements[0];
            $value = $element->nodeValue;
        }

        if (empty($value)) {
            if ($required) {
                throw new JDFException("Required PrintConfig element $tag not found.");
            }
        }

        return $value;
    }

    /**
     * Returns the value of a tag.
     *
     * The DOMElement passed as the first parameter is the parent element of the
     * tag to select. The $tag parameter specifies the name of the tag to
     * select. The $required parameter specifies whether or not a value is
     * required.  If required is true then the tag must have a value or a
     * JDFException is thrown.  If required is false, if the tag does not exist
     * or the tag does not have a value, then the default value specified by the
     * $default parameter will be returned.
     *
     * @param \DOMElement $parent The parent DOM element.
     * @param string $tag The name of the tag to return.
     * @param bool|null $required True to require an explicit value.
     * @param null|string $default The default value if node has no value.
     *
     * @return null|int Returns the value of the node, or null.
     * @throws JDFException If a value is required and none is found.
     */
    protected static function getTagTimestampValue(
        \DOMElement $parent,
        string $tag,
        ?bool $required = false,
        ?string $default = null
    ) : ?int {

        $value = self::getTagTextValue($parent, $tag, $required, $default);

        // If it's not required, and the value is empty, return null.
        if (! $required) {
            if (empty($value)) {
                return $default;
            }
        }

        // Convert the string to a timestamp.
        return strtotime($value);
    }

    /**
     * Returns the value of a tag.
     *
     * The DOMElement passed as the first parameter is the parent element of the
     * tag to select. The $tag parameter specifies the name of the tag to
     * select. The $required parameter specifies whether or not a value is
     * required.  If required is true then the tag must have a value or a
     * JDFException is thrown.  If required is false, if the tag does not exist
     * or the tag does not have a value, then the default value specified by the
     * $default parameter will be returned.
     *
     * @param \DOMElement $parent The parent DOM element.
     * @param string $tag The name of the tag to return.
     * @param bool|null $required True to require an explicit value.
     * @param null|int $default The default value if node has no value.
     *
     * @return null|int Returns the value of the node, or null.
     * @throws JDFException If a value is required and none is found.
     */
    protected static function getTagIntegerValue(
        \DOMElement $parent,
        string $tag,
        ?bool $required = false,
        ?int $default = null
    ) : ?int {
        $elements = $parent->getElementsByTagName($tag);
        $value = $default;

        if (count($elements) > 0) {
            $element = $elements[0];
            $value = $element->nodeValue;
        }

        if (empty($value)) {
            if ($required) {
                throw new JDFException("Required PrintConfig element $tag not found.");
            }
        }

        return (int) $value;
    }
    /**
     * Returns the value of a tag.
     *
     * The DOMElement passed as the first parameter is the parent element of the
     * tag to select. The $tag parameter specifies the name of the tag to
     * select. The $required parameter specifies whether or not a value is
     * required.  If required is true then the tag must have a value or a
     * JDFException is thrown.  If required is false, if the tag does not exist
     * or the tag does not have a value, then the default value specified by the
     * $default parameter will be returned.
     *
     * @param \DOMElement $parent The parent DOM element.
     * @param string $tag The name of the tag to return.
     * @param bool|null $required True to require an explicit value.
     * @param null|bool $default The default value if node has no value.
     *
     * @return null|bool Returns the value of the node, or null.
     * @throws JDFException If a value is required and none is found.
     */
    protected static function getTagBooleanValue(
        \DOMElement $parent,
        string $tag,
        ?bool $required = false,
        ?bool $default = null
    ) : ?bool {
        $elements = $parent->getElementsByTagName($tag);
        $value = $default;

        if (count($elements) > 0) {
            $element = $elements[0];
            $value = $element->nodeValue;
        }

        if (empty($value)) {
            if ($required) {
                throw new JDFException("Required PrintConfig element $tag not found.");
            }
        }

        return ($value == 'true');
    }

    /**
     * Returns the value of a tag.
     *
     * The DOMElement passed as the first parameter is the parent element of the
     * tag to select. The $tag parameter specifies the name of the tag to
     * select. The $required parameter specifies whether or not a value is
     * required.  If required is true then the tag must have a value or a
     * JDFException is thrown.  If required is false, if the tag does not exist
     * or the tag does not have a value, then the default value specified by the
     * $default parameter will be returned.
     *
     * @param \DOMElement $parent The parent DOM element.
     * @param string $tag The name of the tag to return.
     * @param bool|null $required True to require an explicit value.
     * @param null|float $default The default value if node has no value.
     *
     * @return null|float Returns the value of the node, or null.
     * @throws JDFException If a value is required and none is found.
     */
    protected static function getTagFloatValue(
        \DOMElement $parent,
        string $tag,
        ?bool $required = false,
        ?float $default = null
    ) : ?float {
        $elements = $parent->getElementsByTagName($tag);
        $value = $default;

        if (count($elements) > 0) {
            $element = $elements[0];
            $value = $element->nodeValue;
        }

        if (empty($value)) {
            if ($required) {
                throw new JDFException("Required PrintConfig element $tag not found.");
            }
        }

        return (float) $value;
    }
}
