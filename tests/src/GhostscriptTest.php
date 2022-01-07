<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest;

use GravityMedia\Ghostscript\Device\BoundingBoxInfo;
use GravityMedia\Ghostscript\Device\Inkcov;
use GravityMedia\Ghostscript\Device\NoDisplay;
use GravityMedia\Ghostscript\Device\PdfInfo;
use GravityMedia\Ghostscript\Device\PdfWrite;
use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\Process\Arguments;
use PHPUnit\Framework\TestCase;

/**
 * The Ghostscript test class
 *
 * @package GravityMedia\GhostscriptTest
 *
 * @covers  \GravityMedia\Ghostscript\Ghostscript
 *
 * @uses    \GravityMedia\Ghostscript\Input
 * @uses    \GravityMedia\Ghostscript\Enum\PdfSettings
 * @uses    \GravityMedia\Ghostscript\Device\AbstractDevice
 * @uses    \GravityMedia\Ghostscript\Device\CommandLineParameters\EpsTrait
 * @uses    \GravityMedia\Ghostscript\Device\CommandLineParameters\FontTrait
 * @uses    \GravityMedia\Ghostscript\Device\CommandLineParameters\IccColorTrait
 * @uses    \GravityMedia\Ghostscript\Device\CommandLineParameters\InteractionTrait
 * @uses    \GravityMedia\Ghostscript\Device\CommandLineParameters\OtherTrait
 * @uses    \GravityMedia\Ghostscript\Device\CommandLineParameters\OutputSelectionTrait
 * @uses    \GravityMedia\Ghostscript\Device\CommandLineParameters\PageTrait
 * @uses    \GravityMedia\Ghostscript\Device\CommandLineParameters\RenderingTrait
 * @uses    \GravityMedia\Ghostscript\Device\CommandLineParameters\ResourceTrait
 * @uses    \GravityMedia\Ghostscript\Device\DistillerParametersTrait
 * @uses    \GravityMedia\Ghostscript\Device\BoundingBoxInfo
 * @uses    \GravityMedia\Ghostscript\Device\Inkcov
 * @uses    \GravityMedia\Ghostscript\Device\NoDisplay
 * @uses    \GravityMedia\Ghostscript\Device\PdfInfo
 * @uses    \GravityMedia\Ghostscript\Device\PdfWrite
 * @uses    \GravityMedia\Ghostscript\Process\Argument
 * @uses    \GravityMedia\Ghostscript\Process\Arguments
 */
class GhostscriptTest extends TestCase
{
    public function testCreateGhostscriptObject()
    {
        $this->assertInstanceOf(Ghostscript::class, new Ghostscript());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Ghostscript version 9.00 or higher is required
     */
    public function testCreateGhostscriptObjectThrowsExceptionOnInvalidVersion()
    {
        $this->expectExceptionMessage('Ghostscript version 9.00 or higher is required');

        $mock = $this->getMockBuilder(Ghostscript::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mock->expects($this->once())
            ->method('getVersion')
            ->will($this->returnValue('8.00'));

        $class = new \ReflectionClass(Ghostscript::class);
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

    public function testGetVersion()
    {
        $instance = new Ghostscript();

        $this->assertMatchesRegularExpression('/^[0-9]\.[0-9]+$/', $instance->getVersion());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testGetVersionThrowsExceptionOnFailure()
    {
        $this->expectExceptionMessage('sh: /foo/bar/baz: No such file or directory');

        new Ghostscript(['bin' => '/foo/bar/baz']);
    }

    public function testProcessArgumentsCreation()
    {
        $method = new \ReflectionMethod(Ghostscript::class, 'createArguments');
        $method->setAccessible(true);

        $this->assertInstanceOf(Arguments::class, $method->invoke(new Ghostscript()));
    }

    public function testPdfDeviceCreation()
    {
        $instance = new Ghostscript();

        $this->assertInstanceOf(PdfWrite::class, $instance->createPdfDevice());
    }

    public function testNullDeviceCreation()
    {
        $instance = new Ghostscript();

        $this->assertInstanceOf(NoDisplay::class, $instance->createNoDisplayDevice());
    }

    public function testPdfInfoDeviceCreation()
    {
        $instance = new Ghostscript();
        $pdfInfoPath = 'path/to/pdf_info.ps';
        $pdfInfo = $instance->createPdfInfoDevice($pdfInfoPath);

        $this->assertInstanceOf(PdfInfo::class, $pdfInfo);

        $field = new \ReflectionProperty(PdfInfo::class, 'pdfInfoPath');
        $field->setAccessible(true);
        $this->assertEquals($pdfInfoPath, $field->getValue($pdfInfo));
    }

    public function testBoundingBoxInfoCreation()
    {
        $instance = new Ghostscript();

        $this->assertInstanceOf(BoundingBoxInfo::class, $instance->createBoundingBoxInfoDevice());
    }

    public function testInkcovDeviceCreation()
    {
        $instance = new Ghostscript();
        $device = $instance->createInkcovDevice();

        $this->assertInstanceOf(Inkcov::class, $device);
        $this->assertEquals("'gs' '-o' '-' '-sDEVICE=inkcov'", $device->createProcess()->getCommandLine());
    }

    /**
     * @dataProvider provideTimeout
     *
     * @param null|int $value
     * @param null|int $result
     */
    public function testTimeoutOption($value, $result)
    {
        $instance = new Ghostscript(['timeout' => $value]);
        $device = $instance->createPdfDevice('/path/to/output/file.pdf');
        $process = $device->createProcess(__DIR__ . '/../data/input.pdf');

        $this->assertEquals($result, $process->getTimeout());
    }

    /**
     * @return array
     */
    public function provideTimeout()
    {
        return [
            [42, 42],
            [0, null],
            [null, null],
        ];
    }
}
