<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest;

use GravityMedia\Ghostscript\Ghostscript;

/**
 * The Ghostscript test class
 *
 * @package GravityMedia\GhostscriptTest
 */
class GhostscriptTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \GravityMedia\Ghostscript\Ghostscript::__construct()
     *
     * @uses   \GravityMedia\Ghostscript\Ghostscript::getOption()
     */
    public function testCreateGhostscriptObject()
    {
        $this->assertInstanceOf('GravityMedia\Ghostscript\Ghostscript', new Ghostscript());
    }

    /**
     * @covers       \GravityMedia\Ghostscript\Ghostscript::getOption()
     *
     * @uses         \GravityMedia\Ghostscript\Ghostscript::__construct()
     *
     * @dataProvider provideOptions
     */
    public function testGetOption(array $options, $name, $value)
    {
        $ghostscript = new Ghostscript($options);

        $this->assertSame($value, $ghostscript->getOption($name));
    }

    /**
     * @return array
     */
    public function provideOptions()
    {
        return [
            [[], 'foo', null],
            [['foo' => 'bar'], 'foo', 'bar']
        ];
    }
}
