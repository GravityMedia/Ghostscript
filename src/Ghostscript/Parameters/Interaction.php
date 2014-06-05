<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\Parameters;

use Commander\Command\ParameterList;
use Ghostscript\Command\Parameter\TokenOption;

/**
 * Interaction parameters object
 *
 * @package Ghostscript\Parameters
 */
class Interaction implements ParametersInterface
{
    /**
     * @var boolean
     */
    protected $quiet;

    /**
     * @var boolean
     */
    protected $batch;

    /**
     * @var boolean
     */
    protected $pause;

    /**
     * @inheritdoc
     */
    public function getCommandParameterList()
    {
        $parameters = new ParameterList();
        if (true === $this->quiet) {
            $parameters->addParameter(new TokenOption('QUIET'));
        }
        if (true === $this->batch) {
            $parameters->addParameter(new TokenOption('BATCH'));
        }
        if (false === $this->pause) {
            $parameters->addParameter(new TokenOption('NOPAUSE'));
        }
        return $parameters;
    }

    /**
     * Enable quiet mode
     *
     * @see http://ghostscript.com/doc/current/Use.htm#Interaction_related_parameters
     *
     * @param boolean $quiet
     *
     * @return \Ghostscript\Parameters\Interaction
     */
    public function setQuiet($quiet)
    {
        $this->quiet = $quiet;
        return $this;
    }

    /**
     * Is quiet mode enabled
     *
     * @return boolean
     */
    public function isQuiet()
    {
        return $this->quiet;
    }

    /**
     * Enable batch mode
     *
     * @see http://ghostscript.com/doc/current/Use.htm#Interaction_related_parameters
     *
     * @param boolean $batch
     *
     * @return \Ghostscript\Parameters\Interaction
     */
    public function setBatch($batch)
    {
        $this->batch = $batch;
        return $this;
    }

    /**
     * Is batch mode
     *
     * @return boolean
     */
    public function isBatch()
    {
        return $this->batch;
    }

    /**
     * Enable pause mode
     *
     * @see http://ghostscript.com/doc/current/Use.htm#Interaction_related_parameters
     *
     * @param boolean $pause
     *
     * @return \Ghostscript\Parameters\Interaction
     */
    public function setPause($pause)
    {
        $this->pause = $pause;
        return $this;
    }

    /**
     * Is pause mode
     *
     * @return boolean
     */
    public function isPause()
    {
        return $this->pause;
    }
}
