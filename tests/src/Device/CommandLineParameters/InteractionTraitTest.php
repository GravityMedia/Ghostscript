<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\GhostscriptTest\Device\CommandLineParameters;

use GravityMedia\Ghostscript\Device\CommandLineParameters\InteractionTrait;

/**
 * The interaction-related parameters trait test class.
 *
 * @package GravityMedia\GhostscriptTest\Device\CommandLineParameters
 *
 * @covers  \GravityMedia\Ghostscript\Device\CommandLineParameters\InteractionTrait
 */
class InteractionTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testBatch()
    {
        /** @var InteractionTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(InteractionTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dBATCH')->willReturn(false);
        $this->assertFalse($trait->isBatch());

        $trait->expects($this->once())->method('setArgument')->with('-dBATCH')->willReturnSelf();
        $this->assertSame($trait, $trait->setBatch());
    }

    public function testNoPagePrompt()
    {
        /** @var InteractionTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(InteractionTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dNOPAGEPROMPT')->willReturn(false);
        $this->assertFalse($trait->isNoPagePrompt());

        $trait->expects($this->once())->method('setArgument')->with('-dNOPAGEPROMPT')->willReturnSelf();
        $this->assertSame($trait, $trait->setNoPagePrompt());
    }

    public function testNoPause()
    {
        /** @var InteractionTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(InteractionTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dNOPAUSE')->willReturn(false);
        $this->assertFalse($trait->isNoPause());

        $trait->expects($this->once())->method('setArgument')->with('-dNOPAUSE')->willReturnSelf();
        $this->assertSame($trait, $trait->setNoPause());
    }

    public function testNoPromt()
    {
        /** @var InteractionTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(InteractionTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dNOPROMPT')->willReturn(false);
        $this->assertFalse($trait->isNoPrompt());

        $trait->expects($this->once())->method('setArgument')->with('-dNOPROMPT')->willReturnSelf();
        $this->assertSame($trait, $trait->setNoPrompt());
    }

    public function testQuiet()
    {
        /** @var InteractionTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(InteractionTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dQUIET')->willReturn(false);
        $this->assertFalse($trait->isQuiet());

        $trait->expects($this->once())->method('setArgument')->with('-dQUIET')->willReturnSelf();
        $this->assertSame($trait, $trait->setQuiet());
    }

    public function testShortErrors()
    {
        /** @var InteractionTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(InteractionTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dSHORTERRORS')->willReturn(false);
        $this->assertFalse($trait->isShortErrors());

        $trait->expects($this->once())->method('setArgument')->with('-dSHORTERRORS')->willReturnSelf();
        $this->assertSame($trait, $trait->setShortErrors());
    }

    public function testStdout()
    {
        /** @var InteractionTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(InteractionTrait::class);
        $trait->expects($this->once())->method('getArgumentValue')->with('-sstdout')->willReturn(null);
        $this->assertNull($trait->getStdout());

        $trait->expects($this->once())->method('setArgument')->with('-sstdout=some file')->willReturnSelf();
        $this->assertSame($trait, $trait->setStdout('some file'));
    }

    public function testTtyPause()
    {
        /** @var InteractionTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(InteractionTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dTTYPAUSE')->willReturn(false);
        $this->assertFalse($trait->isTtyPause());

        $trait->expects($this->once())->method('setArgument')->with('-dTTYPAUSE')->willReturnSelf();
        $this->assertSame($trait, $trait->setTtyPause());
    }

}
