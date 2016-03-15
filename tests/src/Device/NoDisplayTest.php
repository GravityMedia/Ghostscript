<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\GhostscriptTest\Device;

use GravityMedia\Ghostscript\Device\NoDisplay;
use GravityMedia\Ghostscript\Process\Argument;
use GravityMedia\Ghostscript\Process\Arguments as ProcessArguments;
use Symfony\Component\Process\ProcessBuilder;

/**
 * The null device test class
 *
 * @package GravityMedia\GhostscriptTest\Devices
 *
 * @covers  \GravityMedia\Ghostscript\Device\NoDisplay
 *
 * @uses    \GravityMedia\Ghostscript\Device\AbstractDevice
 * @uses    \GravityMedia\Ghostscript\Process\Argument
 * @uses    \GravityMedia\Ghostscript\Process\Arguments
 */
class NoDisplayTest extends \PHPUnit_Framework_TestCase
{
    public function testDeviceCreation()
    {
        $processBuilder = new ProcessBuilder();
        $processArguments = new ProcessArguments();

        $noDisplay = new NoDisplay($processBuilder, $processArguments);

        $this->assertInstanceOf(NoDisplay::class, $noDisplay);
        $this->assertInstanceOf(Argument::class, $processArguments->getArgument('-dNODISPLAY'));
    }
}
