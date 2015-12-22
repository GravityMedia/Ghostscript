<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript;

use GravityMedia\Ghostscript\Devices\PdfWrite;
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
     * Create Ghostscript object
     *
     * @param array $options
     *
     * @throws \RuntimeException
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;

        $builder = new ProcessBuilder(['--version']);
        $builder->setPrefix($this->getOption('bin', self::DEFAULT_BINARY));
        $builder->addEnvironmentVariables($this->getOption('env', []));

        $process = $builder->getProcess();
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        if (version_compare('9.00', $process->getOutput()) > 0) {
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
     * Create PDF device object
     *
     * @param null|string $outputFile
     *
     * @return PdfWrite
     */
    public function createPdfDevice($outputFile = null)
    {
        $arguments = [
            '-dSAFER',
            '-dBATCH',
            '-dNOPAUSE'
        ];

        if ($this->getOption('quiet', true)) {
            $arguments[] = '-q';
        }

        $builder = new ProcessBuilder();
        $builder->setPrefix($this->getOption('bin', self::DEFAULT_BINARY));
        $builder->addEnvironmentVariables($this->getOption('env', []));

        $device = new PdfWrite($builder, $arguments);

        if (null !== $outputFile) {
            $device->setOutputFile($outputFile);
        }

        return $device;
    }
}
