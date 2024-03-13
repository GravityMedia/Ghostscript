<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Device\DistillerParameters;

use GravityMedia\Ghostscript\Device\DistillerParameters\AdvancedTrait;
use GravityMedia\Ghostscript\Enum\PdfSettings;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * The advanced distiller parameters test class.
 *
 * @package GravityMedia\GhostscriptTest\Devices\DistillerParameters
 */
#[CoversClass(\GravityMedia\Ghostscript\Device\DistillerParameters\AdvancedTrait::class)]
class AdvancedTraitTest extends TestCase
{
    /**
     * @param string $pdfSettings
     *
     * @return AdvancedTrait
     */
    protected function createTraitForDefaultValue($pdfSettings)
    {
        $trait = $this->getMockForTrait(AdvancedTrait::class);

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
     * @return AdvancedTrait
     */
    protected function createTraitForArgumentValue($argumentValue)
    {
        $trait = $this->getMockForTrait(AdvancedTrait::class);

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

    public function testAscii85EncodePagesArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertFalse($trait->isAscii85EncodePages());

        $trait = $this->createTraitForArgumentValue(true);
        $this->assertTrue($trait->setAscii85EncodePages(true)->isAscii85EncodePages());
    }

    public function testAutoPositionEpsFilesArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertFalse($trait->isAutoPositionEpsFiles());

        $trait = $this->createTraitForArgumentValue(true);
        $this->assertTrue($trait->setAutoPositionEpsFiles(true)->isAutoPositionEpsFiles());
    }

    /**
     * @dataProvider providePdfSettingsForCreateJobTicket
     *
     * @param bool   $createJobTicket
     * @param string $pdfSettings
     */
    public function testCreateJobTicketArgument($createJobTicket, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($createJobTicket, $trait->isCreateJobTicket());

        $trait = $this->createTraitForArgumentValue($createJobTicket);
        $this->assertSame($createJobTicket, $trait->setCreateJobTicket($createJobTicket)->isCreateJobTicket());
    }

    /**
     * @return array
     */
    public static function providePdfSettingsForCreateJobTicket()
    {
        return [
            [false, PdfSettings::__DEFAULT],
            [false, PdfSettings::SCREEN],
            [false, PdfSettings::EBOOK],
            [true, PdfSettings::PRINTER],
            [true, PdfSettings::PREPRESS]
        ];
    }

    public function testDetectBlendsArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertTrue($trait->isDetectBlends());

        $trait = $this->createTraitForArgumentValue(false);
        $this->assertFalse($trait->setDetectBlends(false)->isDetectBlends());
    }

    public function testEmitDscWarningsArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertFalse($trait->isEmitDscWarnings());

        $trait = $this->createTraitForArgumentValue(true);
        $this->assertTrue($trait->setEmitDscWarnings(true)->isEmitDscWarnings());
    }

    public function testLockDistillerParamsArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertFalse($trait->isLockDistillerParams());

        $trait = $this->createTraitForArgumentValue(true);
        $this->assertTrue($trait->setLockDistillerParams(true)->isLockDistillerParams());
    }

    public function testOpmArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertSame(1, $trait->getOpm());

        $trait = $this->createTraitForArgumentValue(2);
        $this->assertSame(2, $trait->setOpm(2)->getOpm());
    }

    public function testParseDscCommentsArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertTrue($trait->isParseDscComments());

        $trait = $this->createTraitForArgumentValue(false);
        $this->assertFalse($trait->setParseDscComments(false)->isParseDscComments());
    }

    public function testParseDscCommentsForDocInfoArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertTrue($trait->isParseDscCommentsForDocInfo());

        $trait = $this->createTraitForArgumentValue(false);
        $this->assertFalse($trait->setParseDscCommentsForDocInfo(false)->isParseDscCommentsForDocInfo());
    }

    public function testPreserveCopyPageArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertTrue($trait->isPreserveCopyPage());

        $trait = $this->createTraitForArgumentValue(false);
        $this->assertFalse($trait->setPreserveCopyPage(false)->isPreserveCopyPage());
    }

    public function testPreserveEpsInfoArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertTrue($trait->isPreserveEpsInfo());

        $trait = $this->createTraitForArgumentValue(false);
        $this->assertFalse($trait->setPreserveEpsInfo(false)->isPreserveEpsInfo());
    }

    /**
     * @dataProvider providePdfSettingsForPreserveOpiComments
     *
     * @param bool   $preserveOpiComments
     * @param string $pdfSettings
     */
    public function testPreserveOpiCommentsArgument($preserveOpiComments, $pdfSettings)
    {
        $trait = $this->createTraitForDefaultValue($pdfSettings);
        $this->assertSame($preserveOpiComments, $trait->isPreserveOpiComments());

        $trait = $this->createTraitForArgumentValue($preserveOpiComments);
        $this->assertSame(
            $preserveOpiComments,
            $trait->setPreserveOpiComments($preserveOpiComments)->isPreserveOpiComments()
        );
    }

    /**
     * @return array
     */
    public static function providePdfSettingsForPreserveOpiComments()
    {
        return [
            [false, PdfSettings::__DEFAULT],
            [false, PdfSettings::SCREEN],
            [false, PdfSettings::EBOOK],
            [true, PdfSettings::PRINTER],
            [true, PdfSettings::PREPRESS]
        ];
    }

    public function testUsePrologueArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertFalse($trait->isUsePrologue());

        $trait = $this->createTraitForArgumentValue(true);
        $this->assertTrue($trait->setUsePrologue(true)->isUsePrologue());
    }
}
