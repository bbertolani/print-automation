<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\AuditPool\Created class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */

namespace RWC\Caldera;

/**
 * Base configuration for the Caldera package.
 *
 * @package RWC\Caldera
 */
class Configurations
{
    /**
     * The default JDF version.
     *
     * @var float
     */
    const DEFAULT_JDF_VERSION = 1.4;

    /**
     * The XML ICS Versions supported.
     *
     * @var string
     */
    const XML_ICS_VERSIONS = 'Base_L2-1.4';

    /**
     * The JDF XML namespace.
     *
     * @var string
     */
    const XML_JDF_NAMESPACE = 'http://www.CIP4.org/JDFSchema_1_1';

    /**
     * The XML XSI namespace.
     *
     * @var string
     */
    const XML_XSI_NAMESPACE = 'http://www.w3.org/2001/XMLSchema-instance';

    /**
     * The XML Caldera namespace (for print configs).
     *
     * @var string
     */
    const XML_CALDERA_NAMESPACE = 'http://www.caldera.com/jdf';
}
