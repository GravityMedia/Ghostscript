<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\GhostscriptTest\CommandLineParameters;

use GravityMedia\Ghostscript\CommandLineParameters\OtherTrait;

/**
 * The other parameters trait test class
 *
 * @package GravityMedia\GhostscriptTest\CommandLineParameters
 *
 * @covers \GravityMedia\Ghostscript\CommandLineParameters\OtherTrait
 */
class OtherTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testFilterImage()
    {
        /** @var OtherTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(OtherTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dFILTERIMAGE')->willReturn(false);
        $this->assertFalse($trait->isFilterImage());

        $trait->expects($this->once())->method('setArgument')->with('-dFILTERIMAGE')->willReturnSelf();
        $this->assertSame($trait, $trait->setFilterImage());
    }

}
