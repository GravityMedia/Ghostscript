<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\GhostscriptTest\Device;

use GravityMedia\Ghostscript\Device\PdfInfo;
use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\Process\Arguments as ProcessArguments;

/**
 * The pdf info device test class
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
class PdfInfoTest extends \PHPUnit_Framework_TestCase
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
        $arguments = new ProcessArguments();
        $pdfInfoPath = __DIR__ . '/../../data/pdf_info.ps';

        $pdfInfo = new PdfInfo($ghostscript, $arguments, $pdfInfoPath);

        $this->assertInstanceOf('GravityMedia\Ghostscript\Device\PdfInfo', $pdfInfo);
        $this->assertInstanceOf('GravityMedia\Ghostscript\Device\NoDisplay', $pdfInfo);

        $field = new \ReflectionProperty('GravityMedia\Ghostscript\Device\PdfInfo', 'pdfInfoPath');
        $field->setAccessible(true);
        $this->assertEquals($pdfInfoPath, $field->getValue($pdfInfo));
    }

    public function testProcessCreation()
    {
        $ghostscript = new Ghostscript();
        $arguments = new ProcessArguments();
        $pdfInfoPath = __DIR__ . '/../../data/pdf_info.ps';
        $inputFile = __DIR__ . '/../../data/input.pdf';

        $pdfInfo = new PdfInfo($ghostscript, $arguments, $pdfInfoPath);
        $process = $pdfInfo->createProcess($inputFile);

        $expectedCommandLine = "'gs' '-dNODISPLAY' '-sFile=$inputFile' '-f' '$pdfInfoPath'";
        $this->assertEquals($expectedCommandLine, $this->quoteCommandLine($process->getCommandLine()));
    }
}
