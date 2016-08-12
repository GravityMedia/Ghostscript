<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Device;

use GravityMedia\Ghostscript\Device\CommandLineParameters\EpsTrait;
use GravityMedia\Ghostscript\Device\CommandLineParameters\FontTrait;
use GravityMedia\Ghostscript\Device\CommandLineParameters\IccColorTrait;
use GravityMedia\Ghostscript\Device\CommandLineParameters\InteractionTrait;
use GravityMedia\Ghostscript\Device\CommandLineParameters\OtherTrait;
use GravityMedia\Ghostscript\Device\CommandLineParameters\OutputSelectionTrait;
use GravityMedia\Ghostscript\Device\CommandLineParameters\PageTrait;
use GravityMedia\Ghostscript\Device\CommandLineParameters\RenderingTrait;
use GravityMedia\Ghostscript\Device\CommandLineParameters\ResourceTrait;
use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\Process\Argument as ProcessArgument;
use GravityMedia\Ghostscript\Process\Arguments as ProcessArguments;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

/**
 * The abstract device class
 *
 * @package GravityMedia\Ghostscript\Devices
 */
abstract class AbstractDevice
{
    /**
     * Use command line options
     */
    use CommandLineOptionsTrait;

    /**
     * Use rendering parameters
     */
    use RenderingTrait;

    /**
     * Use page parameters
     */
    use PageTrait;

    /**
     * Use font-related parameters
     */
    use FontTrait;

    /**
     * Use resource-related parameters
     */
    use ResourceTrait;

    /**
     * Use interaction parameters
     */
    use InteractionTrait;

    /**
     * Use device and output selection parameters
     */
    use OutputSelectionTrait;

    /**
     * Use EPS parameters
     */
    use EpsTrait;

    /**
     * Use ICC color parameters
     */
    use IccColorTrait;

    /**
     * Use other parameters
     */
    use OtherTrait;

    /**
     * PostScript commands to be executed via command line when using this device.
     */
    const POSTSCRIPT_COMMANDS = '';

    /**
     * The Ghostscript object
     *
     * @var Ghostscript
     */
    protected $ghostscript;

    /**
     * The arguments object
     *
     * @var ProcessArguments
     */
    private $arguments;

    /**
     * List of input files
     *
     * @var array
     */
    private $inputFiles = [];

    /**
     * Whether to read input from stdin
     *
     * @var bool
     */
    private $inputStdin = false;

    /**
     * Create abstract device object
     *
     * @param Ghostscript      $ghostscript
     * @param ProcessArguments $arguments
     */
    public function __construct(Ghostscript $ghostscript, ProcessArguments $arguments)
    {
        $this->ghostscript = $ghostscript;
        $this->arguments = $arguments;
    }

    /**
     * Get Argument
     *
     * @param string $name
     *
     * @return null|ProcessArgument
     */
    protected function getArgument($name)
    {
        return $this->arguments->getArgument($name);
    }

    /**
     * Whether argument is set
     *
     * @param string $name
     *
     * @return bool
     */
    protected function hasArgument($name)
    {
        return $this->getArgument($name) !== null;
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

        return $argument->getValue();
    }

    /**
     * Set argument
     *
     * @param string $argument
     *
     * @return $this
     */
    protected function setArgument($argument)
    {
        $this->arguments->setArgument($argument);

        return $this;
    }

    /**
     * Set a generic command line parameter with a string value
     *
     * @param string $param the parameter name
     * @param string $value the parameter value
     *
     * @return $this
     */
    public function setStringParameter($param, $value)
    {
        $this->setArgument(sprintf('-s%s=%s', $param, $value));

        return $this;
    }

    /**
     * Set a generic command line parameter with a token value
     *
     * @param string $param the parameter name
     * @param mixed  $value the parameter value
     *
     * @return $this
     */
    public function setTokenParameter($param, $value)
    {
        $this->setArgument(sprintf('-d%s=%s', $param, $value));

        return $this;
    }

    /**
     * Add an input file
     *
     * @param string $inputFile a path to an existing file
     *
     * @throws \RuntimeException if $inputFile does not exist
     *
     * @return $this
     */
    public function addInputFile($inputFile)
    {
        if (!is_file($inputFile)) {
            throw new \RuntimeException('Input file does not exist');
        }
        $this->inputFiles[] = $inputFile;

        return $this;
    }

    /**
     * Add an stdin as input file
     *
     * @return $this
     */
    public function addInputStdin()
    {
        $this->inputStdin = true;

        return $this;
    }

    /**
     * Create process object
     *
     * @param string $inputFile either a path to an existing file or a dash (-) to read input from stdin
     *
     * @throws \RuntimeException if $inputFile does not exist
     *
     * @return Process
     */
    public function createProcess($inputFile = null)
    {
        if ('-' == $inputFile) {
            $this->addInputStdin();
        } elseif (null !== $inputFile) {
            $this->addInputFile($inputFile);
        }

        $arguments = array_values($this->arguments->toArray());
        array_push($arguments, '-c', static::POSTSCRIPT_COMMANDS, '-f');
        if (count($this->inputFiles)) {
            $arguments = array_merge($arguments, $this->inputFiles);
        }
        if ($this->inputStdin) {
            array_push($arguments, '-');
        }
        $this->resetInput();

        $processBuilder = new ProcessBuilder($arguments);
        $processBuilder->setPrefix($this->ghostscript->getOption('bin', Ghostscript::DEFAULT_BINARY));
        $processBuilder->addEnvironmentVariables($this->ghostscript->getOption('env', []));
        $processBuilder->setTimeout($this->ghostscript->getOption('timeout', 60));

        return $processBuilder->getProcess();
    }

    /**
     * Reset the input-related fields of this device.
     * Future processes created from this device will have their own input parameters.
     */
    private function resetInput()
    {
        $this->inputFiles = [];
        $this->inputStdin = false;
    }
}
