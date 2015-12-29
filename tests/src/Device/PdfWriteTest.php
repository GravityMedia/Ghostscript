<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Device;

use GravityMedia\Ghostscript\Device\PdfWrite;
use GravityMedia\Ghostscript\Enum\PdfSettings;
use GravityMedia\Ghostscript\Process\Arguments as ProcessArguments;
use Symfony\Component\Process\ProcessBuilder;

/**
 * The PDF write device test class
 *
 * @package GravityMedia\GhostscriptTest\Devices
 *
 * @covers  \GravityMedia\Ghostscript\Device\PdfWrite
 *
 * @uses    \GravityMedia\Ghostscript\Process\Argument
 * @uses    \GravityMedia\Ghostscript\Process\Arguments
 * @uses    \GravityMedia\Ghostscript\Device\AbstractDevice
 * @uses    \GravityMedia\Ghostscript\Device\DistillerParametersTrait
 * @uses    \GravityMedia\Ghostscript\Enum\PdfSettings
 */
class PdfWriteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return PdfWrite
     */
    protected function createDevice()
    {
        $builder = new ProcessBuilder();
        $arguments = new ProcessArguments();

        return new PdfWrite($builder, $arguments);
    }

    public function testDeviceCreation()
    {
        $this->assertInstanceOf('GravityMedia\Ghostscript\Device\PdfWrite', $this->createDevice());
    }

    public function testOutputFileArgument()
    {
        $device = $this->createDevice();
        $outputFile = '/path/to/output/file.pdf';

        $this->assertNull($device->getOutputFile());
        $this->assertSame($outputFile, $device->setOutputFile($outputFile)->getOutputFile());
    }

    /**
     * @dataProvider providePdfSettings
     *
     * @param string $pdfSettings
     */
    public function testPdfSettingsArgument($pdfSettings)
    {
        $device = $this->createDevice();

        $this->assertSame(PdfSettings::__DEFAULT, $device->getPdfSettings());
        $this->assertSame($pdfSettings, $device->setPdfSettings($pdfSettings)->getPdfSettings());
    }

    /**
     * @return string[]
     */
    public function providePdfSettings()
    {
        return [
            [PdfSettings::__DEFAULT],
            [PdfSettings::SCREEN],
            [PdfSettings::EBOOK],
            [PdfSettings::PRINTER],
            [PdfSettings::PREPRESS]
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testPdfSettingsSetterThrowsExceptionOnInvalidArgument()
    {
        $this->createDevice()->setPdfSettings('/foo');
    }
}
