<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\Ghostscript\Device;

use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\Process\Arguments as ProcessArguments;

/**
 * The bounding box info device class
 *
 * @link    http://ghostscript.com/doc/current/Devices.htm#Bounding_box_output
 *
 * @package GravityMedia\Ghostscript\Devices
 */
class BoundingBoxInfo extends AbstractDevice
{
    /**
     * Create bounding box info device object
     *
     * @param Ghostscript      $ghostscript
     * @param ProcessArguments $arguments
     */
    public function __construct(Ghostscript $ghostscript, ProcessArguments $arguments)
    {
        parent::__construct($ghostscript, $arguments->setArgument('-sDEVICE=bbox'));
    }
}
