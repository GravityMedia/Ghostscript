<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Devices\DistillerParameters;

use GravityMedia\Ghostscript\Devices\DistillerParametersInterface;

/**
 * The grayscale image compression distiller parameters trait
 *
 * @package GravityMedia\Ghostscript\Devices\DistillerParameters
 */
trait GrayscaleImageCompressionTrait
{
    /**
     * Available grayscale image downsample type values
     *
     * @var string[]
     */
    protected static $grayImageDownsampleTypeValues = [
        DistillerParametersInterface::IMAGE_DOWNSAMPLE_TYPE_AVERAGE,
        DistillerParametersInterface::IMAGE_DOWNSAMPLE_TYPE_BICUBIC,
        DistillerParametersInterface::IMAGE_DOWNSAMPLE_TYPE_SUBSAMPLE,
        DistillerParametersInterface::IMAGE_DOWNSAMPLE_TYPE_NONE,
    ];

    /**
     * Available grayscale image filter values
     *
     * @var string[]
     */
    protected static $grayImageFilterValues = [
        DistillerParametersInterface::IMAGE_FILTER_DCT_ENCODE,
        DistillerParametersInterface::IMAGE_FILTER_FLATE_ENCODE
    ];

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
     * Whether to anti alias grayscale images
     *
     * @return bool
     */
    public function isAntiAliasGrayImages()
    {
        $value = $this->getArgumentValue('-dAntiAliasGrayImages');
        if (null === $value) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set anti alias grayscale images flag
     *
     * @param bool $antiAliasGrayImages
     *
     * @return $this
     */
    public function setAntiAliasGrayImages($antiAliasGrayImages)
    {
        $this->setArgument(sprintf('-dAntiAliasGrayImages=%s', $antiAliasGrayImages ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to auto filter grayscale images
     *
     * @return bool
     */
    public function isAutoFilterGrayImages()
    {
        $value = filter_var($this->getArgumentValue('-dAutoFilterGrayImages'), FILTER_VALIDATE_BOOLEAN);
        if (null === $value) {
            return true;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set auto filter grayscale images flag
     *
     * @param bool $autoFilterGrayImages
     *
     * @return $this
     */
    public function setAutoFilterGrayImages($autoFilterGrayImages)
    {
        $this->setArgument(sprintf('-dAutoFilterGrayImages=%s', $autoFilterGrayImages ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to downsample gray images
     *
     * @return bool
     */
    public function isDownsampleGrayImages()
    {
        $value = $this->getArgumentValue('-dDownsampleGrayImages');
        if (null === $value) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set downsample gray images flag
     *
     * @param bool $downsampleGrayImages
     *
     * @return $this
     */
    public function setDownsampleGrayImages($downsampleGrayImages)
    {
        $this->setArgument(sprintf('-dDownsampleGrayImages=%s', $downsampleGrayImages ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to encode grayscale images
     *
     * @return bool
     */
    public function isEncodeGrayImages()
    {
        $value = $this->getArgumentValue('-dEncodeGrayImages');
        if (null === $value) {
            return true;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set encode grayscale images flag
     *
     * @param bool $encodeGrayImages
     *
     * @return $this
     */
    public function setEncodeGrayImages($encodeGrayImages)
    {
        $this->setArgument(sprintf('-dEncodeGrayImages=%s', $encodeGrayImages ? 'true' : 'false'));

        return $this;
    }

    /**
     * Get gray image depth
     *
     * @return int
     */
    public function getGrayImageDepth()
    {
        $value = $this->getArgumentValue('-dGrayImageDepth');
        if (null === $value) {
            return -1;
        }

        return intval($value);
    }

    /**
     * Set gray image depth
     *
     * @param int $grayImageDepth
     *
     * @return $this
     */
    public function setGrayImageDepth($grayImageDepth)
    {
        $this->setArgument(sprintf('-dGrayImageDepth=%s', $grayImageDepth));

        return $this;
    }

    /**
     * Get gray image downsample threshold
     *
     * @return float
     */
    public function getGrayImageDownsampleThreshold()
    {
        $value = $this->getArgumentValue('-dGrayImageDownsampleThreshold');
        if (null === $value) {
            return 1.5;
        }

        return floatval($value);
    }

    /**
     * Set gray image downsample threshold
     *
     * @param float $grayImageDownsampleThreshold
     *
     * @return $this
     */
    public function setGrayImageDownsampleThreshold($grayImageDownsampleThreshold)
    {
        $this->setArgument(sprintf('-dGrayImageDownsampleThreshold=%s', $grayImageDownsampleThreshold));

        return $this;
    }

    /**
     * Get gray image downsample type
     *
     * @return string
     */
    public function getGrayImageDownsampleType()
    {
        $value = $this->getArgumentValue('-dGrayImageDownsampleType');
        if (null === $value) {
            return DistillerParametersInterface::IMAGE_DOWNSAMPLE_TYPE_SUBSAMPLE;
        }

        return substr($value, 1);
    }

    /**
     * Set gray image downsample type
     *
     * @param string $grayImageDownsampleType
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setGrayImageDownsampleType($grayImageDownsampleType)
    {
        if (!in_array($grayImageDownsampleType, static::$grayImageDownsampleTypeValues)) {
            throw new \InvalidArgumentException('Invalid grayscale image downsample type argument');
        }

        $this->setArgument(sprintf('-dGrayImageDownsampleType=/%s', $grayImageDownsampleType));

        return $this;
    }

    /**
     * Get gray image filter
     *
     * @return string
     */
    public function getGrayImageFilter()
    {
        $value = $this->getArgumentValue('-dGrayImageFilter');
        if (null === $value) {
            return DistillerParametersInterface::IMAGE_FILTER_DCT_ENCODE;
        }

        return substr($value, 1);
    }

    /**
     * Set gray image filter
     *
     * @param string $grayImageFilter
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setGrayImageFilter($grayImageFilter)
    {
        if (!in_array($grayImageFilter, static::$grayImageDownsampleTypeValues)) {
            throw new \InvalidArgumentException('Invalid grayscale image filter argument');
        }

        $this->setArgument(sprintf('-dGrayImageFilter=/%s', $grayImageFilter));

        return $this;
    }

    /**
     * Get gray image resolution
     *
     * @return int
     */
    public function getGrayImageResolution()
    {
        $value = $this->getArgumentValue('-dGrayImageResolution');
        if (null === $value) {
            return 72;
        }

        return intval($value);
    }

    /**
     * Set gray image resolution
     *
     * @param int $grayImageResolution
     *
     * @return $this
     */
    public function setGrayImageResolution($grayImageResolution)
    {
        $this->setArgument(sprintf('-dGrayImageResolution=%s', $grayImageResolution));

        return $this;
    }
}
