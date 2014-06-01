<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\Test;

use Ghostscript\Ghostscript;
use Ghostscript\Test\GhostscriptTestCase;

/**
 * The Ghostscript test object
 *
 * @package Ghostscript\Test
 */
class GhostscriptTest extends GhostscriptTestCase
{

    /**
     * @covers \Ghostscript\Ghostscript::__construct
     */
    public function testShouldBeConstructable()
    {
        new Ghostscript();
    }

    /**
     * @covers \Ghostscript\Ghostscript::__construct
     *
     * @expectedException \RuntimeException
     *
     * @dataProvider getInvalidConstructorArguments
     *
     * @param array $options
     */
    public function testShouldThrowExceptionOnInvalidConstructorArguments(array $options)
    {
        new Ghostscript($options);
    }

    /**
     * Data provider for testShouldThrowExceptionOnInvalidConstructorArguments
     *
     * @return array
     */
    public function getInvalidConstructorArguments()
    {
        return array(
            array(array(
                'command' => 'wrong-gs-command'
            ))
        );
    }

    /**
     * @covers \Ghostscript\Ghostscript::getOption
     *
     * @dataProvider getValidConstructorArguments
     *
     * @param array $options
     */
    public function testShouldReturnAnOptionFromValidConstructorArguments(array $options)
    {
        $key = 'command';
        $expected = $options[$key];
        $ghostscript = new Ghostscript($options);
        $actual = $ghostscript->getOption('command');

        $this->assertEquals($expected, $actual);
    }

    /**
     * Data provider for testShouldThrowExceptionOnInvalidConstructorArguments
     *
     * @return array
     */
    public function getValidConstructorArguments()
    {
        return array(
            array(array(
                'command' => 'gs'
            ))
        );
    }
}
