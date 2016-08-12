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
 * The null device class
 *
 * @package GravityMedia\Ghostscript\Devices
 */
class NoDisplay extends AbstractDevice
{
    const POSTSCRIPT_COMMANDS = '';

    /**
     * Create null device object
     *
     * @param ProcessBuilder   $builder
     * @param ProcessArguments $arguments
     */
    public function __construct(ProcessBuilder $builder, ProcessArguments $arguments)
    {
        parent::__construct($builder, $arguments->setArgument('-dNODISPLAY'));
    }
}
