<?php
declare(strict_types=1);

/**
 * This file contains the RWC\Caldera\JDF\Vendors\Caldera\JDFFactory class.
 *
 * @author Brian Reich <breich@reich-consulting.net>
 * @copyright Copyright (C) 2018 PrintFrog
 * @license Proprietary
 */
namespace RWC\Caldera\JDF\Vendors\Caldera;

use RWC\Caldera\JDF;
use RWC\Caldera\JDF\JDFException;

/**
 * JDFFactory Creates JDF objects from Caldera JDF XML.
 *
 * This factory can be used in place of the JDF class' static methods to create
 * JDF object graphs containing Caldera-specific elements, such as job status.
 *
 * @package RWC\Caldera\JDF\Vendors\Caldera
 */
class JDFFactory
{
    /**
     * @param \DOMElement $element
     * @return JDF
     * @throws JDF\JDFException
     */
    public function createFromJDFElement(\DOMElement $element) : JDF
    {
        /** @var $jdfObject JDF */
        $jdfObject = JDF::fromJDFElement($element);
        $this->injectCalderaCustomizations($jdfObject, $element);

        return $jdfObject;
    }

    /**
     * Created a JDF object model from a JDF XML document.
     *
     * @param string $jdf The JDF XML document to read.
     * @return JDF Returns the JDF object model.
     * @throws JDFException if the string contains invalid JDF.
     */
    public function fromJDF(string $jdf) : JDF
    {
        if (empty($jdf)) {
            throw new JDFException('JDF document was empty.');
        }

        $domDocument = new \DOMDocument();

        if (! $domDocument->loadXML($jdf)) {
            throw new JDFException('String could not be parsed as valid XML.');
        }

        if ($domDocument->firstChild == null) {
            throw new JDFException('JDF document contained no elements.');
        }

        if ($domDocument->firstChild->nodeName !== 'JDF') {
            throw new JDFException('JDF document did not start with a JDF tag.');
        }

        /** @var $jdfElement \DOMElement */
        $jdfElement = $domDocument->firstChild;
        $jdfDocument = self::createFromJDFElement($jdfElement);

        $this->injectCalderaCustomizations($jdfDocument, $jdfElement);

        return $jdfDocument;
    }

    /**
     * @param JDF $jdfObject
     * @param \DOMElement $jdfElement
     * @throws JDFException
     */
    protected function injectCalderaCustomizations(JDF $jdfObject, \DOMElement $jdfElement) : void
    {
        /** @var $auditPoolEls \DOMNodeList */
        $auditPoolEls = $auditPool = $jdfElement->getElementsByTagName('AuditPool');

        if (count($auditPoolEls) > 0) {
            /** @var $auditPoolsEl \DOMElement */
            $auditPoolsEl = $auditPoolEls[0];
            $resourceAuditEls = $auditPoolsEl->getElementsByTagName('ResourceAudit');

            if (count($resourceAuditEls) > 0) {
                /** @var $resourceAuditEl \DOMElement */
                $resourceAuditEl = $resourceAuditEls[0];
                $runListLinkEls = $resourceAuditEl->getElementsByTagName('RunListLink');

                if (count($runListLinkEls) > 0) {
                    /** @var $runListLink RunListLink */
                    $runListLink = RunListLink::fromJDFElement($runListLinkEls[0]);

                    $jdfObject
                        ->getAuditPool()
                        ->getResourceAudit()
                        ->setRunListLink($runListLink);
                }
            }
        }
    }
}
