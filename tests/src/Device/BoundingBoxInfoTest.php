<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\GhostscriptTest\Device;

use GravityMedia\Ghostscript\Device\AbstractDevice;
use GravityMedia\Ghostscript\Device\BoundingBoxInfo;
use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\Process\Argument;
use GravityMedia\Ghostscript\Process\Arguments;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

/**
 * The bounding box info device test class.
 *
 * @package GravityMedia\GhostscriptTest\Devices
 */
#[CoversClass(\GravityMedia\Ghostscript\Device\BoundingBoxInfo::class)]
#[UsesClass(\GravityMedia\Ghostscript\Ghostscript::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\AbstractDevice::class)]
#[UsesClass(\GravityMedia\Ghostscript\Process\Argument::class)]
#[UsesClass(\GravityMedia\Ghostscript\Process\Arguments::class)]
class BoundingBoxInfoTest extends DeviceTestCase
{
    protected function createDevice(?string $version = null): AbstractDevice
    {
        return new BoundingBoxInfo($this->getGhostscript($version), $this->arguments);
    }

    public function testDeviceCreation()
    {
        $device = $this->createDevice();

        $this->assertInstanceOf(BoundingBoxInfo::class, $device);

        $argument = $this->arguments->getArgument('-sDEVICE');

        $this->assertInstanceOf(Argument::class, $argument);
        $this->assertEquals('bbox', $argument->getValue());
    }
}
