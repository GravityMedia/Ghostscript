<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Process;

/**
 * The arguments class.
 *
 * @package GravityMedia\Ghostscript\Process
 */
class Arguments
{
    /**
     * The argument objects.
     *
     * @var Argument[]
     */
    protected $arguments;

    /**
     * Create arguments object.
     */
    public function __construct()
    {
        $this->arguments = [];
    }

    /**
     * Return arguments as array of strings.
     *
     * @return string[]
     */
    public function toArray()
    {
        return array_values(array_map(function (Argument $argument) {
            return $argument->toString();
        }, $this->arguments));
    }

    /**
     * Convert argument to argument object.
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
     * Get argument object.
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

    /**
     * Add argument.
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
     * Add all arguments.
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
     * Hash the name.
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
     * Set argument.
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
     * Set all arguments.
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
}
