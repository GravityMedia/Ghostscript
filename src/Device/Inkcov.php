<?php
/**
 * This file is part of the Ghostscript package
 */

namespace GravityMedia\Ghostscript\Device;

use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\GhostscriptInterface;
use GravityMedia\Ghostscript\Process\Arguments as ProcessArguments;
use GravityMedia\Ghostscript\Process\Arguments;

/**
 * @package GravityMedia\Ghostscript\Devices
 */
class Inkcov extends AbstractDevice
{
    /**
     * @param Ghostscript $ghostscript
     * @param ProcessArguments $arguments
     */
    public function __construct(GhostscriptInterface $ghostscript, Arguments $arguments)
    {
        parent::__construct($ghostscript, $arguments->setArgument('-sDEVICE=inkcov'));
    }
}
