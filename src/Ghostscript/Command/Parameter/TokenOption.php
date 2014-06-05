<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\Command\Parameter;

use Commander\Command\Parameter\AbstractOption;
use Commander\Command\Parameter\ParameterInterface;

/**
 * The token option object
 *
 * @package Ghostscript\Command\Parameter
 */
class TokenOption extends AbstractOption implements ParameterInterface
{
    /**
     * Prefix
     */
    const PREFIX = '-d';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var null|\Commander\Command\Parameter\Argument
     */
    protected $argument;

    /**
     * @var string
     */
    protected $delimiter;

    /**
     * Constructor
     *
     * @param string $name
     * @param null|\Commander\Command\Parameter\Argument $argument
     */
    public function __construct($name, $argument = null)
    {
        $this->name = $name;
        $this->argument = $argument;
        $this->delimiter = '=';
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

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get argument
     *
     * @return null|\Commander\Command\Parameter\Argument
     */
    public function getArgument()
    {
        return $this->argument;
    }

    /**
     * Get delimiter
     *
     * @return string
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }
}
