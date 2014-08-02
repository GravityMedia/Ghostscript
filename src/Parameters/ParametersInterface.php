<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Parameters;

/**
 * Interface for parameters
 *
 * @package GravityMedia\Ghostscript\Parameters
 */
interface ParametersInterface
{
    /**
     * Get parameters as arguments
     *
     * @return \GravityMedia\Commander\Argument\ArgumentInterface[]
     */
    public function getParametersAsArguments();
}
