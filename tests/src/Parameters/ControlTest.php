<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Parameters;

use GravityMedia\Ghostscript\Parameters\Control;
use GravityMedia\Ghostscript\Test\GhostscriptTestCase;

/**
 * Other parameters test object
 *
 * @package GravityMedia\GhostscriptTest\Parameters
 */
class ControlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Control::setSafer
     */
    public function testShouldBeSafer()
    {
        $control = new Control();
        $control->setSafer(true);

        $this->assertContains('-dSAFER', $control->getParametersAsArguments());
    }

    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Control::setSafer
     */
    public function testShouldBeNoSafer()
    {
        $control = new Control();
        $control->setSafer(false);

        $this->assertContains('-dNOSAFER', $control->getParametersAsArguments());
    }
}
