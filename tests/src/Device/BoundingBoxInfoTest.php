<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\GhostscriptTest\Device;

use GravityMedia\Ghostscript\Device\BoundingBoxInfo;
use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\Process\Arguments as ProcessArguments;
use Symfony\Component\Process\ProcessBuilder;

/**
 * The bounding box info device test class
 *
 * @package GravityMedia\GhostscriptTest\Devices
 *
 * @covers  \GravityMedia\Ghostscript\Device\BoundingBoxInfo
 *
 * @uses    \GravityMedia\Ghostscript\Device\AbstractDevice
 * @uses    \GravityMedia\Ghostscript\Process\Argument
 * @uses    \GravityMedia\Ghostscript\Process\Arguments
 */
class BoundingBoxInfoTest extends \PHPUnit_Framework_TestCase
{
    public function testDeviceCreation()
    {
        $ghostscript = new Ghostscript();
        $processArguments = new ProcessArguments();

        $bboxInfo = new BoundingBoxInfo($ghostscript, $processArguments);

        $this->assertInstanceOf('GravityMedia\Ghostscript\Device\BoundingBoxInfo', $bboxInfo);
        $arg = $processArguments->getArgument('-sDEVICE');
        $this->assertInstanceOf('GravityMedia\Ghostscript\Process\Argument', $arg);
        $this->assertEquals('bbox', $arg->getValue());
    }
}
