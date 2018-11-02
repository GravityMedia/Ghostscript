<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Device;

use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\Input;
use GravityMedia\Ghostscript\Process\Argument;
use GravityMedia\Ghostscript\Process\Arguments;
use Symfony\Component\Process\Process;

/**
 * The abstract device class.
 *
 * @package GravityMedia\Ghostscript\Devices
 */
abstract class AbstractDevice
{
    /**
     * Use command line options.
     */
    use CommandLineParametersTrait;

    /**
     * Use rendering parameters.
     */
    use CommandLineParameters\RenderingTrait;

    /**
     * Use page parameters.
     */
    use CommandLineParameters\PageTrait;

    /**
     * Use font-related parameters.
     */
    use CommandLineParameters\FontTrait;

    /**
     * Use resource-related parameters.
     */
    use CommandLineParameters\ResourceTrait;

    /**
     * Use interaction parameters.
     */
    use CommandLineParameters\InteractionTrait;

    /**
     * Use device and output selection parameters.
     */
    use CommandLineParameters\OutputSelectionTrait;

    /**
     * Use EPS parameters.
     */
    use CommandLineParameters\EpsTrait;

    /**
     * Use ICC color parameters.
     */
    use CommandLineParameters\IccColorTrait;

    /**
     * Use other parameters.
     */
    use CommandLineParameters\OtherTrait;

    /**
     * The Ghostscript object.
     *
     * @var Ghostscript
     */
    private $ghostscript;

    /**
     * The arguments object.
     *
     * @var Arguments
     */
    private $arguments;

    /**
     * Create abstract device object.
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
     * Get argument.
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
     * Whether argument is set.
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
     * Get argument value.
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
     * Set argument.
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
     * @param null|string|resource|Input $input
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
     * Create process arguments.
     *
     * @param Input $input
     *
     * @throws \RuntimeException
     *
     * @return array
     */
    protected function createProcessArguments(Input $input)
    {
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

        return $arguments;
    }

    /**
     * Create process object.
     *
     * @param null|string|resource|Input $input
     *
     * @throws \RuntimeException
     *
     * @return Process
     */
    public function createProcess($input = null)
    {
        $input = $this->sanitizeInput($input);

        $arguments = $this->createProcessArguments($input);
        array_unshift(
            $arguments,
            $this->ghostscript->getOption('bin', Ghostscript::DEFAULT_BINARY)
        );

        return new Process(
            $arguments,
            $this->ghostscript->getOption('cwd'),
            $this->ghostscript->getOption('env', []),
            $input->getProcessInput(),
            $this->ghostscript->getOption('timeout', 60)
        );
    }
}
