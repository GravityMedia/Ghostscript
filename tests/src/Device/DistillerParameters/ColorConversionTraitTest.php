<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Device\DistillerParameters;

use GravityMedia\Ghostscript\Device\DistillerParameters\ColorConversionTrait;
use GravityMedia\Ghostscript\Enum\ColorConversionStrategy;
use GravityMedia\Ghostscript\Enum\DefaultRenderingIntent;
use GravityMedia\Ghostscript\Enum\PdfSettings;
use GravityMedia\Ghostscript\Enum\TransferFunctionInfo;
use GravityMedia\Ghostscript\Enum\UcrAndBgInfo;

/**
 * The color conversion distiller parameters test class
 *
 * @package GravityMedia\GhostscriptTest\Devices\DistillerParameters
 *
 * @covers  \GravityMedia\Ghostscript\Device\DistillerParameters\ColorConversionTrait
 *
 * @uses    \GravityMedia\Ghostscript\Enum\ColorConversionStrategy
 * @uses    \GravityMedia\Ghostscript\Enum\DefaultRenderingIntent
 * @uses    \GravityMedia\Ghostscript\Enum\TransferFunctionInfo
 * @uses    \GravityMedia\Ghostscript\Enum\UcrAndBgInfo
 */
class ColorConversionTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $pdfSettings
     *
     * @return ColorConversionTrait
     */
    protected function createTraitForDefaultValue($pdfSettings)
    {
        $trait = $this->getMockForTrait('GravityMedia\Ghostscript\Device\DistillerParameters\ColorConversionTrait');

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
     * @return ColorConversionTrait
     */
    protected function createTraitForArgumentValue($argumentValue)
    {
        $trait = $this->getMockForTrait('GravityMedia\Ghostscript\Device\DistillerParameters\ColorConversionTrait');

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

    public function testCalCmykProfileArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertNull($trait->getCalCmykProfile());

        $trait = $this->createTraitForArgumentValue('(/path/to/profile.icc)');
        $this->assertSame('/path/to/profile.icc', $trait->setCalCmykProfile('/path/to/profile.icc')->getCalCmykProfile());
    }

    public function testCalGrayProfileArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertNull($trait->getCalGrayProfile());

        $trait = $this->createTraitForArgumentValue('(/path/to/profile.icc)');
        $this->assertSame('/path/to/profile.icc', $trait->setCalGrayProfile('/path/to/profile.icc')->getCalGrayProfile());
    }

    public function testCalRgbProfileArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertNull($trait->getCalRgbProfile());

        $trait = $this->createTraitForArgumentValue('(/path/to/profile.icc)');
        $this->assertSame('/path/to/profile.icc', $trait->setCalRgbProfile('/path/to/profile.icc')->getCalRgbProfile());
    }

    /**
     * @dataProvider providePdfSettingsForColorConversionStrategy
     *
     * @param string $colorConversionStrategy
     * @param string $pdfSettings
     */
    public function testColorConversionStrategyArgument($colorConversionStrategy, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($colorConversionStrategy, $trait->getColorConversionStrategy());

        $trait = $this->createTraitForArgumentValue('/' . $colorConversionStrategy);
        $this->assertSame($colorConversionStrategy, $trait->setColorConversionStrategy($colorConversionStrategy)->getColorConversionStrategy());
    }

    /**
     * @return array
     */
    public function providePdfSettingsForColorConversionStrategy()
    {
        return [
            [ColorConversionStrategy::LEAVE_COLOR_UNCHANGED, PdfSettings::__DEFAULT],
            [ColorConversionStrategy::SRGB, PdfSettings::SCREEN],
            [ColorConversionStrategy::SRGB, PdfSettings::EBOOK],
            [ColorConversionStrategy::USE_DEVICE_INDEPENDENT_COLOR, PdfSettings::PRINTER],
            [ColorConversionStrategy::LEAVE_COLOR_UNCHANGED, PdfSettings::PREPRESS]
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testColorConversionStrategyArgumentThrowsException()
    {
        /** @var ColorConversionTrait $trait */
        $trait = $this->getMockForTrait('GravityMedia\Ghostscript\Device\DistillerParameters\ColorConversionTrait');

        $trait->setColorConversionStrategy('/Foo');
    }

    public function testConvertCmykImagesToRgbArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertFalse($trait->isConvertCmykImagesToRgb());

        $trait = $this->createTraitForArgumentValue(true);
        $this->assertTrue($trait->setConvertCmykImagesToRgb(true)->isConvertCmykImagesToRgb());
    }

    public function testConvertImagesToIndexedArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertFalse($trait->isConvertImagesToIndexed());

        $trait = $this->createTraitForArgumentValue(true);
        $this->assertTrue($trait->setConvertImagesToIndexed(true)->isConvertImagesToIndexed());
    }

    public function testDefaultRenderingIntentFallbackArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertSame(DefaultRenderingIntent::__DEFAULT, $trait->getDefaultRenderingIntent());
    }

    /**
     * @dataProvider providePdfSettingsForDefaultRenderingIntent
     *
     * @param string $defaultRenderingIntent
     */
    public function testDefaultRenderingIntentArgument($defaultRenderingIntent)
    {
        $trait = $this->createTraitForArgumentValue('/' . $defaultRenderingIntent);
        $this->assertSame($defaultRenderingIntent, $trait->setDefaultRenderingIntent($defaultRenderingIntent)->getDefaultRenderingIntent());
    }

    /**
     * @return array
     */
    public function providePdfSettingsForDefaultRenderingIntent()
    {
        return [
            [DefaultRenderingIntent::__DEFAULT],
            [DefaultRenderingIntent::PERCEPTUAL],
            [DefaultRenderingIntent::SATURATION],
            [DefaultRenderingIntent::RELATIVE_COLORIMETRIC],
            [DefaultRenderingIntent::ABSOLUTE_COLORIMETRIC]
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testDefaultRenderingIntentArgumentThrowsException()
    {
        /** @var ColorConversionTrait $trait */
        $trait = $this->getMockForTrait('GravityMedia\Ghostscript\Device\DistillerParameters\ColorConversionTrait');

        $trait->setDefaultRenderingIntent('/Foo');
    }

    public function testPreserveHalftoneInfoArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertFalse($trait->isPreserveHalftoneInfo());

        $trait = $this->createTraitForArgumentValue(true);
        $this->assertTrue($trait->setPreserveHalftoneInfo(true)->isPreserveHalftoneInfo());
    }

    /**
     * @dataProvider providePdfSettingsForPreserveOverprintSettings
     *
     * @param bool   $preserveOverprintSettings
     * @param string $pdfSettings
     */
    public function testPreserveOverprintSettingsArgument($preserveOverprintSettings, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($preserveOverprintSettings, $trait->isPreserveOverprintSettings());

        $trait = $this->createTraitForArgumentValue($preserveOverprintSettings);
        $this->assertSame($preserveOverprintSettings, $trait->setPreserveOverprintSettings($preserveOverprintSettings)->isPreserveOverprintSettings());
    }

    /**
     * @return array
     */
    public function providePdfSettingsForPreserveOverprintSettings()
    {
        return [
            [false, PdfSettings::__DEFAULT],
            [false, PdfSettings::SCREEN],
            [false, PdfSettings::EBOOK],
            [true, PdfSettings::PRINTER],
            [true, PdfSettings::PREPRESS]
        ];
    }

    public function testSRgbProfileArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertNull($trait->getSRgbProfile());

        $trait = $this->createTraitForArgumentValue('(/path/to/profile.icc)');
        $this->assertSame('/path/to/profile.icc', $trait->setSRgbProfile('/path/to/profile.icc')->getSRgbProfile());
    }

    public function testTransferFunctionInfoFallbackArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertSame(TransferFunctionInfo::PRESERVE, $trait->getTransferFunctionInfo());
    }

    /**
     * @dataProvider providePdfSettingsForTransferFunctionInfo
     *
     * @param string $transferFunctionInfo
     */
    public function testTransferFunctionInfoArgument($transferFunctionInfo)
    {
        $trait = $this->createTraitForArgumentValue('/' . $transferFunctionInfo);
        $this->assertSame($transferFunctionInfo, $trait->setTransferFunctionInfo($transferFunctionInfo)->getTransferFunctionInfo());
    }

    /**
     * @return array
     */
    public function providePdfSettingsForTransferFunctionInfo()
    {
        return [
            [TransferFunctionInfo::PRESERVE],
            [TransferFunctionInfo::APPLY],
            [TransferFunctionInfo::REMOVE]
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testTransferFunctionInfoArgumentThrowsException()
    {
        /** @var ColorConversionTrait $trait */
        $trait = $this->getMockForTrait('GravityMedia\Ghostscript\Device\DistillerParameters\ColorConversionTrait');

        $trait->setTransferFunctionInfo('/Foo');
    }

    /**
     * @dataProvider providePdfSettingsForUcrAndBgInfo
     *
     * @param string $ucrAndBgInfo
     * @param string $pdfSettings
     */
    public function testUcrAndBgInfoArgument($ucrAndBgInfo, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($ucrAndBgInfo, $trait->getUcrAndBgInfo());

        $trait = $this->createTraitForArgumentValue('/' . $ucrAndBgInfo);
        $this->assertSame($ucrAndBgInfo, $trait->setUcrAndBgInfo($ucrAndBgInfo)->getUcrAndBgInfo());
    }

    /**
     * @return array
     */
    public function providePdfSettingsForUcrAndBgInfo()
    {
        return [
            [UcrAndBgInfo::REMOVE, PdfSettings::__DEFAULT],
            [UcrAndBgInfo::REMOVE, PdfSettings::SCREEN],
            [UcrAndBgInfo::REMOVE, PdfSettings::EBOOK],
            [UcrAndBgInfo::PRESERVE, PdfSettings::PRINTER],
            [UcrAndBgInfo::PRESERVE, PdfSettings::PREPRESS]
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUcrAndBgInfoArgumentThrowsException()
    {
        /** @var ColorConversionTrait $trait */
        $trait = $this->getMockForTrait('GravityMedia\Ghostscript\Device\DistillerParameters\ColorConversionTrait');

        $trait->setUcrAndBgInfo('/Foo');
    }
}
