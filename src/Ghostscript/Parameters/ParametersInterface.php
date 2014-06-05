<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\Parameters;

/**
 * Interface for parameters
 *
 * @package Ghostscript\Parameters
 */
interface ParametersInterface
{
    /**
     * Get command parameter list
     *
     * @return \Commander\Command\ParameterList
     */
    public function getCommandParameterList();
}
