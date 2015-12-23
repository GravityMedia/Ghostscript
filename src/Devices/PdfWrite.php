<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schr�der <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Devices;

use GravityMedia\Ghostscript\Process\Arguments as ProcessArguments;
use Symfony\Component\Process\ProcessBuilder;

/**
 * The PDF write device class
 *
 * @package GravityMedia\Ghostscript\Devices
 */
class PdfWrite extends AbstractDevice
{
    /**
     * User distiller parameters
     */
    use DistillerParametersTrait;

    /**
     * The default compatibility level
     */
    const DEFAULT_COMPATIBILITY_LEVEL = '1.4';

    /**
     * Create PDF write device object
     *
     * @param ProcessBuilder   $builder
     * @param ProcessArguments $arguments
     */
    public function __construct(ProcessBuilder $builder, ProcessArguments $arguments)
    {
        parent::__construct($builder, $arguments->setArgument('-sDEVICE=pdfwrite'));

        $this->setCompatibilityLevel(self::DEFAULT_COMPATIBILITY_LEVEL);
    }

    /**
     * Get output file
     *
     * @return null|string
     */
    public function getOutputFile()
    {
        return $this->getArgumentValue('-sOutputFile');
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
        $this->setArgument('-sOutputFile=' . $outputFile);

        return $this;
    }
}
