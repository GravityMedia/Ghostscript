<?php

namespace GravityMedia\Ghostscript\Device;

use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\Process\Argument;
use GravityMedia\Ghostscript\Process\Arguments;
use PHPUnit\Framework\TestCase;

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
class InkcovTest extends TestCase
{
    /**
     * Returns an OS independent representation of the commandline.
     *
     * @param string $commandline
     *
     * @return mixed
     */
    protected function quoteCommandLine($commandline)
    {
        if ('WIN' === strtoupper(substr(PHP_OS, 0, 3))) {
            return str_replace('"', '\'', $commandline);
        }

        return $commandline;
    }

    public function testDeviceCreation()
    {
        $ghostscript = new Ghostscript();
        $arguments = new Arguments();

        $device = new Inkcov($ghostscript, $arguments);

        $this->assertInstanceOf(Inkcov::class, $device);
        $this->assertInstanceOf(Argument::class, $arguments->getArgument('-sDEVICE'));
        $this->assertEquals('inkcov', $arguments->getArgument('-sDEVICE')->getValue());
    }
}
