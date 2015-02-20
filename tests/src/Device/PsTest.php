<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Device;

use GravityMedia\Ghostscript\Device\Ps;
use GravityMedia\Ghostscript\Test\GhostscriptTestCase;

/**
 * PS device test object
 *
 * @package GravityMedia\GhostscriptTest\Device
 */
class PsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \GravityMedia\Ghostscript\Device\Ps::__construct
     */
    public function testShouldBePdfWriteDevice()
    {
        $ps = new Ps();

        $this->assertContains('-sDEVICE=\'ps2write\'', $ps->getDeviceOptionsAsArguments());
    }

    /**
     * @covers \GravityMedia\Ghostscript\Device\Ps::getDeviceName
     */
    public function testShouldIndicateCorrectDeviceName()
    {
        $ps = new Ps();

        $this->assertEquals('ps2write', $ps->getDeviceName());
    }
}
