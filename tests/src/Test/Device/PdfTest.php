<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Test\Device;

use GravityMedia\Ghostscript\Device\Pdf;
use GravityMedia\Ghostscript\Test\GhostscriptTestCase;

/**
 * PDF device test object
 *
 * @package GravityMedia\Ghostscript\Test\Device
 */
class PdfTest extends GhostscriptTestCase
{
    /**
     * @covers \GravityMedia\Ghostscript\Device\Pdf::__construct
     */
    public function testShouldBePdfWriteDevice()
    {
        $pdf = new Pdf();

        $this->assertContains('-sDEVICE=\'pdfwrite\'', $pdf->getDeviceOptionsAsArguments());
    }

    /**
     * @covers \GravityMedia\Ghostscript\Device\Pdf::getDeviceName
     */
    public function testShouldIndicateCorrectDeviceName()
    {
        $pdf = new Pdf();

        $this->assertEquals('pdfwrite', $pdf->getDeviceName());
    }

    /**
     * @covers \GravityMedia\Ghostscript\Device\Pdf::getOption
     */
    public function testShouldHaveDefaultConfiguration()
    {
        $pdf = new Pdf(array(
            'configuration' => Pdf::CONFIGURATION_DEFAULT
        ));

        $this->assertContains('-dPDFSETTINGS=\'/default\'', $pdf->getDeviceOptionsAsArguments());
    }

    /**
     * @covers \GravityMedia\Ghostscript\Device\Pdf::getOption
     */
    public function testShouldHaveProcessColorModelCMYK()
    {
        $pdf = new Pdf(array(
            'process-color-model' => Pdf::DEVICE_CMYK
        ));

        $this->assertContains('-dProcessColorModel=\'/DeviceCMYK\'', $pdf->getDeviceOptionsAsArguments());
    }

    /**
     * @covers \GravityMedia\Ghostscript\Device\Pdf::setCompatibilityLevel
     */
    public function testShouldHaveCompatibilityLevel()
    {
        $pdf = new Pdf();
        $pdf->setCompatibilityLevel('1.4');

        $this->assertContains('-dCompatibilityLevel=\'1.4\'', $pdf->getDeviceOptionsAsArguments());
    }
}
