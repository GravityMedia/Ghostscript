<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Parameters;

use GravityMedia\Ghostscript\Argument;

/**
 * Rendering parameters object
 *
 * @package GravityMedia\Ghostscript\Parameters
 */
class Rendering implements ParametersInterface
{
    /**
     * @var null|string
     */
    protected $colorscreen;

    /**
     * @var null|int
     */
    protected $ditherPpi;

    /**
     * @var null|int
     */
    protected $textAlphaBits;

    /**
     * @var null|int
     */
    protected $graphicsAlphaBits;

    /**
     * @inheritdoc
     */
    public function getParametersAsArguments()
    {
        $arguments = array();
        if (null !== $this->colorscreen) {
            if ($this->colorscreen) {
                array_push($arguments, new Argument\TokenOption('COLORSCREEN'));
            } elseif (false === $this->colorscreen || 'false' === $this->colorscreen) {
                array_push($arguments, new Argument\TokenOption('COLORSCREEN', 'false'));
            } else {
                array_push($arguments, new Argument\TokenOption('COLORSCREEN', '0'));
            }
        }
        if (null !== $this->ditherPpi) {
            array_push($arguments, new Argument\TokenOption('DITHERPPI', strval($this->ditherPpi)));
        }
        if (null !== $this->textAlphaBits) {
            array_push($arguments, new Argument\TokenOption('TextAlphaBits', strval($this->textAlphaBits)));
        }
        if (null !== $this->graphicsAlphaBits) {
            array_push($arguments, new Argument\TokenOption('GraphicsAlphaBits', strval($this->graphicsAlphaBits)));
        }
        return $arguments;
    }

    /**
     * Set colorscreen parameter
     *
     * @param string $colorscreen
     *
     * @return \GravityMedia\Ghostscript\Parameters\Rendering
     */
    public function setColorscreen($colorscreen)
    {
        $this->colorscreen = $colorscreen;
        return $this;
    }

    /**
     * Get colorscreen parameter
     *
     * @return null|string
     */
    public function getColorscreen()
    {
        return $this->colorscreen;
    }

    /**
     * Set dither in ppi
     *
     * @param int $ditherPpi
     *
     * @return \GravityMedia\Ghostscript\Parameters\Rendering
     */
    public function setDitherPpi($ditherPpi)
    {
        $this->ditherPpi = $ditherPpi;
        return $this;
    }

    /**
     * Get dither in ppi
     *
     * @return null|int
     */
    public function getDitherPpi()
    {
        return $this->ditherPpi;
    }

    /**
     * Set text alpha bits
     *
     * @param int $textAlphaBits
     *
     * @return \GravityMedia\Ghostscript\Parameters\Rendering
     */
    public function setTextAlphaBits($textAlphaBits)
    {
        $this->textAlphaBits = $textAlphaBits;
        return $this;
    }

    /**
     * Get text alpha bits
     *
     * @return null|int
     */
    public function getTextAlphaBits()
    {
        return $this->textAlphaBits;
    }

    /**
     * Set graphics alpha bits
     *
     * @param int $graphicsAlphaBits
     *
     * @return \GravityMedia\Ghostscript\Parameters\Rendering
     */
    public function setGraphicsAlphaBits($graphicsAlphaBits)
    {
        $this->graphicsAlphaBits = $graphicsAlphaBits;
        return $this;
    }

    /**
     * Get graphics alpha bits
     *
     * @return null|int
     */
    public function getGraphicsAlphaBits()
    {
        return $this->graphicsAlphaBits;
    }
}
