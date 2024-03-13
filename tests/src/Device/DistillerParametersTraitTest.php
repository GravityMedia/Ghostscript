<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Device;

use GravityMedia\Ghostscript\Device\DistillerParametersTrait;
use GravityMedia\Ghostscript\Enum\AutoRotatePages;
use GravityMedia\Ghostscript\Enum\Binding;
use GravityMedia\Ghostscript\Enum\PdfSettings;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

/**
 * The general distiller parameters test class.
 *
 * @package GravityMedia\GhostscriptTest\Devices
 */
#[CoversClass(\GravityMedia\Ghostscript\Device\DistillerParametersTrait::class)]
#[UsesClass(\GravityMedia\Ghostscript\Enum\AutoRotatePages::class)]
#[UsesClass(\GravityMedia\Ghostscript\Enum\Binding::class)]
class DistillerParametersTraitTest extends TestCase
{
    /**
     * @param string $pdfSettings
     *
     * @return DistillerParametersTrait
     */
    protected function createTraitForDefaultValue($pdfSettings)
    {
        $trait = $this->getMockForTrait('GravityMedia\Ghostscript\Device\DistillerParametersTrait');

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
     * @return DistillerParametersTrait
     */
    protected function createTraitForArgumentValue($argumentValue)
    {
        $trait = $this->getMockForTrait('GravityMedia\Ghostscript\Device\DistillerParametersTrait');

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

    /**
     * @dataProvider providePdfSettingsForAutoRotatePages
     *
     * @param string $autoRotatePages
     * @param string $pdfSettings
     */
    public function testAutoRotatePagesArgument($autoRotatePages, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($autoRotatePages, $trait->getAutoRotatePages());

        $trait = $this->createTraitForArgumentValue('/' . $autoRotatePages);
        $this->assertSame($autoRotatePages, $trait->setAutoRotatePages($autoRotatePages)->getAutoRotatePages());
    }

    /**
     * @return array
     */
    public static function providePdfSettingsForAutoRotatePages()
    {
        return [
            [AutoRotatePages::PAGE_BY_PAGE, PdfSettings::__DEFAULT],
            [AutoRotatePages::PAGE_BY_PAGE, PdfSettings::SCREEN],
            [AutoRotatePages::ALL, PdfSettings::EBOOK],
            [AutoRotatePages::NONE, PdfSettings::PRINTER],
            [AutoRotatePages::NONE, PdfSettings::PREPRESS]
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAutoRotatePagesArgumentThrowsException()
    {
        $this->expectExceptionMessage('Invalid auto rotate pages argument');

        /** @var DistillerParametersTrait $trait */
        $trait = $this->getMockForTrait('GravityMedia\Ghostscript\Device\DistillerParametersTrait');

        $trait->setAutoRotatePages('/Foo');
    }

    public function testBindingArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertSame(Binding::LEFT, $trait->getBinding());

        $trait = $this->createTraitForArgumentValue('/' . Binding::RIGHT);
        $this->assertSame(Binding::RIGHT, $trait->setBinding(Binding::RIGHT)->getBinding());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBindingArgumentThrowsException()
    {
        $this->expectExceptionMessage('Invalid binding argument');

        /** @var DistillerParametersTrait $trait */
        $trait = $this->getMockForTrait('GravityMedia\Ghostscript\Device\DistillerParametersTrait');

        $trait->setBinding('/Foo');
    }

    /**
     * @dataProvider providePdfSettingsForCompatibilityLevel
     *
     * @param float  $compatibilityLevel
     * @param string $pdfSettings
     */
    public function testCompatibilityLevelArgument($compatibilityLevel, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($compatibilityLevel, $trait->getCompatibilityLevel());

        $trait = $this->createTraitForArgumentValue($compatibilityLevel);
        $this->assertSame($compatibilityLevel, $trait->setCompatibilityLevel($compatibilityLevel)->getCompatibilityLevel());
    }

    /**
     * @return array
     */
    public static function providePdfSettingsForCompatibilityLevel()
    {
        return [
            [1.4, PdfSettings::__DEFAULT],
            [1.3, PdfSettings::SCREEN],
            [1.4, PdfSettings::EBOOK],
            [1.4, PdfSettings::PRINTER],
            [1.4, PdfSettings::PREPRESS]
        ];
    }

    public function testCoreDistVersionArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertSame(4000, $trait->getCoreDistVersion());

        $trait = $this->createTraitForArgumentValue(2000);
        $this->assertSame(2000, $trait->setCoreDistVersion(2000)->getCoreDistVersion());
    }

    /**
     * @dataProvider providePdfSettingsForDoThumbnails
     *
     * @param bool   $doThumbnails
     * @param string $pdfSettings
     */
    public function testDoThumbnailsArgument($doThumbnails, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($doThumbnails, $trait->isDoThumbnails());

        $trait = $this->createTraitForArgumentValue($doThumbnails);
        $this->assertSame($doThumbnails, $trait->setDoThumbnails($doThumbnails)->isDoThumbnails());
    }

    /**
     * @return array
     */
    public static function providePdfSettingsForDoThumbnails()
    {
        return [
            [false, PdfSettings::__DEFAULT],
            [false, PdfSettings::SCREEN],
            [false, PdfSettings::EBOOK],
            [false, PdfSettings::PRINTER],
            [true, PdfSettings::PREPRESS]
        ];
    }

    public function testEndPageArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertSame(-1, $trait->getEndPage());

        $trait = $this->createTraitForArgumentValue(5);
        $this->assertSame(5, $trait->setEndPage(5)->getEndPage());
    }

    public function testImageMemoryArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertSame(524288, $trait->getImageMemory());

        $trait = $this->createTraitForArgumentValue(100000);
        $this->assertSame(100000, $trait->setImageMemory(10000)->getImageMemory());
    }

    public function testOffOptimizationsArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertSame(0, $trait->getOffOptimizations());

        $trait = $this->createTraitForArgumentValue(1);
        $this->assertSame(1, $trait->setOffOptimizations(1)->getOffOptimizations());
    }

    /**
     * @dataProvider providePdfSettingsForOptimize
     *
     * @param bool   $optimize
     * @param string $pdfSettings
     */
    public function testOptimizeArgument($optimize, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($optimize, $trait->isOptimize());

        $trait = $this->createTraitForArgumentValue($optimize);
        $this->assertSame($optimize, $trait->setOptimize($optimize)->isOptimize());
    }

    /**
     * @return array
     */
    public static function providePdfSettingsForOptimize()
    {
        return [
            [false, PdfSettings::__DEFAULT],
            [true, PdfSettings::SCREEN],
            [true, PdfSettings::EBOOK],
            [true, PdfSettings::PRINTER],
            [true, PdfSettings::PREPRESS]
        ];
    }

    public function testStartPageArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertSame(1, $trait->getStartPage());

        $trait = $this->createTraitForArgumentValue(3);
        $this->assertSame(3, $trait->setStartPage(3)->getStartPage());
    }

    public function testUseFlateCompressionArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertTrue($trait->isUseFlateCompression());

        $trait = $this->createTraitForArgumentValue(false);
        $this->assertFalse($trait->setUseFlateCompression(false)->isUseFlateCompression());
    }
}
