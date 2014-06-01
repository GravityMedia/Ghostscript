<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\Test\Parameters;

use Ghostscript\Parameters\Other;
use Ghostscript\Test\GhostscriptTestCase;

/**
 * Other parameters test object
 *
 * @package Ghostscript\Test\Parameters
 */
class OtherTest extends GhostscriptTestCase
{
    /**
     * @covers \Ghostscript\Parameters\Other::setSafer
     */
    public function testShouldBeSafer()
    {
        $other = new Other();
        $other->setSafer(true);

        $this->assertEquals('-dSAFER', strval($other->toFlags()));
    }

    /**
     * @covers \Ghostscript\Parameters\Other::setSafer
     */
    public function testShouldBeNoSafer()
    {
        $other = new Other();
        $other->setSafer(false);

        $this->assertEquals('-dNOSAFER', strval($other->toFlags()));
    }
}
