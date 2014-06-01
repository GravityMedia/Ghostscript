<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\ShellWrapper\Command;

use AdamBrett\ShellWrapper\Command\Flag;

/**
 * The token flag object
 *
 * @package Ghostscript\ShellWrapper\Command
 */
class TokenFlag extends Flag
{
    /**
     * The token flag prefix
     */
    const PREFIX = '-d';

    /**
     * Returns the string representation of the token flag
     *
     * @return string
     */
    public function __toString()
    {
        if (null === $this->value) {
            return sprintf('%s%s', static::PREFIX, $this->name);
        }
        return sprintf('%s%s=%s', static::PREFIX, $this->name, escapeshellarg($this->value));
    }
}
