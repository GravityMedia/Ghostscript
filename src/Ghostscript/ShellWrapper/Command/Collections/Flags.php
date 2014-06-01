<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\ShellWrapper\Command\Collections;

/**
 * The flag collections object
 *
 * @package Ghostscript\ShellWrapper\Command\Collections
 */
class Flags extends \AdamBrett\ShellWrapper\Command\Collections\Flags
{
    /**
     * Get flags as array
     *
     * @return \AdamBrett\ShellWrapper\Command\Flag[]
     */
    public function toArray()
    {
        return array_values($this->flags);
    }
}
