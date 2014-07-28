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
     * @covers \GravityMedia\Ghostscript\Parameters\Rendering::setColorscreen
     */
    public function testShouldHaveColorscreen()
    {
        $rendering = new Rendering();
        $rendering->setColorscreen(true);

        $this->assertContains('-dCOLORSCREEN', $rendering->getCommandParameterList());
    }

    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Rendering::setColorscreen
     */
    public function testShouldHaveNoColorscreen()
    {
        $rendering = new Rendering();
        $rendering->setColorscreen(false);

        $this->assertContains('-dCOLORSCREEN=\'false\'', $rendering->getCommandParameterList());
    }

    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Rendering::setColorscreen
     */
    public function testShouldHaveColorscreen0()
    {
        $rendering = new Rendering();
        $rendering->setColorscreen(0);

        $this->assertContains('-dCOLORSCREEN=\'0\'', $rendering->getCommandParameterList());
    }

    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Rendering::setDitherPpi
     */
    public function testShouldHaveDitherPpi()
    {
        $rendering = new Rendering();
        $rendering->setDitherPpi(72);

        $this->assertContains('-dDITHERPPI=\'72\'', $rendering->getCommandParameterList());
    }

    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Rendering::setTextAlphaBits
     */
    public function testShouldHaveTextAlphaBits()
    {
        $rendering = new Rendering();
        $rendering->setTextAlphaBits(4);

        $this->assertContains('-dTextAlphaBits=\'4\'', $rendering->getCommandParameterList());
    }

    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Rendering::setGraphicsAlphaBits
     */
    public function testShouldHaveGraphicsAlphaBits()
    {
        $rendering = new Rendering();
        $rendering->setGraphicsAlphaBits(4);

        $this->assertContains('-dGraphicsAlphaBits=\'4\'', $rendering->getCommandParameterList());
    }
}
