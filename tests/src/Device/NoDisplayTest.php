<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\GhostscriptTest\Device;

use GravityMedia\Ghostscript\Device\NoDisplay;
use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\Process\Arguments as ProcessArguments;

/**
 * The null device test class
 *
 * @package GravityMedia\GhostscriptTest\Devices
 *
 * @covers  \GravityMedia\Ghostscript\Device\NoDisplay
 *
 * @uses    \GravityMedia\Ghostscript\Ghostscript
 * @uses    \GravityMedia\Ghostscript\Device\AbstractDevice
 * @uses    \GravityMedia\Ghostscript\Process\Argument
 * @uses    \GravityMedia\Ghostscript\Process\Arguments
 */
class NoDisplayTest extends \PHPUnit_Framework_TestCase
{
    public function testDeviceCreation()
    {
        $ghostscript = new Ghostscript();
        $processArguments = new ProcessArguments();

        $noDisplay = new NoDisplay($ghostscript, $processArguments);

        $this->assertInstanceOf('GravityMedia\Ghostscript\Device\NoDisplay', $noDisplay);
        $this->assertInstanceOf('GravityMedia\Ghostscript\Process\Argument', $processArguments->getArgument('-dNODISPLAY'));
    }
}
