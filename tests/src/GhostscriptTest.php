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
 *
 * @covers  \GravityMedia\Ghostscript\Ghostscript
 *
 * @uses    \GravityMedia\Ghostscript\Enum\PdfSettings
 * @uses    \GravityMedia\Ghostscript\Device\AbstractDevice
 * @uses    \GravityMedia\Ghostscript\Device\DistillerParametersTrait
 * @uses    \GravityMedia\Ghostscript\Device\NoDisplay
 * @uses    \GravityMedia\Ghostscript\Device\PdfWrite
 * @uses    \GravityMedia\Ghostscript\Process\Argument
 * @uses    \GravityMedia\Ghostscript\Process\Arguments
 */
class GhostscriptTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateGhostscriptObject()
    {
        $this->assertInstanceOf('GravityMedia\Ghostscript\Ghostscript', new Ghostscript());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Ghostscript version 9.00 or higher is required
     */
    public function testCreateGhostscriptObjectThrowsExceptionOnInvalidVersion()
    {
        $mock = $this->getMockBuilder('GravityMedia\Ghostscript\Ghostscript')
            ->disableOriginalConstructor()
            ->getMock();

        $mock->expects($this->once())
            ->method('getVersion')
            ->will($this->returnValue('8.00'));

        $class = new \ReflectionClass('GravityMedia\Ghostscript\Ghostscript');
        $constructor = $class->getConstructor();
        $constructor->invoke($mock);
    }

    /**
     * @dataProvider provideOptions
     *
     * @param array  $options
     * @param string $name
     * @param mixed  $value
     */
    public function testGetOption(array $options, $name, $value)
    {
        $instance = new Ghostscript($options);

        $this->assertSame($value, $instance->getOption($name));
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

    public function testProcessBuilderCreation()
    {
        $method = new \ReflectionMethod('GravityMedia\Ghostscript\Ghostscript', 'createProcessBuilder');
        $method->setAccessible(true);

        $this->assertInstanceOf('Symfony\Component\Process\ProcessBuilder', $method->invoke(new Ghostscript()));
    }

    public function testGetVersion()
    {
        $instance = new Ghostscript();

        $this->assertRegExp('/^[0-9]\.[0-9]+$/', $instance->getVersion());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testGetVersionThrowsExceptionOnFailure()
    {
        new Ghostscript(['bin' => '/foo/bar/baz']);
    }

    public function testProcessArgumentsCreation()
    {
        $method = new \ReflectionMethod('GravityMedia\Ghostscript\Ghostscript', 'createProcessArguments');
        $method->setAccessible(true);

        $this->assertInstanceOf('GravityMedia\Ghostscript\Process\Arguments', $method->invoke(new Ghostscript()));
    }

    public function testPdfDeviceCreation()
    {
        $instance = new Ghostscript();

        $this->assertInstanceOf('GravityMedia\Ghostscript\Device\PdfWrite', $instance->createPdfDevice('/path/to/output/file.pdf'));
    }

    public function testNullDeviceCreation()
    {
        $instance = new Ghostscript();

        $this->assertInstanceOf('GravityMedia\Ghostscript\Device\NoDisplay', $instance->createNullDevice());
    }

    /**
     * @dataProvider provideTimeout
     */
    public function testTimeoutOption($value, $result)
    {
        $instance = new Ghostscript(['timeout' => $value]);
        $device = $instance->createPdfDevice('/path/to/output/file.pdf');
        $process = $device->createProcess(__DIR__ . '/../data/input.pdf');

        $this->assertEquals($result, $process->getTimeout());
    }

    public function provideTimeout()
    {
        return [
            [42, 42],
            [0, null],
            [null, null],
        ];
    }
}
