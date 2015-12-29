<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Device\DistillerParameters;

use GravityMedia\Ghostscript\Device\DistillerParameters\GrayImageCompressionTrait;
use GravityMedia\Ghostscript\Enum\ColorAndGrayImageFilter;
use GravityMedia\Ghostscript\Enum\ImageDownsampleType;
use GravityMedia\Ghostscript\Enum\PdfSettings;

/**
 * The grayscale image compression distiller parameters test class
 *
 * @package GravityMedia\GhostscriptTest\Devices\DistillerParameters
 *
 * @covers  \GravityMedia\Ghostscript\Device\DistillerParameters\GrayImageCompressionTrait
 *
 * @uses    \GravityMedia\Ghostscript\Enum\ColorAndGrayImageFilter
 * @uses    \GravityMedia\Ghostscript\Enum\ImageDownsampleType
 */
class GrayImageCompressionTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $pdfSettings
     *
     * @return GrayImageCompressionTrait
     */
    protected function createTraitForDefaultValue($pdfSettings)
    {
        $trait = $this->getMockForTrait('GravityMedia\Ghostscript\Device\DistillerParameters\GrayImageCompressionTrait');

        $trait->expects($this->once())
            ->method('getArgumentValue')
            ->will($this->returnValue(null));

        $trait->expects($this->once())
            ->method('getPdfSettings')
            ->will($this->returnValue($pdfSettings));

        return $trait;
    }

    /**
     * @param null|string $argumentValue
     *
     * @return GrayImageCompressionTrait
     */
    protected function createTraitForArgumentValue($argumentValue)
    {
        $trait = $this->getMockForTrait('GravityMedia\Ghostscript\Device\DistillerParameters\GrayImageCompressionTrait');

        $trait->expects($this->once())
            ->method('getArgumentValue')
            ->will($this->returnValue($argumentValue));

        // expect the method `setArgument` to be called when the argument value is not null
        if (null !== $argumentValue) {
            $trait->expects($this->once())
                ->method('setArgument');
        }

        return $trait;
    }

    public function testAntiAliasGrayImagesArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertFalse($trait->isAntiAliasGrayImages());

        $trait = $this->createTraitForArgumentValue(true);
        $this->assertTrue($trait->setAntiAliasGrayImages(true)->isAntiAliasGrayImages());
    }

    public function testAutoFilterGrayImagesArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertTrue($trait->isAutoFilterGrayImages());

        $trait = $this->createTraitForArgumentValue(false);
        $this->assertFalse($trait->setAutoFilterGrayImages(false)->isAutoFilterGrayImages());
    }

    public function testGrayImageDepthArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertSame(-1, $trait->getGrayImageDepth());

        $trait = $this->createTraitForArgumentValue(8);
        $this->assertSame(8, $trait->setGrayImageDepth(8)->getGrayImageDepth());
    }

    public function testGrayImageDownsampleThresholdArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertSame(1.5, $trait->getGrayImageDownsampleThreshold());

        $trait = $this->createTraitForArgumentValue(1.0);
        $this->assertSame(1.0, $trait->setGrayImageDownsampleThreshold(1.0)->getGrayImageDownsampleThreshold());
    }

    /**
     * @dataProvider providePdfSettingsForGrayImageDownsampleType
     *
     * @param string $grayImageDownsampleType
     * @param string $pdfSettings
     */
    public function testGrayImageDownsampleTypeArgument($grayImageDownsampleType, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($grayImageDownsampleType, $trait->getGrayImageDownsampleType());

        $trait = $this->createTraitForArgumentValue('/' . $grayImageDownsampleType);
        $this->assertSame($grayImageDownsampleType, $trait->setGrayImageDownsampleType($grayImageDownsampleType)->getGrayImageDownsampleType());
    }

    /**
     * @return array
     */
    public function providePdfSettingsForGrayImageDownsampleType()
    {
        return [
            [ImageDownsampleType::SUBSAMPLE, PdfSettings::__DEFAULT],
            [ImageDownsampleType::AVERAGE, PdfSettings::SCREEN],
            [ImageDownsampleType::BICUBIC, PdfSettings::EBOOK],
            [ImageDownsampleType::BICUBIC, PdfSettings::PRINTER],
            [ImageDownsampleType::BICUBIC, PdfSettings::PREPRESS]
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGrayImageDownsampleTypeArgumentThrowsException()
    {
        /** @var GrayImageCompressionTrait $trait */
        $trait = $this->getMockForTrait('GravityMedia\Ghostscript\Device\DistillerParameters\GrayImageCompressionTrait');

        $trait->setGrayImageDownsampleType('/Foo');
    }

    public function testGrayImageFilterFallbackArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertSame(ColorAndGrayImageFilter::DCT_ENCODE, $trait->getGrayImageFilter());
    }

    /**
     * @dataProvider providePdfSettingsForGrayImageFilter
     *
     * @param string $transferFunctionInfo
     */
    public function testGrayImageFilterArgument($transferFunctionInfo)
    {
        $trait = $this->createTraitForArgumentValue('/' . $transferFunctionInfo);
        $this->assertSame($transferFunctionInfo, $trait->setGrayImageFilter($transferFunctionInfo)->getGrayImageFilter());
    }

    /**
     * @return array
     */
    public function providePdfSettingsForGrayImageFilter()
    {
        return [
            [ColorAndGrayImageFilter::DCT_ENCODE],
            [ColorAndGrayImageFilter::FLATE_ENCODE]
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGrayImageFilterArgumentThrowsException()
    {
        /** @var GrayImageCompressionTrait $trait */
        $trait = $this->getMockForTrait('GravityMedia\Ghostscript\Device\DistillerParameters\GrayImageCompressionTrait');

        $trait->setGrayImageFilter('/Foo');
    }

    /**
     * @dataProvider providePdfSettingsForGrayImageResolution
     *
     * @param int    $grayImageResolution
     * @param string $pdfSettings
     */
    public function testGrayImageResolutionArgument($grayImageResolution, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($grayImageResolution, $trait->getGrayImageResolution());

        $trait = $this->createTraitForArgumentValue($grayImageResolution);
        $this->assertSame($grayImageResolution, $trait->setGrayImageResolution($grayImageResolution)->getGrayImageResolution());
    }

    /**
     * @return array
     */
    public function providePdfSettingsForGrayImageResolution()
    {
        return [
            [72, PdfSettings::__DEFAULT],
            [72, PdfSettings::SCREEN],
            [150, PdfSettings::EBOOK],
            [300, PdfSettings::PRINTER],
            [300, PdfSettings::PREPRESS]
        ];
    }

    /**
     * @dataProvider providePdfSettingsForDownsampleGrayImages
     *
     * @param bool   $downsampleGrayImages
     * @param string $pdfSettings
     */
    public function testDownsampleGrayImagesArgument($downsampleGrayImages, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($downsampleGrayImages, $trait->isDownsampleGrayImages());

        $trait = $this->createTraitForArgumentValue($downsampleGrayImages);
        $this->assertSame($downsampleGrayImages, $trait->setDownsampleGrayImages($downsampleGrayImages)->isDownsampleGrayImages());
    }

    /**
     * @return array
     */
    public function providePdfSettingsForDownsampleGrayImages()
    {
        return [
            [false, PdfSettings::__DEFAULT],
            [true, PdfSettings::SCREEN],
            [true, PdfSettings::EBOOK],
            [false, PdfSettings::PRINTER],
            [false, PdfSettings::PREPRESS]
        ];
    }

    public function testEncodeGrayImagesArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertTrue($trait->isEncodeGrayImages());

        $trait = $this->createTraitForArgumentValue(false);
        $this->assertFalse($trait->setEncodeGrayImages(false)->isEncodeGrayImages());
    }
}
