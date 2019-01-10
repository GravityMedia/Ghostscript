<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\GhostscriptTest\Device;

use GravityMedia\Ghostscript\Device\PdfInfo;
use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\Process\Arguments;
use PHPUnit\Framework\TestCase;

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
class PdfInfoTest extends TestCase
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

    public function testDeviceCreation()
    {
        $ghostscript = new Ghostscript();
        $arguments = new Arguments();
        $pdfInfoPath = __DIR__ . '/../../data/pdf_info.ps';

        $device = new PdfInfo($ghostscript, $arguments, $pdfInfoPath);

        $this->assertInstanceOf(PdfInfo::class, $device);

        $field = new \ReflectionProperty(PdfInfo::class, 'pdfInfoPath');
        $field->setAccessible(true);
        $this->assertEquals($pdfInfoPath, $field->getValue($device));
    }

    public function testProcessCreation()
    {
        $ghostscript = new Ghostscript();
        $arguments = new Arguments();
        $pdfInfoPath = __DIR__ . '/../../data/pdf_info.ps';
        $inputFile = __DIR__ . '/../../data/input.pdf';

        $device = new PdfInfo($ghostscript, $arguments, $pdfInfoPath);
        $process = $device->createProcess($inputFile);

        $expectedCommandLine = "'gs' '-dNODISPLAY' '-sFile=$inputFile' '-f' '$pdfInfoPath'";
        $this->assertEquals($expectedCommandLine, $this->quoteCommandLine($process->getCommandLine()));
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testProcessCreationThrowsExceptionOnMissingInputFile()
    {
        $ghostscript = new Ghostscript();
        $arguments = new Arguments();
        $pdfInfoPath = __DIR__ . '/../../data/pdf_info.ps';

        $device = new PdfInfo($ghostscript, $arguments, $pdfInfoPath);
        $device->createProcess();
    }
}
