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
     * Get parameters as flags
     *
     * @return \Ghostscript\ShellWrapper\Command\Collections\Flags
     */
    public function toFlags();
}
