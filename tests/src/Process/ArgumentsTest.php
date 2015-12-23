<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Process;

use GravityMedia\Ghostscript\Process\Arguments;

/**
 * The arguments test class
 *
 * @package GravityMedia\GhostscriptTest\Process
 *
 * @covers  \GravityMedia\Ghostscript\Process\Arguments
 * @uses    \GravityMedia\Ghostscript\Process\Argument
 */
class ArgumentsTest extends \PHPUnit_Framework_TestCase
{
    public function testArgumentsConstruction()
    {
        $instance = new Arguments();

        $this->assertEquals([], $instance->toArray());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testArgumentConversionThrowsExceptionOnInvalidArgument()
    {
        $method = new \ReflectionMethod('GravityMedia\Ghostscript\Process\Arguments', 'convertArgument');
        $method->setAccessible(true);

        $method->invoke(new Arguments(), 0);
    }

    /**
     * @dataProvider provideArgumentsForAddition
     *
     * @param array $arguments
     * @param array $expected
     */
    public function testAddingArguments($arguments, $expected)
    {
        $instance = new Arguments();
        $instance->addArguments($arguments);

        $this->assertEquals($expected, $instance->toArray());
    }

    /**
     * @return array
     */
    public function provideArgumentsForAddition()
    {
        return [
            [['foo'], ['foo']],
            [['foo', 'foo'], ['foo', 'foo']],
            [['foo', 'foo=bar'], ['foo', 'foo=bar']]
        ];
    }

    /**
     * @dataProvider provideArgumentsForSetting
     *
     * @param array $arguments
     * @param array $expected
     */
    public function testSettingArguments($arguments, $expected)
    {
        $instance = new Arguments();
        $instance->setArguments($arguments);

        $this->assertEquals($expected, $instance->toArray());
    }

    /**
     * @return array
     */
    public function provideArgumentsForSetting()
    {
        return [
            [['foo'], ['foo']],
            [['foo', 'foo'], ['foo']],
            [['foo', 'foo=bar'], ['foo=bar']]
        ];
    }

    public function testGetArgument()
    {
        $instance = new Arguments();
        $instance->setArgument('foo=bar');

        $this->assertInstanceOf('GravityMedia\Ghostscript\Process\Argument', $instance->getArgument('foo'));
        $this->assertSame('bar', $instance->getArgument('foo')->getValue());
        $this->assertNull($instance->getArgument('bar'));
    }
}
