<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\GhostscriptTest\Device;

use GravityMedia\Ghostscript\Device\AbstractDevice;
use GravityMedia\Ghostscript\Device\NoDisplay;
use GravityMedia\Ghostscript\Process\Argument;

/**
 * The no display device test class.
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
class NoDisplayTest extends DeviceTestCase
{
    protected function createDevice(?string $version = null): AbstractDevice
    {
        $ghostscript = $this->getGhostscript($version);

        return new NoDisplay($ghostscript, $this->arguments);
    }

    public function testDeviceCreation()
    {
        $device = $this->createDevice();

        $this->assertInstanceOf(NoDisplay::class, $device);
        $this->assertInstanceOf(Argument::class, $this->arguments->getArgument('-dNODISPLAY'));
    }
}
