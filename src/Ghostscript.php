<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript;

use GravityMedia\Commander\Commander;
use GravityMedia\Commander\Argument;
use GravityMedia\Ghostscript\Device\DeviceInterface as Device;
use GravityMedia\Ghostscript\Parameters\ParametersInterface as Parameters;
use Symfony\Component\Process\Process;

/**
 * The Ghostscript object
 *
 * @package GravityMedia\Ghostscript
 */
class Ghostscript
{
    /**
     * The default Ghostscript command
     */
    const DEFAULT_GS_COMMAND = 'gs';

    /**
     * @var array
     */
    protected $options;

    /**
     * @var \GravityMedia\Ghostscript\Parameters\ParametersInterface[]
     */
    protected $parameters;

    /**
     * @var \GravityMedia\Ghostscript\Device\DeviceInterface
     */
    protected $device;

    /**
     * @var string
     */
    protected $joboptions;

    /**
     * The Ghostscript constructor method
     *
     * @param array $options
     *
     * @throws \RuntimeException
     */
    public function __construct(array $options = array())
    {
        $this->options = $options;
        $this->parameters = array();

        $commander = new Commander($this->getOption('command', self::DEFAULT_GS_COMMAND));
        $commander->addArgument(new Argument\LongOption('version'));

        $process = new Process($commander);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput(), $process->getExitCode());
        }

        if (version_compare('9.00', $process->getOutput()) > 0) {
            throw new \RuntimeException('Ghostscript version 9.00 or higher is required');
        }
    }

    /**
     * Get option
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function getOption($key, $default = null)
    {
        if (array_key_exists($key, $this->options)) {
            return $this->options[$key];
        }
        return $default;
    }

    /**
     * Add parameters
     *
     * @param \GravityMedia\Ghostscript\Parameters\ParametersInterface $parameters
     *
     * @return \GravityMedia\Ghostscript\Ghostscript
     */
    public function addParameters(Parameters $parameters)
    {
        $this->parameters[] = $parameters;
        return $this;
    }

    /**
     * Set device
     *
     * @param \GravityMedia\Ghostscript\Device\DeviceInterface $device
     *
     * @return \GravityMedia\Ghostscript\Ghostscript
     */
    public function setDevice(Device $device)
    {
        $this->device = $device;
        return $this;
    }

    /**
     * Set joboption
     *
     * @param string $joboptions
     *
     * @return \GravityMedia\Ghostscript\Ghostscript
     */
    public function setJoboptions($joboptions)
    {
        $this->joboptions = $joboptions;
        return $this;
    }

    /**
     * Build command
     *
     * @param string $inputFile
     *
     * @return string
     */
    public function buildCommand($inputFile)
    {
        $commander = new Commander($this->getOption('command', self::DEFAULT_GS_COMMAND));

        foreach ($this->parameters as $parameters) {
            foreach ($parameters->getParametersAsArguments() as $argument) {
                $commander->addArgument($argument);
            }
        }

        if ($this->device instanceof Device) {
            foreach ($this->device->getDeviceOptionsAsArguments() as $argument) {
                $commander->addArgument($argument);
            }
        }

        if (null !== $this->joboptions) {
            $commander
                ->addArgument(new Argument\ShortOption('c', 'save pop'))
                ->addArgument(new Argument\ShortOption('f', $this->joboptions));
        }

        return (string)$commander
            ->addArgument(new Argument\Argument($inputFile));
    }

    /**
     * Create process object
     *
     * @param string $inputFile
     *
     * @return \Symfony\Component\Process\Process
     */
    public function createProcess($inputFile)
    {
        return new Process($this->buildCommand($inputFile));
    }
}
