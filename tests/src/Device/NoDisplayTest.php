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
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * The no display device test class.
 *
 * @package GravityMedia\GhostscriptTest\Devices
 */
#[CoversClass(\GravityMedia\Ghostscript\Device\NoDisplay::class)]
#[UsesClass(\GravityMedia\Ghostscript\Ghostscript::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\AbstractDevice::class)]
#[UsesClass(\GravityMedia\Ghostscript\Process\Argument::class)]
#[UsesClass(\GravityMedia\Ghostscript\Process\Arguments::class)]
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
