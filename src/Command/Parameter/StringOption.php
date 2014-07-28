<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Command\Parameter;

use GravityMedia\Commander\Parameter\AbstractOption;

/**
 * The string option object
 *
 * @package GravityMedia\Ghostscript\Command\Parameter
 */
class StringOption extends AbstractOption
{
    /**
     * Prefix
     */
    const PREFIX = '-s';

    /**
     * Constructor
     *
     * @param string $name
     * @param string|\GravityMedia\Commander\Parameter\Argument $argument
     */
    public function __construct($name, $argument)
    {
        parent::__construct($name, $argument);
        $this->setDelimiter('=');
    }

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return self::PREFIX;
    }
}
