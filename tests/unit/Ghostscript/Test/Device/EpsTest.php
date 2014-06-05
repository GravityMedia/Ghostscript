<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\Test\Device;

use Ghostscript\Device\Eps;

/**
 * EPS device test object
 *
 * @package Ghostscript\Test\Device
 */
class EpsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Ghostscript\Devices\Eps::__construct
     */
    public function testShouldBePdfWriteDevice()
    {
        $eps = new Eps();

        $this->assertEquals('-sDEVICE=\'eps2write\'', strval($eps->getCommandParameterList()));
    }

    /**
     * @covers \Ghostscript\Devices\Eps::getDeviceName
     */
    public function testShouldIndicateCorrectDeviceName()
    {
        $eps = new Eps();

        $this->assertEquals('eps2write', $eps->getDeviceName());
    }
}
