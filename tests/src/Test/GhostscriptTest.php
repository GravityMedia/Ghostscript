<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Test;

use GravityMedia\Ghostscript\Ghostscript;

/**
 * The Ghostscript test object
 *
 * @package GravityMedia\Ghostscript\Test
 */
class GhostscriptTest extends GhostscriptTestCase
{

    /**
     * @covers \GravityMedia\Ghostscript\Ghostscript::__construct
     */
    public function testShouldBeConstructable()
    {
        new Ghostscript();
    }

    /**
     * @covers       \GravityMedia\Ghostscript\Ghostscript::__construct
     * @dataProvider \GravityMedia\Ghostscript\Test\GhostscriptTest::getInvalidConstructorArguments
     *
     * @expectedException \RuntimeException
     * @param array $options
     */
    public function testShouldThrowExceptionOnInvalidConstructorArguments(array $options)
    {
        new Ghostscript($options);
    }

    /**
     * Data provider for \GravityMedia\Ghostscript\Test\GhostscriptTest::testShouldThrowExceptionOnInvalidConstructorArguments
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
     * @covers       \GravityMedia\Ghostscript\Ghostscript::getOption
     * @dataProvider \GravityMedia\Ghostscript\Test\GhostscriptTest::getValidConstructorArguments
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
     * Data provider for \GravityMedia\Ghostscript\Test\GhostscriptTest::testShouldThrowExceptionOnInvalidConstructorArguments
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
