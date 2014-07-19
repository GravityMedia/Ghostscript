<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Test\Parameters;

use GravityMedia\Ghostscript\Parameters\Rendering;
use GravityMedia\Ghostscript\Test\GhostscriptTestCase;

/**
 * Rendering parameters test object
 *
 * @package GravityMedia\Ghostscript\Test\Parameters
 */
class RenderingTest extends GhostscriptTestCase
{
    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Rendering::getCommandParameterList
     */
    public function testShouldReturnCommandParameterList()
    {
        $rendering = new Rendering();

        $this->assertInstanceOf('\GravityMedia\Commander\Command\ParameterList', $rendering->getCommandParameterList());
    }

    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Rendering::setColorscreen
     */
    public function testShouldHaveColorscreen()
    {
        $rendering = new Rendering();
        $rendering->setColorscreen(true);

        $this->assertEquals('-dCOLORSCREEN', strval($rendering->getCommandParameterList()));
    }

    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Rendering::setColorscreen
     */
    public function testShouldHaveNoColorscreen()
    {
        $rendering = new Rendering();
        $rendering->setColorscreen(false);

        $this->assertEquals('-dCOLORSCREEN=\'false\'', strval($rendering->getCommandParameterList()));
    }

    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Rendering::setColorscreen
     */
    public function testShouldHaveColorscreen0()
    {
        $rendering = new Rendering();
        $rendering->setColorscreen(0);

        $this->assertEquals('-dCOLORSCREEN=\'0\'', strval($rendering->getCommandParameterList()));
    }

    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Rendering::setDitherPpi
     */
    public function testShouldHaveDitherPpi()
    {
        $rendering = new Rendering();
        $rendering->setDitherPpi(72);

        $this->assertEquals('-dDITHERPPI=\'72\'', strval($rendering->getCommandParameterList()));
    }

    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Rendering::setTextAlphaBits
     */
    public function testShouldHaveTextAlphaBits()
    {
        $rendering = new Rendering();
        $rendering->setTextAlphaBits(4);

        $this->assertEquals('-dTextAlphaBits=\'4\'', strval($rendering->getCommandParameterList()));
    }

    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Rendering::setGraphicsAlphaBits
     */
    public function testShouldHaveGraphicsAlphaBits()
    {
        $rendering = new Rendering();
        $rendering->setGraphicsAlphaBits(4);

        $this->assertEquals('-dGraphicsAlphaBits=\'4\'', strval($rendering->getCommandParameterList()));
    }
}
