<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Test\Device;

use GravityMedia\Ghostscript\Device\Eps;
use GravityMedia\Ghostscript\Test\GhostscriptTestCase;

/**
 * EPS device test object
 *
 * @package GravityMedia\Ghostscript\Test\Device
 */
class EpsTest extends GhostscriptTestCase
{
    /**
     * @covers \GravityMedia\Ghostscript\Device\Eps::__construct
     */
    public function testShouldBePdfWriteDevice()
    {
        $eps = new Eps();

        $this->assertContains('-sDEVICE=\'eps2write\'', $eps->getDeviceOptionsAsArguments());
    }

    /**
     * @covers \GravityMedia\Ghostscript\Device\Eps::getDeviceName
     */
    public function testShouldIndicateCorrectDeviceName()
    {
        $eps = new Eps();

        $this->assertEquals('eps2write', $eps->getDeviceName());
    }
}
