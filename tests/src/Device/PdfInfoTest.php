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
 * @uses    \GravityMedia\Ghostscript\Device\AbstractDevice
 * @uses    \GravityMedia\Ghostscript\Device\NoDisplay
 * @uses    \GravityMedia\Ghostscript\Process\Argument
 * @uses    \GravityMedia\Ghostscript\Process\Arguments
 */
class PdfInfoTest extends \PHPUnit_Framework_TestCase
{
    private $ghostscript;

    private $arguments;

    private $pdfInfoPath;

    private $inputFile;

    public function setUp()
    {
        $this->pdfInfoPath = __DIR__ . '/../../data/pdf_info.ps';
        $this->inputFile = __DIR__ . '/../../data/input.pdf';
        $this->arguments = new ProcessArguments();
        $this->ghostscript = new Ghostscript();
    }

    public function testDeviceCreation()
    {
        $pdfInfo = new PdfInfo($this->ghostscript, $this->arguments, $this->pdfInfoPath);

        $this->assertInstanceOf('GravityMedia\Ghostscript\Device\PdfInfo', $pdfInfo);
        $this->assertInstanceOf('GravityMedia\Ghostscript\Device\NoDisplay', $pdfInfo);

        $field = new \ReflectionProperty('GravityMedia\Ghostscript\Device\PdfInfo', 'pdfInfoPath');
        $field->setAccessible(true);
        $this->assertEquals($this->pdfInfoPath, $field->getValue($pdfInfo));
    }

    public function testProcessCreation()
    {
        $pdfInfoPath = $this->pdfInfoPath;
        $inputFile = $this->inputFile;

        $pdfInfo = new PdfInfo($this->ghostscript, $this->arguments, $pdfInfoPath);
        $process = $pdfInfo->createProcess($inputFile);

        $expectedCommandLine = "'gs' '-dNODISPLAY' '-sFile=$inputFile' '-c' '' '-f' '$pdfInfoPath'";
        $this->assertEquals($expectedCommandLine, $process->getCommandLine());
    }
}
