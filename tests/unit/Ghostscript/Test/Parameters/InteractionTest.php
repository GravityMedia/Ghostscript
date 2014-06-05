<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\Test\Parameters;

use Ghostscript\Parameters\Interaction;
use Ghostscript\Test\GhostscriptTestCase;

/**
 * Interaction parameters test object
 *
 * @package Ghostscript\Test\Parameters
 */
class InteractionTest extends GhostscriptTestCase
{
    /**
     * @covers \Ghostscript\Parameters\Interaction::setQuiet
     */
    public function testShouldBeQuiet()
    {
        $interaction = new Interaction();
        $interaction->setQuiet(true);

        $this->assertEquals('-dQUIET', strval($interaction->getCommandParameterList()));
    }

    /**
     * @covers \Ghostscript\Parameters\Interaction::setBatch
     */
    public function testShouldBeBatch()
    {
        $interaction = new Interaction();
        $interaction->setBatch(true);

        $this->assertEquals('-dBATCH', strval($interaction->getCommandParameterList()));
    }

    /**
     * @covers \Ghostscript\Parameters\Interaction::setPause
     */
    public function testShouldBeNoPause()
    {
        $interaction = new Interaction();
        $interaction->setPause(false);

        $this->assertEquals('-dNOPAUSE', strval($interaction->getCommandParameterList()));
    }
}
