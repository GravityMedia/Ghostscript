<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Test\Parameters;

use GravityMedia\Ghostscript\Parameters\Control;
use GravityMedia\Ghostscript\Test\GhostscriptTestCase;

/**
 * Other parameters test object
 *
 * @package GravityMedia\Ghostscript\Test\Parameters
 */
class ControlTest extends GhostscriptTestCase
{
    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Control::getCommandParameterList
     */
    public function testShouldReturnCommandParameterList()
    {
        $control = new Control();

        $this->assertInstanceOf('\GravityMedia\Commander\Command\ParameterList', $control->getCommandParameterList());
    }

    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Control::setSafer
     */
    public function testShouldBeSafer()
    {
        $control = new Control();
        $control->setSafer(true);

        $this->assertEquals('-dSAFER', strval($control->getCommandParameterList()));
    }

    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Control::setSafer
     */
    public function testShouldBeNoSafer()
    {
        $control = new Control();
        $control->setSafer(false);

        $this->assertEquals('-dNOSAFER', strval($control->getCommandParameterList()));
    }
}
