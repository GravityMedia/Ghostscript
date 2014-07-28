<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Parameters;

use GravityMedia\Ghostscript\Command\Parameter\TokenOption;

/**
 * Control parameters object
 *
 * @package GravityMedia\Ghostscript\Parameters
 */
class Control implements ParametersInterface
{
    /**
     * @var null|boolean
     */
    protected $safer;

    /**
     * @inheritdoc
     */
    public function getCommandParameterList()
    {
        $parameters = array();
        if (null !== $this->safer) {
            array_push($parameters, new TokenOption($this->safer ? 'SAFER' : 'NOSAFER'));
        }
        return $parameters;
    }

    /**
     * Enable safer mode
     *
     * @see http://ghostscript.com/doc/current/Use.htm#Other_parameters
     *
     * @param boolean $safer
     *
     * @return \GravityMedia\Ghostscript\Parameters\Control
     */
    public function setSafer($safer)
    {
        $this->safer = $safer;
        return $this;
    }

    /**
     * Is safer mode enabled
     *
     * @return null|boolean
     */
    public function isSafer()
    {
        return $this->safer;
    }
}
