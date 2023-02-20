<?php

namespace GravityMedia\GhostscriptTest\Device;

use GravityMedia\Ghostscript\Device\AbstractDevice;
use GravityMedia\Ghostscript\Device\Inkcov;
use GravityMedia\Ghostscript\Process\Argument;

/**
 * The inkcov device test class.
 *
 * @package GravityMedia\GhostscriptTest\Devices
 *
 * @covers  \GravityMedia\Ghostscript\Device\Inkcov
 *
 * @uses    \GravityMedia\Ghostscript\Ghostscript
 * @uses    \GravityMedia\Ghostscript\Input
 * @uses    \GravityMedia\Ghostscript\Device\AbstractDevice
 * @uses    \GravityMedia\Ghostscript\Device\NoDisplay
 * @uses    \GravityMedia\Ghostscript\Process\Argument
 * @uses    \GravityMedia\Ghostscript\Process\Arguments
 */
class InkcovTest extends DeviceTestCase
{
    protected function createDevice(?string $version = null): AbstractDevice
    {
        return new Inkcov($this->getGhostscript($version), $this->arguments);
    }

    public function testDeviceCreation()
    {
        $device = $this->createDevice();

        $this->assertInstanceOf(Inkcov::class, $device);
        $this->assertInstanceOf(Argument::class, $this->arguments->getArgument('-sDEVICE'));
        $this->assertEquals('inkcov', $this->arguments->getArgument('-sDEVICE')->getValue());
    }
}
