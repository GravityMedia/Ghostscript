<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schr�der <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Devices;

/**
 * The distiller parameters trait
 *
 * @package GravityMedia\Ghostscript\Devices
 */
trait DistillerParametersTrait
{
    /**
     * Get argument value
     *
     * @param string $name
     *
     * @return string
     */
    abstract function getArgumentValue($name);

    /**
     * Set argument
     *
     * @param string $argument
     *
     * @return $this
     */
    abstract function setArgument($argument);

    /**
     * Get always embed
     *
     * @return array
     */
    public function getAlwaysEmbed()
    {
        $value = $this->getArgumentValue('-dAlwaysEmbed');
        if (null === $value) {
            return [];
        }

        return explode(' /', substr($value, 2, -1));
    }

    /**
     * Set always embed
     *
     * @param array $alwaysEmbed
     *
     * @return $this
     */
    public function setAlwaysEmbed(array $alwaysEmbed)
    {
        $this->setArgument('-dAlwaysEmbed=[' . implode(' ', array_map(function ($fontName) {
                return '/' . ltrim($fontName, '/');
            }, $alwaysEmbed)) . ']');

        return $this;
    }

    /**
     * Whether to anti alias color images
     *
     * @return bool
     */
    public function isAntiAliasColorImages()
    {
        return filter_var($this->getArgumentValue('-dAntiAliasColorImages'), FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set anti alias color images flag
     *
     * @param bool $antiAliasColorImages
     *
     * @return $this
     */
    public function setAntiAliasColorImages($antiAliasColorImages)
    {
        $this->setArgument('-dAntiAliasColorImages=' . ($antiAliasColorImages ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to anti alias gray images
     *
     * @return bool
     */
    public function isAntiAliasGrayImages()
    {
        return filter_var($this->getArgumentValue('-dAntiAliasGrayImages'), FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set anti alias gray images flag
     *
     * @param bool $antiAliasGrayImages
     *
     * @return $this
     */
    public function setAntiAliasGrayImages($antiAliasGrayImages)
    {
        $this->setArgument('-dAntiAliasGrayImages=' . ($antiAliasGrayImages ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to anti alias mono images
     *
     * @return bool
     */
    public function isAntiAliasMonoImages()
    {
        return filter_var($this->getArgumentValue('-dAntiAliasMonoImages'), FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set anti alias mono images flag
     *
     * @param bool $antiAliasMonoImages
     *
     * @return $this
     */
    public function setAntiAliasMonoImages($antiAliasMonoImages)
    {
        $this->setArgument('-dAntiAliasMonoImages=' . ($antiAliasMonoImages ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether ASCII85 encode pages
     *
     * @return bool
     */
    public function isAscii85EncodePages()
    {
        return filter_var($this->getArgumentValue('-dASCII85EncodePages'), FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set ASCII85 encode pages flag
     *
     * @param bool $ascii85EncodePages
     *
     * @return $this
     */
    public function setAscii85EncodePages($ascii85EncodePages)
    {
        $this->setArgument('-dASCII85EncodePages=' . ($ascii85EncodePages ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to auto filter color images
     *
     * @return bool
     */
    public function isAutoFilterColorImages()
    {
        return filter_var($this->getArgumentValue('-dAutoFilterColorImages'), FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set auto filter color images flag
     *
     * @param bool $autoFilterColorImages
     *
     * @return $this
     */
    public function setAutoFilterColorImages($autoFilterColorImages)
    {
        $this->setArgument('-dAutoFilterColorImages=' . ($autoFilterColorImages ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to auto filter gray images
     *
     * @return bool
     */
    public function isAutoFilterGrayImages()
    {
        return filter_var($this->getArgumentValue('-dAutoFilterGrayImages'), FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set auto filter gray images flag
     *
     * @param bool $autoFilterGrayImages
     *
     * @return $this
     */
    public function setAutoFilterGrayImages($autoFilterGrayImages)
    {
        $this->setArgument('-dAutoFilterGrayImages=' . ($autoFilterGrayImages ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to auto position EPS files
     *
     * @return bool
     */
    public function isAutoPositionEpsFiles()
    {
        return filter_var($this->getArgumentValue('-dAutoPositionEPSFiles'), FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set auto position EPS files flag
     *
     * @param bool $autoPositionEpsFiles
     *
     * @return $this
     */
    public function setAutoPositionEpsFiles($autoPositionEpsFiles)
    {
        $this->setArgument('-dAutoPositionEPSFiles=' . ($autoPositionEpsFiles ? 'true' : 'false'));

        return $this;
    }

    /**
     * Get auto rotate pages
     *
     * @return string
     */
    public function getAutoRotatePages()
    {
        $value = $this->getArgumentValue('-dAutoRotatePages');
        if (null === $value) {
            return null;
        }

        return substr($value, 1);
    }


    /**
     * Set auto rotate pages
     *
     * @param string $autoRotatePages
     *
     * @param \InvalidArgumentException
     *
     * @return $this
     */
    public function setAutoRotatePages($autoRotatePages)
    {
        if (!in_array($autoRotatePages, array(
            DistillerParametersInterface::AUTO_ROTATE_PAGES_NONE,
            DistillerParametersInterface::AUTO_ROTATE_PAGES_ALL,
            DistillerParametersInterface::AUTO_ROTATE_PAGES_PAGE_BY_PAGE
        ))
        ) {
            throw new \InvalidArgumentException('Invalid auto rotate pages argument');
        }

        $this->setArgument('-dAutoRotatePages=/' . $autoRotatePages);

        return $this;
    }

    /**
     * Get binding
     *
     * @return string
     */
    public function getBinding()
    {
        $value = $this->getArgumentValue('-dBinding');
        if (null === $value) {
            return null;
        }

        return substr($value, 1);
    }


    /**
     * Set binding
     *
     * @param string $binding
     *
     * @param \InvalidArgumentException
     *
     * @return $this
     */
    public function setBinding($binding)
    {
        if (!in_array($binding, array(
            DistillerParametersInterface::BINDING_LEFT,
            DistillerParametersInterface::BINDING_RIGHT
        ))
        ) {
            throw new \InvalidArgumentException('Invalid binding argument');
        }

        $this->setArgument('-dBinding=/' . $binding);

        return $this;
    }

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
        $this->setArgument('-dCalCMYKProfile=(' . $valCmykProfile . ')');

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
        $this->setArgument('-dCalGrayProfile=(' . $valGrayProfile . ')');

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
        $this->setArgument('-dCalRGBProfile=(' . $valRgbProfile . ')');

        return $this;
    }

    /**
     * Get cannot embed font policy
     *
     * @return string
     */
    public function getCannotEmbedFontPolicy()
    {
        $value = $this->getArgumentValue('-dCannotEmbedFontPolicy');
        if (null === $value) {
            return null;
        }

        return substr($value, 1);
    }

    /**
     * Set cannot embed font policy
     *
     * @param string $cannotEmbedFontPolicy
     *
     * @param \InvalidArgumentException
     *
     * @return $this
     */
    public function setCannotEmbedFontPolicy($cannotEmbedFontPolicy)
    {
        if (!in_array($cannotEmbedFontPolicy, array(
            DistillerParametersInterface::CANNOT_EMBED_FONT_POLICY_OK,
            DistillerParametersInterface::CANNOT_EMBED_FONT_POLICY_WARNING,
            DistillerParametersInterface::CANNOT_EMBED_FONT_POLICY_ERROR
        ))
        ) {
            throw new \InvalidArgumentException('Invalid cannot embed font policy argument');
        }

        $this->setArgument('-dCannotEmbedFontPolicy=/' . $cannotEmbedFontPolicy);

        return $this;
    }

    /**
     * Get compatibility level
     *
     * @return null|string
     */
    public function getCompatibilityLevel()
    {
        return $this->getArgumentValue('-dCompatibilityLevel');
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
        $this->setArgument('-dCompatibilityLevel=' . $compatibilityLevel);

        return $this;
    }
}
