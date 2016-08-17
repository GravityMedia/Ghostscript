<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\GhostscriptTest\Device\CommandLineParameters;

use GravityMedia\Ghostscript\Device\CommandLineParameters\OtherTrait;

/**
 * The other parameters trait test class.
 *
 * @package GravityMedia\GhostscriptTest\Device\CommandLineParameters
 *
 * @covers \GravityMedia\Ghostscript\Device\CommandLineParameters\OtherTrait
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

    public function testFilterText()
    {
        /** @var OtherTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(OtherTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dFILTERTEXT')->willReturn(false);
        $this->assertFalse($trait->isFilterText());

        $trait->expects($this->once())->method('setArgument')->with('-dFILTERTEXT')->willReturnSelf();
        $this->assertSame($trait, $trait->setFilterText());
    }

    public function testFilterVector()
    {
        /** @var OtherTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(OtherTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dFILTERVECTOR')->willReturn(false);
        $this->assertFalse($trait->isFilterVector());

        $trait->expects($this->once())->method('setArgument')->with('-dFILTERVECTOR')->willReturnSelf();
        $this->assertSame($trait, $trait->setFilterVector());
    }

    public function testDelayBind()
    {
        /** @var OtherTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(OtherTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dDELAYBIND')->willReturn(false);
        $this->assertFalse($trait->isDelayBind());

        $trait->expects($this->once())->method('setArgument')->with('-dDELAYBIND')->willReturnSelf();
        $this->assertSame($trait, $trait->setDelayBind());
    }

    public function testDoPdfMarks()
    {
        /** @var OtherTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(OtherTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dDOPDFMARKS')->willReturn(false);
        $this->assertFalse($trait->isDoPdfMarks());

        $trait->expects($this->once())->method('setArgument')->with('-dDOPDFMARKS')->willReturnSelf();
        $this->assertSame($trait, $trait->setDoPdfMarks());
    }

    public function testJobServer()
    {
        /** @var OtherTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(OtherTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dJOBSERVER')->willReturn(false);
        $this->assertFalse($trait->isJobServer());

        $trait->expects($this->once())->method('setArgument')->with('-dJOBSERVER')->willReturnSelf();
        $this->assertSame($trait, $trait->setJobServer());
    }

    public function testNoBind()
    {
        /** @var OtherTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(OtherTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dNOBIND')->willReturn(false);
        $this->assertFalse($trait->isNoBind());

        $trait->expects($this->once())->method('setArgument')->with('-dNOBIND')->willReturnSelf();
        $this->assertSame($trait, $trait->setNoBind());
    }

    public function testNoCache()
    {
        /** @var OtherTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(OtherTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dNOCACHE')->willReturn(false);
        $this->assertFalse($trait->isNoCache());

        $trait->expects($this->once())->method('setArgument')->with('-dNOCACHE')->willReturnSelf();
        $this->assertSame($trait, $trait->setNoCache());
    }

    public function testNoGc()
    {
        /** @var OtherTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(OtherTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dNOGC')->willReturn(false);
        $this->assertFalse($trait->isNoGc());

        $trait->expects($this->once())->method('setArgument')->with('-dNOGC')->willReturnSelf();
        $this->assertSame($trait, $trait->setNoGc());
    }

    public function testNoOuterSave()
    {
        /** @var OtherTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(OtherTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dNOOUTERSAVE')->willReturn(false);
        $this->assertFalse($trait->isNoOuterSave());

        $trait->expects($this->once())->method('setArgument')->with('-dNOOUTERSAVE')->willReturnSelf();
        $this->assertSame($trait, $trait->setNoOuterSave());
    }

    public function testNoSafer()
    {
        /** @var OtherTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(OtherTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dNOSAFER')->willReturn(false);
        $this->assertFalse($trait->isNoSafer());

        $trait->expects($this->once())->method('setArgument')->with('-dNOSAFER')->willReturnSelf();
        $this->assertSame($trait, $trait->setNoSafer());
    }

    public function testSafer()
    {
        /** @var OtherTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(OtherTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dSAFER')->willReturn(false);
        $this->assertFalse($trait->isSafer());

        $trait->expects($this->once())->method('setArgument')->with('-dSAFER')->willReturnSelf();
        $this->assertSame($trait, $trait->setSafer());
    }

    public function testPreBandThreshold()
    {
        /** @var OtherTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(OtherTrait::class);
        $trait->expects($this->exactly(3))->method('getArgumentValue')
            ->with('-dPreBandThreshold')->willReturnOnConsecutiveCalls(null, true, false);
        $trait->expects($this->exactly(2))->method('setArgument')
            ->withConsecutive(['-dPreBandThreshold=true'], ['-dPreBandThreshold=false'])->willReturnSelf();
        $this->assertFalse($trait->isPreBandThreshold());
        $this->assertSame($trait, $trait->setPreBandThreshold(true));
        $this->assertTrue($trait->isPreBandThreshold());
        $this->assertSame($trait, $trait->setPreBandThreshold(false));
        $this->assertFalse($trait->isPreBandThreshold());
    }

    public function testStrict()
    {
        /** @var OtherTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(OtherTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dSTRICT')->willReturn(false);
        $this->assertFalse($trait->isStrict());

        $trait->expects($this->once())->method('setArgument')->with('-dSTRICT')->willReturnSelf();
        $this->assertSame($trait, $trait->setStrict());
    }

    public function testWriteSystemDict()
    {
        /** @var OtherTrait|\PHPUnit_Framework_MockObject_MockObject $trait */
        $trait = $this->getMockForTrait(OtherTrait::class);
        $trait->expects($this->once())->method('hasArgument')->with('-dWRITESYSTEMDICT')->willReturn(false);
        $this->assertFalse($trait->isWriteSystemDict());

        $trait->expects($this->once())->method('setArgument')->with('-dWRITESYSTEMDICT')->willReturnSelf();
        $this->assertSame($trait, $trait->setWriteSystemDict());
    }
}
