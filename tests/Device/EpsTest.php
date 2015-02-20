<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Device;

use GravityMedia\Ghostscript\Device\Eps;
use GravityMedia\Ghostscript\Test\GhostscriptTestCase;

/**
 * EPS device test object
 *
 * @package GravityMedia\GhostscriptTest\Device
 */
class EpsTest extends \PHPUnit_Framework_TestCase
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
