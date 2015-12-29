<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript;

use GravityMedia\Ghostscript\Device\PdfWrite;
use GravityMedia\Ghostscript\Process\Arguments as ProcessArguments;
use Symfony\Component\Process\ProcessBuilder;

/**
 * The Ghostscript class
 *
 * @package GravityMedia\Ghostscript
 */
class Ghostscript
{
    /**
     * The default binary
     */
    const DEFAULT_BINARY = 'gs';

    /**
     * The options
     *
     * @var array
     */
    protected $options;

    /**
     * The version
     *
     * @var string
     */
    protected $version;

    /**
     * Create Ghostscript object
     *
     * @param array $options
     *
     * @throws \RuntimeException
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;

        if (version_compare('9.00', $this->getVersion()) > 0) {
            throw new \RuntimeException('Ghostscript version 9.00 or higher is required');
        }
    }

    /**
     * Get option
     *
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getOption($name, $default = null)
    {
        if (array_key_exists($name, $this->options)) {
            return $this->options[$name];
        }

        return $default;
    }

    /**
     * Create process builder object
     *
     * @param array $arguments
     *
     * @return ProcessBuilder
     */
    protected function createProcessBuilder(array $arguments = [])
    {
        $processBuilder = new ProcessBuilder($arguments);
        $processBuilder->setPrefix($this->getOption('bin', self::DEFAULT_BINARY));
        $processBuilder->addEnvironmentVariables($this->getOption('env', []));

        return $processBuilder;
    }

    /**
     * Get version
     *
     * @throws \RuntimeException
     *
     * @return string
     */
    public function getVersion()
    {
        if (null === $this->version) {
            $process = $this->createProcessBuilder(['--version'])->getProcess();
            $process->run();

            if (!$process->isSuccessful()) {
                throw new \RuntimeException($process->getErrorOutput());
            }

            $this->version = $process->getOutput();
        }

        return $this->version;
    }

    /**
     * Create process arguments object
     *
     * @param array $arguments
     *
     * @return ProcessArguments
     */
    protected function createProcessArguments(array $arguments = [])
    {
        $processArguments = new ProcessArguments();
        $processArguments->addArguments($arguments);

        if ($this->getOption('quiet', true)) {
            $processArguments->addArgument('-q');
        }

        return $processArguments;
    }

    /**
     * Create PDF device object
     *
     * @param null|string $outputFile
     *
     * @return PdfWrite
     */
    public function createPdfDevice($outputFile = null)
    {
        $builder = $this->createProcessBuilder();
        $arguments = $this->createProcessArguments([
            '-dSAFER',
            '-dBATCH',
            '-dNOPAUSE'
        ]);

        $device = new PdfWrite($builder, $arguments);

        if (null !== $outputFile) {
            $device->setOutputFile($outputFile);
        }

        return $device;
    }
}
