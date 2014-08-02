<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Argument;

use GravityMedia\Commander\Argument\AbstractOption;

/**
 * The token option object
 *
 * @package GravityMedia\Ghostscript\Command\Parameter
 */
class TokenOption extends AbstractOption
{
    /**
     * Prefix
     */
    const PREFIX = '-d';

    /**
     * Constructor
     *
     * @param string $name
     * @param null|string|\GravityMedia\Commander\Argument\Argument $argument
     */
    public function __construct($name, $argument = null)
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
