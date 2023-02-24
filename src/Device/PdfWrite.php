<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Device;

use GravityMedia\Ghostscript\Enum\PdfSettings;
use GravityMedia\Ghostscript\Enum\ProcessColorModel;
use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\GhostscriptInterface;
use GravityMedia\Ghostscript\Input;
use GravityMedia\Ghostscript\Process\Arguments;

/**
 * The PDF write device class.
 *
 * @package GravityMedia\Ghostscript\Devices
 */
class PdfWrite extends AbstractDevice
{
    /**
     * Use distiller parameters.
     */
    use DistillerParametersTrait;

    /**
     * Use color image compression distiller parameters.
     */
    use DistillerParameters\ColorImageCompressionTrait;

    /**
     * Use grayscale image compression distiller parameters.
     */
    use DistillerParameters\GrayImageCompressionTrait;

    /**
     * Use monochrome image compression distiller parameters.
     */
    use DistillerParameters\MonoImageCompressionTrait;

    /**
     * Use page compression distiller parameters.
     */
    use DistillerParameters\PageCompressionTrait;

    /**
     * Use font distiller parameters.
     */
    use DistillerParameters\FontTrait;

    /**
     * Use color conversion distiller parameters.
     */
    use DistillerParameters\ColorConversionTrait;

    /**
     * Use advanced distiller parameters.
     */
    use DistillerParameters\AdvancedTrait;

    /**
     * Create PDF write device object.
     *
     * @param Ghostscript $ghostscript
     * @param Arguments   $arguments
     */
    public function __construct(GhostscriptInterface $ghostscript, Arguments $arguments)
    {
        parent::__construct($ghostscript, $arguments->setArgument('-sDEVICE=pdfwrite'));

        $this->setPdfSettings(PdfSettings::__DEFAULT);
    }

    /**
     * Get output file.
     *
     * @return null|string
     */
    public function getOutputFile()
    {
        return $this->getArgumentValue('-sOutputFile');
    }

    /**
     * Set output file.
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
     * Get PDF settings.
     *
     * @return string
     */
    public function getPdfSettings()
    {
        return ltrim($this->getArgumentValue('-dPDFSETTINGS'), '/');
    }

    /**
     * Set PDF settings.
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

    /**
     * Get process color model.
     *
     * @return string
     */
    public function getProcessColorModel()
    {
        return ltrim($this->getArgumentValue('-dProcessColorModel'), '/');
    }

    /**
     * Set process color model.
     *
     * @param string $processColorModel
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setProcessColorModel($processColorModel)
    {
        $processColorModel = ltrim($processColorModel, '/');
        if (!in_array($processColorModel, ProcessColorModel::values())) {
            throw new \InvalidArgumentException('Invalid process color model argument');
        }

        $this->setArgument(sprintf('-dProcessColorModel=/%s', $processColorModel));

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function createProcessArguments(Input $input, string $version)
    {
        $code = $input->getPostScriptCode();
        if (null === $code) {
            $code = '';
        }

        /**
         * Make sure .setpdfwrite gets called when using Ghostscript version less than 9.50:
         * This operator conditions the environment for the pdfwrite output device. It is a shorthand for setting parameters
         * that have been deemed benificial. While not strictly necessary, it is usually helpful to set call this when using
         * the pdfwrite device.
         * @link https://ghostscript.com/doc/current/Language.htm#.setpdfwrite
         */
        if (version_compare($this->ghostscript->getVersion(), '9.50', '<') && false === strstr($code, '.setpdfwrite')) {
            $input->setPostScriptCode(ltrim($code . ' .setpdfwrite', ' '));
        }

        return parent::createProcessArguments($input, $version);
    }
}
