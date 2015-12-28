<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Process;

/**
 * The process arguments class
 *
 * @package GravityMedia\Ghostscript\Process
 */
class Arguments
{
    /**
     * The arguments
     *
     * @var Argument[]
     */
    protected $arguments;

    /**
     * Create process arguments object
     */
    public function __construct()
    {
        $this->arguments = [];
    }

    /**
     * Return process arguments as array
     *
     * @return array
     */
    public function toArray()
    {
        return array_values(array_map(function (Argument $argument) {
            return $argument->toString();
        }, $this->arguments));
    }

    /**
     * Convert argument to process argument
     *
     * @param string|Argument $argument
     *
     * @throws \InvalidArgumentException
     *
     * @return Argument
     */
    protected function convertArgument($argument)
    {
        if (is_string($argument)) {
            $argument = Argument::fromString($argument);
        }

        if (!$argument instanceof Argument) {
            throw new \InvalidArgumentException('Invalid argument');
        }

        return $argument;
    }

    /**
     * Add process argument
     *
     * @param string|Argument $argument
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function addArgument($argument)
    {
        $this->arguments[] = $this->convertArgument($argument);

        return $this;
    }

    /**
     * Add process arguments
     *
     * @param array $arguments
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function addArguments(array $arguments)
    {
        foreach ($arguments as $argument) {
            $this->addArgument($argument);
        }

        return $this;
    }

    /**
     * Hash the name
     *
     * @param string $name
     *
     * @return string
     */
    protected function hashName($name)
    {
        return strtolower(ltrim($name, '-'));
    }

    /**
     * Set process argument
     *
     * @param string|Argument $argument
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setArgument($argument)
    {
        $argument = $this->convertArgument($argument);
        $hash = $this->hashName($argument->getName());

        $this->arguments[$hash] = $argument;

        return $this;
    }

    /**
     * Set process arguments
     *
     * @param array $arguments
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setArguments(array $arguments)
    {
        foreach ($arguments as $argument) {
            $this->setArgument($argument);
        }

        return $this;
    }

    /**
     * Get process argument
     *
     * @param string $name
     *
     * @return Argument|null
     */
    public function getArgument($name)
    {
        $hash = $this->hashName($name);

        if (isset($this->arguments[$hash])) {
            return $this->arguments[$hash];
        }

        return null;
    }
}
