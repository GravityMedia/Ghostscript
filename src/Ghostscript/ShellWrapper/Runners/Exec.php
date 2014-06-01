<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\ShellWrapper\Runners;

/**
 * The exec runner object
 *
 * @package Ghostscript\ShellWrapper\Runners
 */
class Exec extends \AdamBrett\ShellWrapper\Runners\Exec
{
    /**
     * Clear output
     *
     * @return \Ghostscript\ShellWrapper\Runners\Exec
     */
    public function clearOutput()
    {
        $this->output = null;
        return $this;
    }
}
