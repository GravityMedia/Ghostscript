<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript;

use GravityMedia\Commander\Command;
use GravityMedia\Commander\Event\OutputEvent;
use GravityMedia\Commander\Parameter;
use GravityMedia\Commander\Runner\Exec as Runner;
use GravityMedia\Ghostscript\Device\DeviceInterface as Device;
use GravityMedia\Ghostscript\Parameters\ParametersInterface as Parameters;

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
     * @var callable
     */
    private $errorOutputListener;

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
        $this->errorOutputListener = function (OutputEvent $event) {
            throw new \RuntimeException(implode("\n", $event->getOutput()), $event->getExitCode()->getCode());
        };

        $command = new Command($this->getOption('command', self::DEFAULT_GS_COMMAND), array(
            'redirections' => array(
                '2>/dev/null'
            )
        ));
        $command->addParameter(new Parameter\LongOption('version'));

        $runner = new Runner();
        $runner
            ->addErrorOutputListener($this->errorOutputListener)
            ->addOutputListener(function (OutputEvent $event) {
                $output = $event->getOutput();
                $version = array_pop($output);
                if (version_compare('9.00', $version) > 0) {
                    throw new \RuntimeException('Ghostscript version 9.00 or higher is required');
                }
            })
            ->run($command);
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
     * Get command
     *
     * @param string $inputFile
     *
     * @return \GravityMedia\Commander\Command
     */
    public function getCommand($inputFile)
    {
        $command = new Command($this->getOption('command', self::DEFAULT_GS_COMMAND));

        foreach ($this->parameters as $parameters) {
            foreach ($parameters->getCommandParameterList() as $parameter) {
                $command->addParameter($parameter);
            }
        }

        if ($this->device instanceof Device) {
            foreach ($this->device->getCommandParameterList() as $parameter) {
                $command->addParameter($parameter);
            }
        }

        if (null !== $this->joboptions) {
            $command
                ->addParameter(new Parameter\ShortOption('c', 'save pop'))
                ->addParameter(new Parameter\ShortOption('f', $this->joboptions));
        }

        $command->addParameter(new Parameter\Argument($inputFile));

        return $command;
    }

    /**
     * Process input file
     *
     * @param \GravityMedia\Commander\Command $command
     *
     * @return \GravityMedia\Commander\Command
     * @throws \RuntimeException
     */
    public function process(Command $command)
    {
        $runner = new Runner();
        $runner
            ->addErrorOutputListener($this->errorOutputListener)
            ->run($command);
        return $command;
    }
}
