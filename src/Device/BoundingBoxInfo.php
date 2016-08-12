<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\Ghostscript\Device;

use GravityMedia\Ghostscript\Process\Arguments as ProcessArguments;
use Symfony\Component\Process\ProcessBuilder;

/**
 * The bounding box (bbox) info device class
 * @link http://ghostscript.com/doc/current/Devices.htm#Bounding_box_output
 *
 * @package GravityMedia\Ghostscript\Devices
 */
class BoundingBoxInfo extends AbstractDevice
{
    const POSTSCRIPT_COMMANDS = '';

    /**
     * Create bounding box (bbox) info device object
     *
     * @param ProcessBuilder   $builder
     * @param ProcessArguments $arguments
     */
    public function __construct(ProcessBuilder $builder, ProcessArguments $arguments)
    {
        parent::__construct($builder, $arguments->setArgument('-sDEVICE=bbox'));
    }
}
