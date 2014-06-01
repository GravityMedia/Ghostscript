<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\Test\Device;

use Ghostscript\Device\Pdf;

/**
 * PDF device test object
 *
 * @package Ghostscript\Test\Device
 */
class PdfTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Ghostscript\Devices\Pdf::__construct
     */
    public function testShouldBePdfWriteDevice()
    {
        $pdf = new Pdf();

        $this->assertEquals('-sDEVICE=\'pdfwrite\'', strval($pdf->getDeviceFlags()));
    }

    /**
     * @covers \Ghostscript\Devices\Pdf::getDeviceName
     */
    public function testShouldIndicateCorrectDeviceName()
    {
        $pdf = new Pdf();

        $this->assertEquals('pdfwrite', $pdf->getDeviceName());
    }

    /**
     * @covers \Ghostscript\Devices\Pdf::getDeviceFlags
     */
    public function testShouldHaveDefaultConfiguration()
    {
        $pdf = new Pdf(array(
            'configuration' => Pdf::CONFIGURATION_DEFAULT
        ));

        $this->assertEquals('-sDEVICE=\'pdfwrite\' -dPDFSETTINGS=\'/default\'', strval($pdf->getDeviceFlags()));
    }

    /**
     * @covers \Ghostscript\Devices\Pdf::getDeviceFlags
     */
    public function testShouldHaveProcessColorModelCMYK()
    {
        $pdf = new Pdf(array(
            'process-color-model' => Pdf::DEVICE_CMYK
        ));

        $this->assertEquals('-sDEVICE=\'pdfwrite\' -dProcessColorModel=\'/DeviceCMYK\'', strval($pdf->getDeviceFlags()));
    }

    /**
     * @covers \Ghostscript\Devices\Pdf::setCompatibilityLevel
     */
    public function testShouldHaveCompatibilityLevel()
    {
        $pdf = new Pdf();
        $pdf->setCompatibilityLevel('1.4');

        $this->assertEquals('-sDEVICE=\'pdfwrite\' -dCompatibilityLevel=\'1.4\'', strval($pdf->getDeviceFlags()));
    }
}
