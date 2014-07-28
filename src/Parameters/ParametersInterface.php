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
     * Get command parameter list
     *
     * @return \GravityMedia\Commander\Parameter\ParameterInterface[]
     */
    public function getCommandParameterList();
}
