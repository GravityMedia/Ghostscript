<?php
/**
 * This file is part of the Ghostscript package
 */

namespace GravityMedia\Ghostscript\Device;

use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\Process\Arguments as ProcessArguments;
use GravityMedia\Ghostscript\Process\Arguments;

/**
 * @package GravityMedia\Ghostscript\Devices
 */
class Inkcov extends AbstractDevice
{
    const POSTSCRIPT_COMMANDS = '';

    /**
     * @param Ghostscript $ghostscript
     * @param ProcessArguments $arguments
     */
    public function __construct(Ghostscript $ghostscript, Arguments $arguments)
    {
        parent::__construct($ghostscript, $arguments->setArgument('-sDEVICE=inkcov'));
    }
}
