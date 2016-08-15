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
use GravityMedia\Ghostscript\Input;
use GravityMedia\Ghostscript\Process\Argument;
use GravityMedia\Ghostscript\Process\Arguments;
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
    use CommandLineParametersTrait;

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
     * The Ghostscript object
     *
     * @var Ghostscript
     */
    private $ghostscript;

    /**
     * The arguments object
     *
     * @var Arguments
     */
    private $arguments;

    /**
     * Create abstract device object
     *
     * @param Ghostscript $ghostscript
     * @param Arguments   $arguments
     */
    public function __construct(Ghostscript $ghostscript, Arguments $arguments)
    {
        $this->ghostscript = $ghostscript;
        $this->arguments = $arguments;
    }

    /**
     * Get Argument
     *
     * @param string $name
     *
     * @return null|Argument
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
        return null !== $this->getArgument($name);
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
     * Sanitize input.
     *
     * @param mixed $input
     *
     * @return Input
     */
    protected function sanitizeInput($input)
    {
        if (null === $input) {
            $input = $this->ghostscript->getOption('input', new Input());
        }

        if ($input instanceof Input) {
            return $input;
        }

        $instance = new Input();

        if (is_resource($input)) {
            return $instance->setProcessInput($input);
        }

        if (file_exists($input)) {
            return $instance->addFile($input);
        }

        return $instance->setPostScriptCode((string)$input);
    }

    /**
     * Create process object
     *
     * @param mixed $input
     *
     * @throws \RuntimeException
     *
     * @return Process
     */
    public function createProcess($input = null)
    {
        $input = $this->sanitizeInput($input);
        $arguments = array_values($this->arguments->toArray());

        if (null !== $input->getPostScriptCode()) {
            array_push($arguments, '-c', $input->getPostScriptCode());
        }

        if (count($input->getFiles()) > 0) {
            array_push($arguments, '-f');
            foreach ($input->getFiles() as $file) {
                if (!is_file($file)) {
                    throw new \RuntimeException('Input file does not exist');
                }

                array_push($arguments, $file);
            }
        }

        if (null !== $input->getProcessInput()) {
            array_push($arguments, '-');
        }

        $processBuilder = new ProcessBuilder($arguments);
        $processBuilder->setPrefix($this->ghostscript->getOption('bin', Ghostscript::DEFAULT_BINARY));
        $processBuilder->addEnvironmentVariables($this->ghostscript->getOption('env', []));
        $processBuilder->setTimeout($this->ghostscript->getOption('timeout', 60));
        $processBuilder->setInput($input->getProcessInput());

        return $processBuilder->getProcess();
    }
}
