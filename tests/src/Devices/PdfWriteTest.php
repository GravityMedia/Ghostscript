<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Devices;

use GravityMedia\Ghostscript\Devices\PdfWrite;
use GravityMedia\Ghostscript\Process\Arguments as ProcessArguments;
use Symfony\Component\Process\ProcessBuilder;

/**
 * The PDF write device test class
 *
 * @package GravityMedia\GhostscriptTest\Devices
 *
 * @covers  \GravityMedia\Ghostscript\Devices\PdfWrite
 *
 * @uses    \GravityMedia\Ghostscript\Process\Argument
 * @uses    \GravityMedia\Ghostscript\Process\Arguments
 * @uses    \GravityMedia\Ghostscript\Devices\AbstractDevice
 * @uses    \GravityMedia\Ghostscript\Devices\DistillerParametersTrait
 */
class PdfWriteTest extends \PHPUnit_Framework_TestCase
{
    public function testDeviceCreation()
    {
        $builder = new ProcessBuilder();
        $arguments = new ProcessArguments();

        $this->assertInstanceOf('GravityMedia\Ghostscript\Devices\PdfWrite', new PdfWrite($builder, $arguments));
    }
}
