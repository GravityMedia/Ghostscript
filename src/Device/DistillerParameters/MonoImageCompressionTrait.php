<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Device\DistillerParameters;

use GravityMedia\Ghostscript\Enum\ImageDownsampleType;
use GravityMedia\Ghostscript\Enum\MonoImageFilter;
use GravityMedia\Ghostscript\Enum\PdfSettings;

/**
 * The monochrome image compression distiller parameters trait.
 *
 * @package GravityMedia\Ghostscript\Device\DistillerParameters
 *
 * @link    http://ghostscript.com/doc/current/Ps2pdf.htm
 */
trait MonoImageCompressionTrait
{
    /**
     * Get argument value
     *
     * @param string $name
     *
     * @return null|string
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
     * Whether to anti alias monochrome images
     *
     * @return bool
     */
    public function isAntiAliasMonoImages()
    {
        $value = $this->getArgumentValue('-dAntiAliasMonoImages');
        if (null === $value) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set anti alias monochrome images flag
     *
     * @param bool $antiAliasMonoImages
     *
     * @return $this
     */
    public function setAntiAliasMonoImages($antiAliasMonoImages)
    {
        $this->setArgument(sprintf('-dAntiAliasMonoImages=%s', $antiAliasMonoImages ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to downsample monochrome images
     *
     * @return bool
     */
    public function isDownsampleMonoImages()
    {
        $value = $this->getArgumentValue('-dDownsampleMonoImages');
        if (null === $value) {
            switch ($this->getPdfSettings()) {
                case PdfSettings::SCREEN:
                case PdfSettings::EBOOK:
                    return true;
                default:
                    return false;
            }
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set downsample monochrome images flag
     *
     * @param bool $downsampleMonoImages
     *
     * @return $this
     */
    public function setDownsampleMonoImages($downsampleMonoImages)
    {
        $this->setArgument(sprintf('-dDownsampleMonoImages=%s', $downsampleMonoImages ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to encode monochrome images
     *
     * @return bool
     */
    public function isEncodeMonoImages()
    {
        $value = $this->getArgumentValue('-dEncodeMonoImages');
        if (null === $value) {
            return true;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set encode monochrome images flag
     *
     * @param bool $encodeMonoImages
     *
     * @return $this
     */
    public function setEncodeMonoImages($encodeMonoImages)
    {
        $this->setArgument(sprintf('-dEncodeMonoImages=%s', $encodeMonoImages ? 'true' : 'false'));

        return $this;
    }

    /**
     * Get monochrome image depth
     *
     * @return int
     */
    public function getMonoImageDepth()
    {
        $value = $this->getArgumentValue('-dMonoImageDepth');
        if (null === $value) {
            return -1;
        }

        return intval($value);
    }

    /**
     * Set monochrome image depth
     *
     * @param int $monoImageDepth
     *
     * @return $this
     */
    public function setMonoImageDepth($monoImageDepth)
    {
        $this->setArgument(sprintf('-dMonoImageDepth=%s', $monoImageDepth));

        return $this;
    }

    /**
     * Get monochrome image downsample threshold
     *
     * @return float
     */
    public function getMonoImageDownsampleThreshold()
    {
        $value = $this->getArgumentValue('-dMonoImageDownsampleThreshold');
        if (null === $value) {
            return 1.5;
        }

        return floatval($value);
    }

    /**
     * Set monochrome image downsample threshold
     *
     * @param float $monoImageDownsampleThreshold
     *
     * @return $this
     */
    public function setMonoImageDownsampleThreshold($monoImageDownsampleThreshold)
    {
        $this->setArgument(sprintf('-dMonoImageDownsampleThreshold=%s', $monoImageDownsampleThreshold));

        return $this;
    }

    /**
     * Get monochrome image downsample type
     *
     * @return string
     */
    public function getMonoImageDownsampleType()
    {
        $value = $this->getArgumentValue('-dMonoImageDownsampleType');
        if (null === $value) {
            switch ($this->getPdfSettings()) {
                case PdfSettings::PREPRESS:
                    return ImageDownsampleType::BICUBIC;
                default:
                    return ImageDownsampleType::SUBSAMPLE;
            }
        }

        return ltrim($value, '/');
    }

    /**
     * Set monochrome image downsample type
     *
     * @param string $monoImageDownsampleType
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setMonoImageDownsampleType($monoImageDownsampleType)
    {
        $monoImageDownsampleType = ltrim($monoImageDownsampleType, '/');
        if (!in_array($monoImageDownsampleType, ImageDownsampleType::values())) {
            throw new \InvalidArgumentException('Invalid monochrome image downsample type argument');
        }

        $this->setArgument(sprintf('-dMonoImageDownsampleType=/%s', $monoImageDownsampleType));

        return $this;
    }

    /**
     * Get monochrome image filter
     *
     * @return string
     */
    public function getMonoImageFilter()
    {
        $value = $this->getArgumentValue('-dMonoImageFilter');
        if (null === $value) {
            return MonoImageFilter::CCITT_FAX_ENCODE;
        }

        return ltrim($value, '/');
    }

    /**
     * Set monochrome image filter
     *
     * @param string $monoImageFilter
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setMonoImageFilter($monoImageFilter)
    {
        $monoImageFilter = ltrim($monoImageFilter, '/');
        if (!in_array($monoImageFilter, MonoImageFilter::values())) {
            throw new \InvalidArgumentException('Invalid monochrome image filter argument');
        }

        $this->setArgument(sprintf('-dMonoImageFilter=/%s', $monoImageFilter));

        return $this;
    }

    /**
     * Get monochrome image resolution
     *
     * @return int
     */
    public function getMonoImageResolution()
    {
        $value = $this->getArgumentValue('-dMonoImageResolution');
        if (null === $value) {
            switch ($this->getPdfSettings()) {
                case PdfSettings::PRINTER:
                case PdfSettings::PREPRESS:
                    return 1200;
                default:
                    return 300;
            }
        }

        return intval($value);
    }

    /**
     * Set monochrome image resolution
     *
     * @param int $monoImageResolution
     *
     * @return $this
     */
    public function setMonoImageResolution($monoImageResolution)
    {
        $this->setArgument(sprintf('-dMonoImageResolution=%s', $monoImageResolution));

        return $this;
    }
}
