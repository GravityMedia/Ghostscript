<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\ShellWrapper\Command;

use AdamBrett\ShellWrapper\Command\Flag;

/**
 * The string flag object
 *
 * @package Ghostscript\ShellWrapper\Command
 */
class StringFlag extends Flag
{
    /**
     * The string flag prefix
     */
    const PREFIX = '-s';

    /**
     * The string flag constructor
     *
     * @param string $name
     * @param mixed  $value
     */
    public function __construct($name, $value)
    {
        parent::__construct($name, strval($value));
    }

    /**
     * Returns the string representation of the string flag
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
