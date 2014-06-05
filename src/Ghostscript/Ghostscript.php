<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript;

use Commander\Command;
use Commander\Runner\Exec as Shell;
use Commander\Runner\ExitCode;
use Ghostscript\Device\DeviceInterface as Device;
use Ghostscript\Parameters\ParametersInterface as Parameters;

/**
 * The Ghostscript object
 *
 * @package Ghostscript
 */
class Ghostscript
{
    /**
     * The default Ghostscript command
     */
    const DEFAULT_GS_COMMAND = 'gs';

    /**
     * @var \Commander\Runner\Exec
     */
    protected $shell;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var \Ghostscript\Parameters\ParametersInterface[]
     */
    protected $parameters;

    /**
     * @var \Ghostscript\Device\DeviceInterface
     */
    protected $device;

    /**
     * The Ghostscript constructor method
     *
     * @param array $options
     *
     * @throws \RuntimeException
     */
    public function __construct(array $options = array())
    {
        $this->shell = new Shell();
        $this->options = $options;
        $this->parameters = array();

        $command = new Command($this->getOption('command', self::DEFAULT_GS_COMMAND), array(
            'redirections' => array(
                '2>/dev/null'
            )
        ));
        $command->addLongOption(new Command\Parameter\LongOption('version'));
        $version = $this->shell->run($command);

        if (version_compare('9.00', $version) > 0) {
            throw new \RuntimeException('Ghostscript version 9.0 or higher is required');
        }
    }

    /**
     * Get shell
     *
     * @return \Commander\Runner\Exec
     */
    public function getShell()
    {
        return $this->shell;
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
     * @param \Ghostscript\Parameters\ParametersInterface $parameters
     *
     * @return \Ghostscript\Ghostscript
     */
    public function addParameters(Parameters $parameters)
    {
        $this->parameters[] = $parameters;
        return $this;
    }

    /**
     * Set device
     *
     * @param \Ghostscript\Device\DeviceInterface $device
     *
     * @return \Ghostscript\Ghostscript
     */
    public function setDevice(Device $device)
    {
        $this->device = $device;
        return $this;
    }

    /**
     * Get command
     *
     * @param $inputFile
     *
     * @return \Commander\Command
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

        $command->addArgument(new Command\Parameter\Argument($inputFile));

        return $command;
    }

    /**
     * Process input file
     *
     * @param \Commander\Command $command
     *
     * @return \Ghostscript\Ghostscript
     * @throws \RuntimeException
     */
    public function process(Command $command)
    {
        $this->shell->clearOutputBuffer()->run($command);

        if (ExitCode::SUCCESS !== $this->shell->getExitCode()->getCode()) {
            throw new \RuntimeException(implode("\n", $this->shell->getOutputBuffer()));
        }

        return $this;
    }
}
