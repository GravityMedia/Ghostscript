<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\Ghostscript\Device\CommandLineParameters;

/**
 * The EPS parameters trait
 *
 * @package GravityMedia\Ghostscript\Device\CommandLineParameters
 * @link http://ghostscript.com/doc/current/Use.htm#EPS_parameters
 */
trait EpsTrait
{
    /**
     * Get argument value
     *
     * @param string $name
     *
     * @return null|string
     */
    abstract protected function getArgumentValue($name);

    /**
     * Set argument
     *
     * @param string $argument
     *
     * @return $this
     */
    abstract protected function setArgument($argument);

    /*
     * TODO

-dEPSCrop
    Crop an EPS file to the bounding box. This is useful when converting an EPS file to a bitmap.

-dEPSFitPage
    Resize an EPS file to fit the page. This is useful for shrinking or enlarging an EPS file to fit the paper size when printing.

    This option is also set by the -dFitPage option.

-dNOEPS
    Prevent special processing of EPS files. This is useful when EPS files have incorrect Document Structuring Convention comments.

     */
}
