<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\GhostscriptTest\Device;

use GravityMedia\Ghostscript\Device\AbstractDevice;
use GravityMedia\Ghostscript\Device\PdfInfo;
use GravityMedia\Ghostscript\Process\Arguments;
use Symfony\Component\Process\Process;

/**
 * The pdf info device test class.
 *
 * @package GravityMedia\GhostscriptTest\Devices
 *
 * @covers  \GravityMedia\Ghostscript\Device\PdfInfo
 *
 * @uses    \GravityMedia\Ghostscript\Ghostscript
 * @uses    \GravityMedia\Ghostscript\Input
 * @uses    \GravityMedia\Ghostscript\Device\AbstractDevice
 * @uses    \GravityMedia\Ghostscript\Device\NoDisplay
 * @uses    \GravityMedia\Ghostscript\Process\Argument
 * @uses    \GravityMedia\Ghostscript\Process\Arguments
 */
class PdfInfoTest extends DeviceTestCase
{
    const PDF_PATH = __DIR__ . '/../../data/pdf_info.ps';

    protected function createDevice(?string $version = null): PdfInfo
    {
        $ghostscript = $this->getGhostscript($version);
        $arguments = new Arguments();

        return new PdfInfo($ghostscript, $arguments, self::PDF_PATH);
    }

    public function testDeviceCreation()
    {
        $device = $this->createDevice();
        $field = new \ReflectionProperty(PdfInfo::class, 'pdfInfoPath');
        $field->setAccessible(true);
        $this->assertEquals(self::PDF_PATH, $field->getValue($device));
    }

    public function testProcessCreation()
    {
        $inputFile = __DIR__ . '/../../data/input.pdf';
        $pdfInfoPath = self::PDF_PATH;
        $device = $this->createDevice();
        $process = $device->createProcess($inputFile);

        $expectedCommandLine = "'gs' '-dNODISPLAY' '-sFile=$inputFile' '-f' '$pdfInfoPath'";
        $this->assertEquals($expectedCommandLine, $this->quoteCommandLine($process->getCommandLine()));
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testProcessCreationThrowsExceptionOnMissingInputFile()
    {
        $this->expectExceptionMessage('Input file does not exist');

        $device = $this->createDevice();
        $device->createProcess();
    }

    protected function createProcessForVersionTest(AbstractDevice $device): Process
    {
        $inputFile = __DIR__ . '/../../data/input.pdf';

        return $device->createProcess($inputFile);
    }
}
