<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Devices\DistillerParameters;

use GravityMedia\Ghostscript\Enum\ColorConversionStrategy;
use GravityMedia\Ghostscript\Enum\DefaultRenderingIntent;
use GravityMedia\Ghostscript\Enum\PdfSettings;
use GravityMedia\Ghostscript\Enum\TransferFunctionInfo;
use GravityMedia\Ghostscript\Enum\UcrAndBgInfo;

/**
 * The color conversion distiller parameters trait
 *
 * @package GravityMedia\Ghostscript\Devices\DistillerParameters
 */
trait ColorConversionTrait
{
    /**
     * Get argument value
     *
     * @param string $name
     *
     * @return string
     */
    abstract protected function getArgumentValue($name);

    /**
     * Set argument
     *
     * @param string $argument
     *
     * @return $this
     */
    abstract protected function setArgument($argument);

    /**
     * Get PDF settings
     *
     * @return string
     */
    abstract public function getPdfSettings();

    /**
     * Get cal CMYK profile
     *
     * @return null|string
     */
    public function getCalCmykProfile()
    {
        $value = $this->getArgumentValue('-dCalCMYKProfile');
        if (null === $value) {
            return null;
        }

        return substr($value, 1, -1);
    }

    /**
     * Set cal CMYK profile
     *
     * @param string $valCmykProfile
     *
     * @return $this
     */
    public function setCalCmykProfile($valCmykProfile)
    {
        $this->setArgument(sprintf('-dCalCMYKProfile=(%s)', $valCmykProfile));

        return $this;
    }

    /**
     * Get cal gray profile
     *
     * @return null|string
     */
    public function getCalGrayProfile()
    {
        $value = $this->getArgumentValue('-dCalGrayProfile');
        if (null === $value) {
            return null;
        }

        return substr($value, 1, -1);
    }

    /**
     * Set cal gray profile
     *
     * @param string $valGrayProfile
     *
     * @return $this
     */
    public function setCalGrayProfile($valGrayProfile)
    {
        $this->setArgument(sprintf('-dCalGrayProfile=(%s)', $valGrayProfile));

        return $this;
    }

    /**
     * Get cal RGB profile
     *
     * @return null|string
     */
    public function getCalRgbProfile()
    {
        $value = $this->getArgumentValue('-dCalRGBProfile');
        if (null === $value) {
            return null;
        }

        return substr($value, 1, -1);
    }

    /**
     * Set cal RGB profile
     *
     * @param string $valRgbProfile
     *
     * @return $this
     */
    public function setCalRgbProfile($valRgbProfile)
    {
        $this->setArgument(sprintf('-dCalRGBProfile=(%s)', $valRgbProfile));

        return $this;
    }

    /**
     * Get color conversion strategy
     *
     * @return string
     */
    public function getColorConversionStrategy()
    {
        $value = $this->getArgumentValue('-dColorConversionStrategy');
        if (null === $value) {
            switch ($this->getPdfSettings()) {
                case PdfSettings::SCREEN:
                case PdfSettings::EBOOK:
                    return ColorConversionStrategy::SRGB;
                case PdfSettings::PRINTER:
                    return ColorConversionStrategy::USE_DEVICE_INDEPENDENT_COLOR;
                default:
                    return ColorConversionStrategy::LEAVE_COLOR_UNCHANGED;
            }
        }

        return substr($value, 1);
    }

    /**
     * Set color conversion strategy
     *
     * @param string $colorConversionStrategy
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setColorConversionStrategy($colorConversionStrategy)
    {
        $colorConversionStrategy = ltrim($colorConversionStrategy, '/');
        if (!in_array($colorConversionStrategy, ColorConversionStrategy::values())) {
            throw new \InvalidArgumentException('Invalid color conversion strategy argument');
        }

        $this->setArgument(sprintf('-dColorConversionStrategy=/%s', $colorConversionStrategy));

        return $this;
    }

    /**
     * Whether to convert CMYK images to RGB
     *
     * @return bool
     */
    public function isConvertCmykImagesToRgb()
    {
        $value = $this->getArgumentValue('-dConvertCMYKImagesToRGB');
        if (null === $value) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set convert convert CMYK images to RGB flag
     *
     * @param bool $convertCmykImagesToRgb
     *
     * @return $this
     */
    public function setConvertCmykImagesToRgb($convertCmykImagesToRgb)
    {
        $this->setArgument(sprintf('-dConvertCMYKImagesToRGB=%s', $convertCmykImagesToRgb ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to convert images to indexed
     *
     * @return bool
     */
    public function isConvertImagesToIndexed()
    {
        $value = $this->getArgumentValue('-dConvertImagesToIndexed');
        if (null === $value) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set convert images to indexed flag
     *
     * @param bool $convertImagesToIndexed
     *
     * @return $this
     */
    public function setConvertImagesToIndexed($convertImagesToIndexed)
    {
        $this->setArgument(sprintf('-dConvertImagesToIndexed=%s', $convertImagesToIndexed ? 'true' : 'false'));

        return $this;
    }

    /**
     * Get default rendering intent
     *
     * @return string
     */
    public function getDefaultRenderingIntent()
    {
        $value = $this->getArgumentValue('-dDefaultRenderingIntent');
        if (null === $value) {
            return DefaultRenderingIntent::__DEFAULT;
        }

        return substr($value, 1);
    }

    /**
     * Set default rendering intent
     *
     * @param string $defaultRenderingIntent
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setDefaultRenderingIntent($defaultRenderingIntent)
    {
        $defaultRenderingIntent = ltrim($defaultRenderingIntent, '/');
        if (!in_array($defaultRenderingIntent, DefaultRenderingIntent::values())) {
            throw new \InvalidArgumentException('Invalid default rendering intent argument');
        }

        $this->setArgument(sprintf('-dDefaultRenderingIntent=/%s', $defaultRenderingIntent));

        return $this;
    }

    /**
     * Whether to preserve halftone info
     *
     * @return bool
     */
    public function isPreserveHalftoneInfo()
    {
        $value = $this->getArgumentValue('-dPreserveHalftoneInfo');
        if (null === $value) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set preserve halftone info flag
     *
     * @param bool $preserveHalftoneInfo
     *
     * @return $this
     */
    public function setPreserveHalftoneInfo($preserveHalftoneInfo)
    {
        $this->setArgument(sprintf('-dPreserveHalftoneInfo=%s', $preserveHalftoneInfo ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to preserve overprint settings
     *
     * @return bool
     */
    public function isPreserveOverprintSettings()
    {
        $value = $this->getArgumentValue('-dPreserveOverprintSettings');
        if (null === $value) {
            switch ($this->getPdfSettings()) {
                case PdfSettings::PRINTER:
                case PdfSettings::PREPRESS:
                    return true;
                default:
                    return false;
            }
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set preserve overprint settings flag
     *
     * @param bool $preserveOverprintSettings
     *
     * @return $this
     */
    public function setPreserveOverprintSettings($preserveOverprintSettings)
    {
        $this->setArgument(sprintf('-dPreserveOverprintSettings=%s', $preserveOverprintSettings ? 'true' : 'false'));

        return $this;
    }

    /**
     * Get sRGB profile
     *
     * @return null|string
     */
    public function getSRgbProfile()
    {
        $value = $this->getArgumentValue('-dsRGBProfile');
        if (null === $value) {
            return null;
        }

        return substr($value, 1, -1);
    }

    /**
     * Set sRGB profile
     *
     * @param string $sRgbProfile
     *
     * @return $this
     */
    public function setSRgbProfile($sRgbProfile)
    {
        $this->setArgument(sprintf('-dsRGBProfile=(%s)', $sRgbProfile));

        return $this;
    }

    /**
     * Get transfer function info
     *
     * @return string
     */
    public function getTransferFunctionInfo()
    {
        $value = $this->getArgumentValue('-dTransferFunctionInfo');
        if (null === $value) {
            return TransferFunctionInfo::PRESERVE;
        }

        return substr($value, 1);
    }

    /**
     * Set transfer function info
     *
     * @param string $transferFunctionInfo
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setTransferFunctionInfo($transferFunctionInfo)
    {
        $transferFunctionInfo = ltrim($transferFunctionInfo, '/');
        if (!in_array($transferFunctionInfo, TransferFunctionInfo::values())) {
            throw new \InvalidArgumentException('Invalid transfer function info argument');
        }

        $this->setArgument(sprintf('-dTransferFunctionInfo=/%s', $transferFunctionInfo));

        return $this;
    }

    /**
     * Get UCR and BG info
     *
     * @return string
     */
    public function getUcrAndBgInfo()
    {
        $value = $this->getArgumentValue('-dUCRandBGInfo');
        if (null === $value) {
            switch ($this->getPdfSettings()) {
                case PdfSettings::PRINTER:
                case PdfSettings::PREPRESS:
                    return UcrAndBgInfo::PRESERVE;
                default:
                    return UcrAndBgInfo::REMOVE;
            }
        }

        return substr($value, 1);
    }

    /**
     * Set UCR and BG info
     *
     * @param string $ucrAndBgInfo
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setUcrAndBgInfo($ucrAndBgInfo)
    {
        $ucrAndBgInfo = ltrim($ucrAndBgInfo, '/');
        if (!in_array($ucrAndBgInfo, UcrAndBgInfo::values())) {
            throw new \InvalidArgumentException('Invalid UCR and BG info argument');
        }

        $this->setArgument(sprintf('-dUCRandBGInfo=/%s', $ucrAndBgInfo));

        return $this;
    }
}
