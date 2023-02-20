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
class PdfWriteTest extends DeviceTestCase
{
    protected function createDevice(?string $version = null): PdfWrite
    {
        return new PdfWrite($this->getGhostscript($version), $this->arguments);
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
     * @return array<string[]>
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
        $this->expectExceptionMessage('Invalid PDF settings argument');

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
     * @return array<string[]>
     */
    public static function provideProcessColorModel(): array
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
        $this->expectExceptionMessage('Invalid process color model argument');
        $this->createDevice()->setProcessColorModel('/foo');
    }

    protected static function dataProcessCreation(): array
    {
        return [
            [fn (self $self) => $self->assertProcessCreation(
                version: '9.00',
                expectSetPDFWrite: true,
            )],
            [fn (self $self) => $self->assertProcessCreation(
                version: '9.10',
                expectSetPDFWrite: true,
            )],
            [fn (self $self) => $self->assertProcessCreation(
                version: '9.50',
                expectSetPDFWrite: false,
            )],
            [fn (self $self) => $self->assertProcessCreation(
                version: '10.00.0',
                expectSetPDFWrite: false,
            )]
        ];
    }

    /**
     * @dataProvider dataProcessCreation
     */
    public function testProcessCreation(callable $closure): void
    {
        $closure($this);
    }

    protected function assertProcessCreation(
        string $version,
        bool $expectSetPDFWrite,
    ): void
    {
        $process = $this->createDevice($version)->createProcess();

        $command = "'gs' '-sDEVICE=pdfwrite' '-dPDFSETTINGS=/default'";
        $this->assertEquals(
            $expectSetPDFWrite ? "{$command} '-c' '.setpdfwrite'" : $command,
            $this->quoteCommandLine($process->getCommandLine())
        );
    }
}
