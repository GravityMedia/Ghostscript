<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Test\Parameters;

use GravityMedia\Ghostscript\Parameters\Interaction;
use GravityMedia\Ghostscript\Test\GhostscriptTestCase;

/**
 * Interaction parameters test object
 *
 * @package GravityMedia\Ghostscript\Test\Parameters
 */
class InteractionTest extends GhostscriptTestCase
{
    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Interaction::getCommandParameterList
     */
    public function testShouldReturnCommandParameterList()
    {
        $interaction = new Interaction();

        $this->assertInstanceOf('\GravityMedia\Commander\Command\ParameterList', $interaction->getCommandParameterList());
    }

    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Interaction::setQuiet
     */
    public function testShouldBeQuiet()
    {
        $interaction = new Interaction();
        $interaction->setQuiet(true);

        $this->assertEquals('-dQUIET', strval($interaction->getCommandParameterList()));
    }

    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Interaction::setBatch
     */
    public function testShouldBeBatch()
    {
        $interaction = new Interaction();
        $interaction->setBatch(true);

        $this->assertEquals('-dBATCH', strval($interaction->getCommandParameterList()));
    }

    /**
     * @covers \GravityMedia\Ghostscript\Parameters\Interaction::setPause
     */
    public function testShouldBeNoPause()
    {
        $interaction = new Interaction();
        $interaction->setPause(false);

        $this->assertEquals('-dNOPAUSE', strval($interaction->getCommandParameterList()));
    }
}
