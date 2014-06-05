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
 * Other parameters object
 *
 * @package Ghostscript\Parameters
 */
class Other implements ParametersInterface
{
    /**
     * @var boolean
     */
    protected $safer;

    /**
     * @inheritdoc
     */
    public function getCommandParameterList()
    {
        $parameters = new ParameterList();
        if (null !== $this->safer) {
            $parameters->addParameter(new TokenOption($this->safer ? 'SAFER' : 'NOSAFER'));
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
     * @return \Ghostscript\Parameters\Other
     */
    public function setSafer($safer)
    {
        $this->safer = $safer;
        return $this;
    }

    /**
     * Is safer mode enabled
     *
     * @return boolean
     */
    public function isSafer()
    {
        return $this->safer;
    }
}
