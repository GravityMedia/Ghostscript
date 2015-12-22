<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Devices;

use Symfony\Component\Process\ProcessBuilder;

/**
 * The PDF write device class
 *
 * @package GravityMedia\Ghostscript
 */
class PdfWrite extends AbstractDevice
{
    /**
     * The default compatibility level
     */
    const DEFAULT_COMPATIBILITY_LEVEL = '1.4';

    /**
     * Create PDF write device object
     *
     * @param ProcessBuilder $builder
     * @param array          $arguments
     */
    public function __construct(ProcessBuilder $builder, array $arguments = [])
    {
        parent::__construct($builder, $arguments);

        $this->setArgument('device', '-sDEVICE', 'pdfwrite');
        $this->setCompatibilityLevel(self::DEFAULT_COMPATIBILITY_LEVEL);
    }

    /**
     * Get output file
     *
     * @return null|string
     */
    public function getOutputFile()
    {
        return $this->getArgumentValue('output-file');
    }

    /**
     * Set output file
     *
     * @param string $outputFile
     *
     * @return $this
     */
    public function setOutputFile($outputFile)
    {
        $this->setArgument('output-file', '-sOutputFile', $outputFile);

        return $this;
    }

    /**
     * Get compatibility level
     *
     * @return null|string
     */
    public function getCompatibilityLevel()
    {
        return $this->getArgumentValue('compatibility-level');
    }

    /**
     * Set compatibility level
     *
     * @param string $compatibilityLevel
     *
     * @return $this
     */
    public function setCompatibilityLevel($compatibilityLevel)
    {
        $this->setArgument('compatibility-level', '-dCompatibilityLevel', $compatibilityLevel);

        return $this;
    }
}
