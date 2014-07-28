<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Test\Device;

use GravityMedia\Ghostscript\Device\Ps;
use GravityMedia\Ghostscript\Test\GhostscriptTestCase;

/**
 * PS device test object
 *
 * @package GravityMedia\Ghostscript\Test\Device
 */
class PsTest extends GhostscriptTestCase
{
    /**
     * @covers \GravityMedia\Ghostscript\Device\Ps::__construct
     */
    public function testShouldBePdfWriteDevice()
    {
        $ps = new Ps();

        $this->assertContains('-sDEVICE=\'ps2write\'', $ps->getCommandParameterList());
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
