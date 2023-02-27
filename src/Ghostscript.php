<?php
/**
 * This file is part of the Ghostscript package.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript;

use GravityMedia\Ghostscript\Device\BoundingBoxInfo;
use GravityMedia\Ghostscript\Device\Inkcov;
use GravityMedia\Ghostscript\Device\NoDisplay;
use GravityMedia\Ghostscript\Device\PdfInfo;
use GravityMedia\Ghostscript\Device\PdfWrite;
use GravityMedia\Ghostscript\Process\Arguments;
use Symfony\Component\Process\Process;

/**
 * The Ghostscript class.
 *
 * @package GravityMedia\Ghostscript
 */
class Ghostscript implements GhostscriptInterface
{
    /**
     * The default binary.
     */
    const DEFAULT_BINARY = 'gs';

    /**
     * The versions.
     *
     * @var string[]
     */
    protected static $versions = [];

    /**
     * The options.
     *
     * @var array
     */
    protected $options = [];


    /**
     * Create Ghostscript object.
     *
     * @param array $options
     *
     * @throws \RuntimeException
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * Get option.
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
     * Get process to identify version.
     *
     * @param string $binary
     *
     * @return Process
     */
    protected function createProcessToIdentifyVersion($binary)
    {
        return new Process([$binary, '--version']);
    }

    /**
     * Get version.
     *
     * @throws \RuntimeException
     *
     * @return string
     */
    public function getVersion()
    {
        $binary = $this->getOption('bin', static::DEFAULT_BINARY);

        if (!isset(static::$versions[$binary])) {
            $process = $this->createProcessToIdentifyVersion($binary);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new \RuntimeException($process->getErrorOutput());
            }

            static::$versions[$binary] = $process->getOutput();
        }

        return static::$versions[$binary];
    }

    /**
     * Create arguments object.
     *
     * @return Arguments
     */
    protected function createArguments()
    {
        $arguments = new Arguments();

        if ($this->getOption('quiet', true)) {
            $arguments->addArgument('-q');
        }

        return $arguments;
    }

    /**
     * Create PDF device object.
     *
     * @param null|string $outputFile
     *
     * @return PdfWrite
     */
    public function createPdfDevice($outputFile = null)
    {
        $device = new PdfWrite($this, $this->createArguments());
        $device
            ->setSafer()
            ->setBatch()
            ->setNoPause();

        if (null === $outputFile) {
            $outputFile = '-';
        }

        $device->setOutputFile($outputFile);

        return $device;
    }

    /**
     * Create no display device object.
     *
     * @return NoDisplay
     */
    public function createNoDisplayDevice()
    {
        return new NoDisplay($this, $this->createArguments());
    }

    /**
     * Create PDF info device object.
     *
     * @param string $pdfInfoPath Path to toolbin/pdf_info.ps
     *
     * @return PdfInfo
     */
    public function createPdfInfoDevice($pdfInfoPath)
    {
        return new PdfInfo($this, $this->createArguments(), $pdfInfoPath);
    }

    /**
     * Create bounding box info device object.
     *
     * @return BoundingBoxInfo
     */
    public function createBoundingBoxInfoDevice()
    {
        $device = new BoundingBoxInfo($this, $this->createArguments());
        $device
            ->setSafer()
            ->setBatch()
            ->setNoPause();

        return $device;
    }

    /**
     * Create inkcov device object
     *
     * @return Inkcov
     */
    public function createInkcovDevice()
    {
        $this->options['quiet'] = false;

        $arguments = $this->createArguments();
        $arguments->addArgument('-o');
        $arguments->addArgument('-');

        $device = new Inkcov($this, $arguments);

        return $device;
    }
}
