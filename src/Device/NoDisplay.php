<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\Ghostscript\Device;

use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\Process\Arguments;

/**
 * The no display device class.
 *
 * @package GravityMedia\Ghostscript\Devices
 */
class NoDisplay extends AbstractDevice
{
    /**
     * Create no display device object.
     *
     * @param Ghostscript $ghostscript
     * @param Arguments   $arguments
     */
    public function __construct(Ghostscript $ghostscript, Arguments $arguments)
    {
        parent::__construct($ghostscript, $arguments->setArgument('-dNODISPLAY'));
    }
}
