<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Device;

use GravityMedia\Ghostscript\Enum\PdfSettings;
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
     * Use distiller parameters
     */
    use DistillerParametersTrait;

    /**
     * Use color image compression distiller parameters
     */
    use DistillerParameters\ColorImageCompressionTrait;

    /**
     * Use grayscale image compression distiller parameters
     */
    use DistillerParameters\GrayscaleImageCompressionTrait;

    /**
     * Use monochrome image compression distiller parameters
     */
    use DistillerParameters\MonochromeImageCompressionTrait;

    /**
     * Use page compression distiller parameters
     */
    use DistillerParameters\PageCompressionTrait;

    /**
     * Use font distiller parameters
     */
    use DistillerParameters\FontTrait;

    /**
     * Use color conversion distiller parameters
     */
    use DistillerParameters\ColorConversionTrait;

    /**
     * Use advanced distiller parameters
     */
    use DistillerParameters\AdvancedTrait;

    /**
     * The default compatibility level
     */
    const DEFAULT_COMPATIBILITY_LEVEL = 1.4;

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

    /**
     * Get PDF settings
     *
     * @return string
     */
    public function getPdfSettings()
    {
        $value = $this->getArgumentValue('-dPDFSETTINGS');
        if (null === $value) {
            return PdfSettings::__DEFAULT;
        }

        return substr($value, 1);
    }

    /**
     * Set PDF settings
     *
     * @param string $pdfSettings
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setPdfSettings($pdfSettings)
    {
        $pdfSettings = ltrim($pdfSettings, '/');
        if (!in_array($pdfSettings, PdfSettings::values())) {
            throw new \InvalidArgumentException('Invalid PDF settings argument');
        }

        $this->setArgument(sprintf('-dPDFSETTINGS=/%s', $pdfSettings));

        return $this;
    }
}
