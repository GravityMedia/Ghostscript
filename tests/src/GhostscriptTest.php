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
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

/**
 * The Ghostscript test class
 *
 * @package GravityMedia\GhostscriptTest
 */
#[CoversClass(\GravityMedia\Ghostscript\Ghostscript::class)]
#[UsesClass(\GravityMedia\Ghostscript\Input::class)]
#[UsesClass(\GravityMedia\Ghostscript\Enum\PdfSettings::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\AbstractDevice::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\CommandLineParameters\EpsTrait::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\CommandLineParameters\FontTrait::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\CommandLineParameters\IccColorTrait::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\CommandLineParameters\InteractionTrait::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\CommandLineParameters\OtherTrait::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\CommandLineParameters\OutputSelectionTrait::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\CommandLineParameters\PageTrait::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\CommandLineParameters\RenderingTrait::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\CommandLineParameters\ResourceTrait::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\DistillerParametersTrait::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\BoundingBoxInfo::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\Inkcov::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\NoDisplay::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\PdfInfo::class)]
#[UsesClass(\GravityMedia\Ghostscript\Device\PdfWrite::class)]
#[UsesClass(\GravityMedia\Ghostscript\Process\Argument::class)]
#[UsesClass(\GravityMedia\Ghostscript\Process\Arguments::class)]
class GhostscriptTest extends TestCase
{
    public function testCreateGhostscriptObject()
    {
        $this->assertInstanceOf(Ghostscript::class, new Ghostscript());
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
    public static function provideOptions()
    {
        return [
            [[], 'foo', null],
            [['foo' => 'bar'], 'foo', 'bar']
        ];
    }

    public function testGetVersion()
    {
        $instance = new Ghostscript();

        $this->assertMatchesRegularExpression('/^[0-9]+\.[0-9\.]+$/', $instance->getVersion());
    }

    public function testGetVersionThrowsExceptionOnFailure()
    {
        $this->expectExceptionMessageMatches('/exec: \/foo\/bar\/baz/');
        $ghostscript = new Ghostscript(['bin' => '/foo/bar/baz']);
        $ghostscript->getVersion();
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
    public static function provideTimeout()
    {
        return [
            [42, 42],
            [0, null],
            [null, null],
        ];
    }
}
