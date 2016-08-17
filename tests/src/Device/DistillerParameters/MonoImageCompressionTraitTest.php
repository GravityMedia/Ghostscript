<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Device\DistillerParameters;

use GravityMedia\Ghostscript\Device\DistillerParameters\MonoImageCompressionTrait;
use GravityMedia\Ghostscript\Enum\ImageDownsampleType;
use GravityMedia\Ghostscript\Enum\MonoImageFilter;
use GravityMedia\Ghostscript\Enum\PdfSettings;

/**
 * The monochrome image compression distiller parameters test class.
 *
 * @package GravityMedia\GhostscriptTest\Devices\DistillerParameters
 *
 * @covers  \GravityMedia\Ghostscript\Device\DistillerParameters\MonoImageCompressionTrait
 *
 * @uses    \GravityMedia\Ghostscript\Enum\MonoImageFilter
 * @uses    \GravityMedia\Ghostscript\Enum\ImageDownsampleType
 */
class MonoImageCompressionTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $pdfSettings
     *
     * @return MonoImageCompressionTrait
     */
    protected function createTraitForDefaultValue($pdfSettings)
    {
        $trait = $this->getMockForTrait(MonoImageCompressionTrait::class);

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
     * @return MonoImageCompressionTrait
     */
    protected function createTraitForArgumentValue($argumentValue)
    {
        $trait = $this->getMockForTrait(MonoImageCompressionTrait::class);

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

    public function testAntiAliasMonoImagesArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertFalse($trait->isAntiAliasMonoImages());

        $trait = $this->createTraitForArgumentValue(true);
        $this->assertTrue($trait->setAntiAliasMonoImages(true)->isAntiAliasMonoImages());
    }

    public function testMonoImageDepthArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertSame(-1, $trait->getMonoImageDepth());

        $trait = $this->createTraitForArgumentValue(8);
        $this->assertSame(8, $trait->setMonoImageDepth(8)->getMonoImageDepth());
    }

    public function testMonoImageDownsampleThresholdArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertSame(1.5, $trait->getMonoImageDownsampleThreshold());

        $trait = $this->createTraitForArgumentValue(1.0);
        $this->assertSame(1.0, $trait->setMonoImageDownsampleThreshold(1.0)->getMonoImageDownsampleThreshold());
    }

    /**
     * @dataProvider providePdfSettingsForMonoImageDownsampleType
     *
     * @param string $monoImageDownsampleType
     * @param string $pdfSettings
     */
    public function testMonoImageDownsampleTypeArgument($monoImageDownsampleType, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($monoImageDownsampleType, $trait->getMonoImageDownsampleType());

        $trait = $this->createTraitForArgumentValue('/' . $monoImageDownsampleType);
        $this->assertSame(
            $monoImageDownsampleType,
            $trait->setMonoImageDownsampleType($monoImageDownsampleType)->getMonoImageDownsampleType()
        );
    }

    /**
     * @return array
     */
    public function providePdfSettingsForMonoImageDownsampleType()
    {
        return [
            [ImageDownsampleType::SUBSAMPLE, PdfSettings::__DEFAULT],
            [ImageDownsampleType::SUBSAMPLE, PdfSettings::SCREEN],
            [ImageDownsampleType::SUBSAMPLE, PdfSettings::EBOOK],
            [ImageDownsampleType::SUBSAMPLE, PdfSettings::PRINTER],
            [ImageDownsampleType::BICUBIC, PdfSettings::PREPRESS]
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMonoImageDownsampleTypeArgumentThrowsException()
    {
        /** @var MonoImageCompressionTrait $trait */
        $trait = $this->getMockForTrait(MonoImageCompressionTrait::class);

        $trait->setMonoImageDownsampleType('/Foo');
    }

    public function testMonoImageFilterFallbackArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertSame(MonoImageFilter::CCITT_FAX_ENCODE, $trait->getMonoImageFilter());
    }

    /**
     * @dataProvider providePdfSettingsForMonoImageFilter
     *
     * @param string $transferFunctionInfo
     */
    public function testMonoImageFilterArgument($transferFunctionInfo)
    {
        $trait = $this->createTraitForArgumentValue('/' . $transferFunctionInfo);
        $this->assertSame(
            $transferFunctionInfo,
            $trait->setMonoImageFilter($transferFunctionInfo)->getMonoImageFilter()
        );
    }

    /**
     * @return array
     */
    public function providePdfSettingsForMonoImageFilter()
    {
        return [
            [MonoImageFilter::CCITT_FAX_ENCODE],
            [MonoImageFilter::FLATE_ENCODE],
            [MonoImageFilter::RUN_LENGTH_ENCODE]
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMonoImageFilterArgumentThrowsException()
    {
        /** @var MonoImageCompressionTrait $trait */
        $trait = $this->getMockForTrait(MonoImageCompressionTrait::class);

        $trait->setMonoImageFilter('/Foo');
    }

    /**
     * @dataProvider providePdfSettingsForMonoImageResolution
     *
     * @param int    $monoImageResolution
     * @param string $pdfSettings
     */
    public function testMonoImageResolutionArgument($monoImageResolution, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($monoImageResolution, $trait->getMonoImageResolution());

        $trait = $this->createTraitForArgumentValue($monoImageResolution);
        $this->assertSame(
            $monoImageResolution,
            $trait->setMonoImageResolution($monoImageResolution)->getMonoImageResolution()
        );
    }

    /**
     * @return array
     */
    public function providePdfSettingsForMonoImageResolution()
    {
        return [
            [300, PdfSettings::__DEFAULT],
            [300, PdfSettings::SCREEN],
            [300, PdfSettings::EBOOK],
            [1200, PdfSettings::PRINTER],
            [1200, PdfSettings::PREPRESS]
        ];
    }

    /**
     * @dataProvider providePdfSettingsForDownsampleMonoImages
     *
     * @param bool   $downsampleMonoImages
     * @param string $pdfSettings
     */
    public function testDownsampleMonoImagesArgument($downsampleMonoImages, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($downsampleMonoImages, $trait->isDownsampleMonoImages());

        $trait = $this->createTraitForArgumentValue($downsampleMonoImages);
        $this->assertSame(
            $downsampleMonoImages,
            $trait->setDownsampleMonoImages($downsampleMonoImages)->isDownsampleMonoImages()
        );
    }

    /**
     * @return array
     */
    public function providePdfSettingsForDownsampleMonoImages()
    {
        return [
            [false, PdfSettings::__DEFAULT],
            [true, PdfSettings::SCREEN],
            [true, PdfSettings::EBOOK],
            [false, PdfSettings::PRINTER],
            [false, PdfSettings::PREPRESS]
        ];
    }

    public function testEncodeMonoImagesArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertTrue($trait->isEncodeMonoImages());

        $trait = $this->createTraitForArgumentValue(false);
        $this->assertFalse($trait->setEncodeMonoImages(false)->isEncodeMonoImages());
    }
}
