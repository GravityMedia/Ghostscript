<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\Parameters;

use Ghostscript\ShellWrapper\Command;

/**
 * Rendering parameters object
 *
 * @package Ghostscript\Parameters
 */
class Rendering implements ParametersInterface
{
    /**
     * @var string
     */
    protected $colorscreen;

    /**
     * @var int
     */
    protected $ditherPpi;

    /**
     * @var int
     */
    protected $textAlphaBits;

    /**
     * @var int
     */
    protected $graphicsAlphaBits;

    /**
     * @inheritdoc
     */
    public function toFlags()
    {
        $flags = new Command\Collections\Flags();
        if (null !== $this->colorscreen) {
            if ($this->colorscreen) {
                $flags->addFlag(new Command\TokenFlag('COLORSCREEN'));
            } elseif (false === $this->colorscreen || 'false' === $this->colorscreen) {
                $flags->addFlag(new Command\TokenFlag('COLORSCREEN', 'false'));
            } else {
                $flags->addFlag(new Command\TokenFlag('COLORSCREEN', '0'));
            }
        }
        if (null !== $this->ditherPpi) {
            $flags->addFlag(new Command\TokenFlag('DITHERPPI', $this->ditherPpi));
        }
        if (null !== $this->textAlphaBits) {
            $flags->addFlag(new Command\TokenFlag('TextAlphaBits', $this->textAlphaBits));
        }
        if (null !== $this->graphicsAlphaBits) {
            $flags->addFlag(new Command\TokenFlag('GraphicsAlphaBits', $this->graphicsAlphaBits));
        }
        return $flags;
    }

    /**
     * Set colorscreen parameter
     *
     * @param string $colorscreen
     *
     * @return \Ghostscript\Parameters\Rendering
     */
    public function setColorscreen($colorscreen)
    {
        $this->colorscreen = $colorscreen;
        return $this;
    }

    /**
     * Get colorscreen parameter
     *
     * @return string
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
     * @return \Ghostscript\Parameters\Rendering
     */
    public function setDitherPpi($ditherPpi)
    {
        $this->ditherPpi = $ditherPpi;
        return $this;
    }

    /**
     * Get dither in ppi
     *
     * @return int
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
     * @return \Ghostscript\Parameters\Rendering
     */
    public function setTextAlphaBits($textAlphaBits)
    {
        $this->textAlphaBits = $textAlphaBits;
        return $this;
    }

    /**
     * Get text alpha bits
     *
     * @return int
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
     * @return \Ghostscript\Parameters\Rendering
     */
    public function setGraphicsAlphaBits($graphicsAlphaBits)
    {
        $this->graphicsAlphaBits = $graphicsAlphaBits;
        return $this;
    }

    /**
     * Get graphics alpha bits
     *
     * @return int
     */
    public function getGraphicsAlphaBits()
    {
        return $this->graphicsAlphaBits;
    }
}
