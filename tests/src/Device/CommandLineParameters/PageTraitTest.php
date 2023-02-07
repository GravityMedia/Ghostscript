<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\GhostscriptTest\Device\CommandLineParameters;

use GravityMedia\Ghostscript\Device\CommandLineParameters\PageTrait;
use PHPUnit\Framework\TestCase;

/**
 * The page parameters trait test class.
 *
 * @package GravityMedia\GhostscriptTest\Device\CommandLineParameters
 *
 * @covers \GravityMedia\Ghostscript\Device\CommandLineParameters\PageTrait
 */
class PageTraitTest extends TestCase
{
    public function testFirstPage()
    {
        /** @var PageTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(PageTrait::class);
        $trait->expects($this->once())->method('getArgumentValue')->with('-dFirstPage')->willReturn(null);
        $this->assertNull($trait->getFirstPage());

        $trait->expects($this->once())->method('setArgument')->with('-dFirstPage=42')->willReturnSelf();
        $this->assertSame($trait, $trait->setFirstPage(42));
    }

    public function testLastPage()
    {
        /** @var PageTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(PageTrait::class);
        $trait->expects($this->once())->method('getArgumentValue')->with('-dLastPage')->willReturn(null);
        $this->assertNull($trait->getLastPage());

        $trait->expects($this->once())->method('setArgument')->with('-dLastPage=42')->willReturnSelf();
        $this->assertSame($trait, $trait->setLastPage(42));
    }

    public function testFixedMedia()
    {
        /** @var PageTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(PageTrait::class);
        $trait->expects($this->once())->method('getArgumentValue')->with('-dFIXEDMEDIA')->willReturn(null);
        $this->assertNull($trait->getFixedMedia());

        $trait->expects($this->once())->method('setArgument')->with('-dFIXEDMEDIA')->willReturnSelf();
        $this->assertSame($trait, $trait->setFixedMedia());
    }

    public function testPDFFitPage()
    {
        /** @var PageTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(PageTrait::class);
        $trait->expects($this->once())->method('getArgumentValue')->with('-dPDFFitPage')->willReturn(null);
        $this->assertNull($trait->getPDFFitPage());

        $trait->expects($this->once())->method('setArgument')->with('-dPDFFitPage')->willReturnSelf();
        $this->assertSame($trait, $trait->setPDFFitPage());
    }
}
