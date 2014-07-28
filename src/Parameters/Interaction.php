<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Parameters;

use GravityMedia\Ghostscript\Command\Parameter\TokenOption;

/**
 * Interaction parameters object
 *
 * @package GravityMedia\Ghostscript\Parameters
 */
class Interaction implements ParametersInterface
{
    /**
     * @var null|boolean
     */
    protected $quiet;

    /**
     * @var null|boolean
     */
    protected $batch;

    /**
     * @var null|boolean
     */
    protected $pause;

    /**
     * @inheritdoc
     */
    public function getCommandParameterList()
    {
        $parameters = array();
        if (true === $this->quiet) {
            array_push($parameters, new TokenOption('QUIET'));
        }
        if (true === $this->batch) {
            array_push($parameters, new TokenOption('BATCH'));
        }
        if (false === $this->pause) {
            array_push($parameters, new TokenOption('NOPAUSE'));
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
     * @return \GravityMedia\Ghostscript\Parameters\Interaction
     */
    public function setQuiet($quiet)
    {
        $this->quiet = $quiet;
        return $this;
    }

    /**
     * Is quiet mode enabled
     *
     * @return null|boolean
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
     * @return \GravityMedia\Ghostscript\Parameters\Interaction
     */
    public function setBatch($batch)
    {
        $this->batch = $batch;
        return $this;
    }

    /**
     * Is batch mode enabled
     *
     * @return null|boolean
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
     * @return \GravityMedia\Ghostscript\Parameters\Interaction
     */
    public function setPause($pause)
    {
        $this->pause = $pause;
        return $this;
    }

    /**
     * Is pause mode enabled
     *
     * @return null|boolean
     */
    public function isPause()
    {
        return $this->pause;
    }
}
