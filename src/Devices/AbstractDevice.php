<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Devices;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

/**
 * The abstract device class
 *
 * @package GravityMedia\Ghostscript
 */
abstract class AbstractDevice
{
    /**
     * The process builder object
     *
     * @var Process
     */
    protected $builder;

    /**
     * The arguments
     *
     * @var array
     */
    protected $arguments;

    /**
     * Create abstract device object
     *
     * @param ProcessBuilder $builder
     * @param array          $arguments
     */
    public function __construct(ProcessBuilder $builder, array $arguments = [])
    {
        $this->builder = $builder;
        $this->arguments = $arguments;
    }

    /**
     * Create process
     *
     * @param string $inputFile
     *
     * @throws \RuntimeException
     *
     * @return Process
     */
    public function createProcess($inputFile)
    {
        if (!is_file($inputFile)) {
            throw new \RuntimeException('Input file does not exist');
        }

        $arguments = array_values($this->arguments);
        array_push($arguments, '-f', $inputFile);

        return $this->builder
            ->setArguments($arguments)
            ->getProcess();
    }

    /**
     * Get argument
     *
     * @param string $name
     *
     * @return null|string
     */
    protected function getArgument($name)
    {
        if (array_key_exists($name, $this->arguments)) {
            return $this->arguments[$name];
        }

        return null;
    }

    /**
     * Get argument value
     *
     * @param string $name
     *
     * @return null|string
     */
    protected function getArgumentValue($name)
    {
        $argument = $this->getArgument($name);
        if (null === $argument) {
            return null;
        }

        $tuple = explode('=', $argument, 2);
        if (count($tuple) < 2) {
            return null;
        }


        return array_pop($tuple);
    }

    /**
     * Set argument
     *
     * @param string      $name
     * @param string      $option
     * @param null|string $value
     *
     * @return $this
     */
    protected function setArgument($name, $option, $value = null)
    {
        $argument = $option;
        if (null !== $value) {
            $argument .= '=' . $value;
        }

        $this->arguments[$name] = $argument;

        return $this;
    }
}
