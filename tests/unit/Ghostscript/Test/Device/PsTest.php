<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\Test\Device;

use Ghostscript\Device\Ps;

/**
 * PS device test object
 *
 * @package Ghostscript\Test\Device
 */
class PsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Ghostscript\Devices\Ps::__construct
     */
    public function testShouldBePdfWriteDevice()
    {
        $ps = new Ps();

        $this->assertEquals('-sDEVICE=\'ps2write\'', strval($ps->getCommandParameterList()));
    }

    /**
     * @covers \Ghostscript\Devices\Ps::getDeviceName
     */
    public function testShouldIndicateCorrectDeviceName()
    {
        $ps = new Ps();

        $this->assertEquals('ps2write', $ps->getDeviceName());
    }
}
