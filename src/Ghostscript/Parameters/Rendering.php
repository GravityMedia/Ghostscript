<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\Parameters;

use Commander\Command\Parameter\Argument;
use Commander\Command\ParameterList;
use Ghostscript\Command\Parameter\TokenOption;

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
    public function getCommandParameterList()
    {
        $parameters = new ParameterList();
        if (null !== $this->colorscreen) {
            if ($this->colorscreen) {
                $parameters->addParameter(new TokenOption('COLORSCREEN'));
            } elseif (false === $this->colorscreen || 'false' === $this->colorscreen) {
                $parameters->addParameter(new TokenOption('COLORSCREEN', new Argument('false')));
            } else {
                $parameters->addParameter(new TokenOption('COLORSCREEN', new Argument('0')));
            }
        }
        if (null !== $this->ditherPpi) {
            $parameters->addParameter(new TokenOption('DITHERPPI', new Argument($this->ditherPpi)));
        }
        if (null !== $this->textAlphaBits) {
            $parameters->addParameter(new TokenOption('TextAlphaBits', new Argument($this->textAlphaBits)));
        }
        if (null !== $this->graphicsAlphaBits) {
            $parameters->addParameter(new TokenOption('GraphicsAlphaBits', new Argument($this->graphicsAlphaBits)));
        }
        return $parameters;
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
