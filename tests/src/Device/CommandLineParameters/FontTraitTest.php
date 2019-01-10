<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\GhostscriptTest\Device\CommandLineParameters;

use GravityMedia\Ghostscript\Device\CommandLineParameters\FontTrait;
use PHPUnit\Framework\TestCase;

/**
 * The font-related parameters trait test class.
 *
 * @package GravityMedia\GhostscriptTest\Device\CommandLineParameters
 *
 * @covers  \GravityMedia\Ghostscript\Device\CommandLineParameters\FontTrait
 */
class FontTraitTest extends TestCase
{
    public function testFontPath()
    {
        /** @var FontTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(FontTrait::class);
        $trait->expects($this->once())->method('getArgumentValue')->with('-sFONTPATH')->willReturn(null);
        $this->assertNull($trait->getFontPath());

        $trait->expects($this->once())->method('setArgument')->with('-sFONTPATH=some/path')->willReturnSelf();
        $this->assertSame($trait, $trait->setFontPath('some/path'));
    }

}
