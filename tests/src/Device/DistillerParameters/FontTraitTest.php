<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Device\DistillerParameters;

use GravityMedia\Ghostscript\Device\DistillerParameters\FontTrait;
use GravityMedia\Ghostscript\Enum\CannotEmbedFontPolicy;
use GravityMedia\Ghostscript\Enum\PdfSettings;
use PHPUnit\Framework\TestCase;

/**
 * The font distiller parameters test class.
 *
 * @package GravityMedia\GhostscriptTest\Devices\DistillerParameters
 *
 * @covers  \GravityMedia\Ghostscript\Device\DistillerParameters\FontTrait
 *
 * @uses    \GravityMedia\Ghostscript\Enum\CannotEmbedFontPolicy
 */
class FontTraitTest extends TestCase
{
    /**
     * @param string $pdfSettings
     *
     * @return FontTrait
     */
    protected function createTraitForDefaultValue($pdfSettings)
    {
        $trait = $this->getMockForTrait(FontTrait::class);

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
     * @return FontTrait
     */
    protected function createTraitForArgumentValue($argumentValue)
    {
        $trait = $this->getMockForTrait(FontTrait::class);

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

    /**
     * @dataProvider providePdfSettingsForCannotEmbedFontPolicy
     *
     * @param string $cannotEmbedFontPolicy
     * @param string $pdfSettings
     */
    public function testCannotEmbedFontPolicyArgument($cannotEmbedFontPolicy, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($cannotEmbedFontPolicy, $trait->getCannotEmbedFontPolicy());

        $trait = $this->createTraitForArgumentValue('/' . $cannotEmbedFontPolicy);
        $this->assertSame(
            $cannotEmbedFontPolicy,
            $trait->setCannotEmbedFontPolicy($cannotEmbedFontPolicy)->getCannotEmbedFontPolicy()
        );
    }

    /**
     * @return array
     */
    public function providePdfSettingsForCannotEmbedFontPolicy()
    {
        return [
            [CannotEmbedFontPolicy::WARNING, PdfSettings::__DEFAULT],
            [CannotEmbedFontPolicy::WARNING, PdfSettings::SCREEN],
            [CannotEmbedFontPolicy::WARNING, PdfSettings::EBOOK],
            [CannotEmbedFontPolicy::WARNING, PdfSettings::PRINTER],
            [CannotEmbedFontPolicy::ERROR, PdfSettings::PREPRESS]
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCannotEmbedFontPolicyArgumentThrowsException()
    {
        $this->expectExceptionMessage('Invalid cannot embed font policy argument');

        /** @var FontTrait $trait */
        $trait = $this->getMockForTrait(FontTrait::class);

        $trait->setCannotEmbedFontPolicy('/Foo');
    }

    /**
     * @dataProvider providePdfSettingsForEmbedAllFonts
     *
     * @param bool   $embedAllFonts
     * @param string $pdfSettings
     */
    public function testEmbedAllFontsArgument($embedAllFonts, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($embedAllFonts, $trait->isEmbedAllFonts());

        $trait = $this->createTraitForArgumentValue($embedAllFonts);
        $this->assertSame($embedAllFonts, $trait->setEmbedAllFonts($embedAllFonts)->isEmbedAllFonts());
    }

    /**
     * @return array
     */
    public function providePdfSettingsForEmbedAllFonts()
    {
        return [
            [true, PdfSettings::__DEFAULT],
            [false, PdfSettings::SCREEN],
            [true, PdfSettings::EBOOK],
            [true, PdfSettings::PRINTER],
            [true, PdfSettings::PREPRESS]
        ];
    }

    public function testMaxSubsetPctArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertSame(100, $trait->getMaxSubsetPct());

        $trait = $this->createTraitForArgumentValue(66);
        $this->assertSame(66, $trait->setMaxSubsetPct(66)->getMaxSubsetPct());
    }

    public function testSubsetFontsArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertTrue($trait->isSubsetFonts());

        $trait = $this->createTraitForArgumentValue(false);
        $this->assertFalse($trait->setSubsetFonts(false)->isSubsetFonts());
    }
}
