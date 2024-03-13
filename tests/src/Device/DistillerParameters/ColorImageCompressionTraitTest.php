<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Device\DistillerParameters;

use GravityMedia\Ghostscript\Device\DistillerParameters\ColorImageCompressionTrait;
use GravityMedia\Ghostscript\Enum\ColorAndGrayImageFilter;
use GravityMedia\Ghostscript\Enum\ImageDownsampleType;
use GravityMedia\Ghostscript\Enum\PdfSettings;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

/**
 * The color image compression distiller parameters test class.
 *
 * @package GravityMedia\GhostscriptTest\Devices\DistillerParameters
 */
#[CoversClass(\GravityMedia\Ghostscript\Device\DistillerParameters\ColorImageCompressionTrait::class)]
#[UsesClass(\GravityMedia\Ghostscript\Enum\ColorAndGrayImageFilter::class)]
#[UsesClass(\GravityMedia\Ghostscript\Enum\ImageDownsampleType::class)]
class ColorImageCompressionTraitTest extends TestCase
{
    /**
     * @param string $pdfSettings
     *
     * @return ColorImageCompressionTrait
     */
    protected function createTraitForDefaultValue($pdfSettings)
    {
        $trait = $this->getMockForTrait(ColorImageCompressionTrait::class);

        $trait->expects($this->once())
            ->method('getArgumentValue')
            ->willReturn(null);

        $trait->expects($this->once())
            ->method('getPdfSettings')
            ->willReturn($pdfSettings);

        return $trait;
    }

    /**
     * @param null|string $argumentValue
     *
     * @return ColorImageCompressionTrait
     */
    protected function createTraitForArgumentValue($argumentValue)
    {
        $trait = $this->getMockForTrait(ColorImageCompressionTrait::class);

        $trait->expects($this->once())
            ->method('getArgumentValue')
            ->willReturn($argumentValue);

        // expect the method `setArgument` to be called when the argument value is not null
        if (null !== $argumentValue) {
            $trait->expects($this->once())
                ->method('setArgument');
        }

        return $trait;
    }

    public function testAntiAliasColorImagesArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertFalse($trait->isAntiAliasColorImages());

        $trait = $this->createTraitForArgumentValue(true);
        $this->assertTrue($trait->setAntiAliasColorImages(true)->isAntiAliasColorImages());
    }

    public function testAutoFilterColorImagesArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertTrue($trait->isAutoFilterColorImages());

        $trait = $this->createTraitForArgumentValue(false);
        $this->assertFalse($trait->setAutoFilterColorImages(false)->isAutoFilterColorImages());
    }

    public function testColorImageDepthArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertSame(-1, $trait->getColorImageDepth());

        $trait = $this->createTraitForArgumentValue(8);
        $this->assertSame(8, $trait->setColorImageDepth(8)->getColorImageDepth());
    }

    public function testColorImageDownsampleThresholdArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertSame(1.5, $trait->getColorImageDownsampleThreshold());

        $trait = $this->createTraitForArgumentValue(1.0);
        $this->assertSame(1.0, $trait->setColorImageDownsampleThreshold(1.0)->getColorImageDownsampleThreshold());
    }

    /**
     * @dataProvider providePdfSettingsForColorImageDownsampleType
     *
     * @param string $colorImageDownsampleType
     * @param string $pdfSettings
     */
    public function testColorImageDownsampleTypeArgument($colorImageDownsampleType, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($colorImageDownsampleType, $trait->getColorImageDownsampleType());

        $trait = $this->createTraitForArgumentValue('/' . $colorImageDownsampleType);
        $this->assertSame(
            $colorImageDownsampleType,
            $trait->setColorImageDownsampleType($colorImageDownsampleType)->getColorImageDownsampleType()
        );
    }

    /**
     * @return array
     */
    public static function providePdfSettingsForColorImageDownsampleType()
    {
        return [
            [ImageDownsampleType::SUBSAMPLE, PdfSettings::__DEFAULT],
            [ImageDownsampleType::AVERAGE, PdfSettings::SCREEN],
            [ImageDownsampleType::AVERAGE, PdfSettings::EBOOK],
            [ImageDownsampleType::AVERAGE, PdfSettings::PRINTER],
            [ImageDownsampleType::BICUBIC, PdfSettings::PREPRESS]
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testColorImageDownsampleTypeArgumentThrowsException()
    {
        $this->expectExceptionMessage('Invalid color image downsample type argument');

        /** @var ColorImageCompressionTrait $trait */
        $trait = $this->getMockForTrait(ColorImageCompressionTrait::class);

        $trait->setColorImageDownsampleType('/Foo');
    }

    public function testColorImageFilterFallbackArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertSame(ColorAndGrayImageFilter::DCT_ENCODE, $trait->getColorImageFilter());
    }

    /**
     * @dataProvider providePdfSettingsForColorImageFilter
     *
     * @param string $transferFunctionInfo
     */
    public function testColorImageFilterArgument($transferFunctionInfo)
    {
        $trait = $this->createTraitForArgumentValue('/' . $transferFunctionInfo);
        $this->assertSame(
            $transferFunctionInfo,
            $trait->setColorImageFilter($transferFunctionInfo)->getColorImageFilter()
        );
    }

    /**
     * @return array
     */
    public static function providePdfSettingsForColorImageFilter()
    {
        return [
            [ColorAndGrayImageFilter::DCT_ENCODE],
            [ColorAndGrayImageFilter::FLATE_ENCODE]
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testColorImageFilterArgumentThrowsException()
    {
        $this->expectExceptionMessage('Invalid color image filter argument');

        /** @var ColorImageCompressionTrait $trait */
        $trait = $this->getMockForTrait(ColorImageCompressionTrait::class);

        $trait->setColorImageFilter('/Foo');
    }

    /**
     * @dataProvider providePdfSettingsForColorImageResolution
     *
     * @param int    $colorImageResolution
     * @param string $pdfSettings
     */
    public function testColorImageResolutionArgument($colorImageResolution, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($colorImageResolution, $trait->getColorImageResolution());

        $trait = $this->createTraitForArgumentValue($colorImageResolution);
        $this->assertSame(
            $colorImageResolution,
            $trait->setColorImageResolution($colorImageResolution)->getColorImageResolution()
        );
    }

    /**
     * @return array
     */
    public static function providePdfSettingsForColorImageResolution()
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
     * @dataProvider providePdfSettingsForDownsampleColorImages
     *
     * @param bool   $downsampleColorImages
     * @param string $pdfSettings
     */
    public function testDownsampleColorImagesArgument($downsampleColorImages, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($downsampleColorImages, $trait->isDownsampleColorImages());

        $trait = $this->createTraitForArgumentValue($downsampleColorImages);
        $this->assertSame(
            $downsampleColorImages,
            $trait->setDownsampleColorImages($downsampleColorImages)->isDownsampleColorImages()
        );
    }

    /**
     * @return array
     */
    public static function providePdfSettingsForDownsampleColorImages()
    {
        return [
            [false, PdfSettings::__DEFAULT],
            [true, PdfSettings::SCREEN],
            [true, PdfSettings::EBOOK],
            [false, PdfSettings::PRINTER],
            [false, PdfSettings::PREPRESS]
        ];
    }

    public function testEncodeColorImagesArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertTrue($trait->isEncodeColorImages());

        $trait = $this->createTraitForArgumentValue(false);
        $this->assertFalse($trait->setEncodeColorImages(false)->isEncodeColorImages());
    }
}
