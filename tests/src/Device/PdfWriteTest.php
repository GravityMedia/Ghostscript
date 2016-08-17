<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Device;

use GravityMedia\Ghostscript\Device\PdfWrite;
use GravityMedia\Ghostscript\Enum\PdfSettings;
use GravityMedia\Ghostscript\Enum\ProcessColorModel;
use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\Process\Arguments as ProcessArguments;

/**
 * The PDF write device test class.
 *
 * @package GravityMedia\GhostscriptTest\Devices
 *
 * @covers  \GravityMedia\Ghostscript\Device\PdfWrite
 *
 * @uses    \GravityMedia\Ghostscript\Ghostscript
 * @uses    \GravityMedia\Ghostscript\Input
 * @uses    \GravityMedia\Ghostscript\Enum\PdfSettings
 * @uses    \GravityMedia\Ghostscript\Enum\ProcessColorModel
 * @uses    \GravityMedia\Ghostscript\Device\AbstractDevice
 * @uses    \GravityMedia\Ghostscript\Device\DistillerParametersTrait
 * @uses    \GravityMedia\Ghostscript\Process\Argument
 * @uses    \GravityMedia\Ghostscript\Process\Arguments
 */
class PdfWriteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Returns an OS independent representation of the commandline.
     *
     * @param string $commandline
     *
     * @return mixed
     */
    protected function quoteCommandLine($commandline)
    {
        if ('WIN' === strtoupper(substr(PHP_OS, 0, 3))) {
            return str_replace('"', '\'', $commandline);

        }

        return $commandline;
    }

    /**
     * @return PdfWrite
     */
    protected function createDevice()
    {
        $ghostscript = new Ghostscript();
        $processArguments = new ProcessArguments();

        return new PdfWrite($ghostscript, $processArguments);
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

    /**
     * @dataProvider provideProcessColorModel
     *
     * @param string $processColorModel
     */
    public function testProcessColorModelArgument($processColorModel)
    {
        $device = $this->createDevice();
        $this->assertSame($processColorModel, $device->setProcessColorModel($processColorModel)->getProcessColorModel());
    }

    /**
     * @return string[]
     */
    public function provideProcessColorModel()
    {
        return [
            [ProcessColorModel::DEVICE_RGB],
            [ProcessColorModel::DEVICE_CMYK],
            [ProcessColorModel::DEVICE_GRAY]
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testProcessColorModelSetterThrowsExceptionOnInvalidArgument()
    {
        $this->createDevice()->setProcessColorModel('/foo');
    }

    public function testProcessCreation()
    {
        $process = $this->createDevice()->createProcess();

        $this->assertEquals(
            "'gs' '-sDEVICE=pdfwrite' '-dPDFSETTINGS=/default' '-c' '.setpdfwrite'",
            $this->quoteCommandLine($process->getCommandLine())
        );
    }
}
