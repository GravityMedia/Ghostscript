<?php

namespace GravityMedia\GhostscriptTest\Device;

use GravityMedia\Ghostscript\Device\AbstractDevice;
use GravityMedia\Ghostscript\Device\Inkcov;
use GravityMedia\Ghostscript\Process\Argument;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

/**
 * The inkcov device test class.
 *
 * @package GravityMedia\GhostscriptTest\Devices
 */
#[CoversClass(\GravityMedia\Ghostscript\Device\Inkcov::class)]
#[UsesClass(\GravityMedia\Ghostscript\Ghostscript::class)]
#[UsesClass(\GravityMedia\Ghostscript\Input::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\AbstractDevice::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\NoDisplay::class)]
#[UsesClass(\GravityMedia\Ghostscript\Process\Argument::class)]
#[UsesClass(\GravityMedia\Ghostscript\Process\Arguments::class)]
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
