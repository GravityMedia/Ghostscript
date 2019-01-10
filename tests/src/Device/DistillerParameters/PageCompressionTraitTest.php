<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Device\DistillerParameters;

use GravityMedia\Ghostscript\Device\DistillerParameters\PageCompressionTrait;
use PHPUnit\Framework\TestCase;

/**
 * The page compression distiller parameters test class.
 *
 * @package GravityMedia\GhostscriptTest\Devices\DistillerParameters
 *
 * @covers  \GravityMedia\Ghostscript\Device\DistillerParameters\PageCompressionTrait
 */
class PageCompressionTraitTest extends TestCase
{
    /**
     * @param null|string $argumentValue
     *
     * @return PageCompressionTrait
     */
    protected function createTraitForArgumentValue($argumentValue)
    {
        $trait = $this->getMockForTrait(PageCompressionTrait::class);

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

    public function testCompressPagesArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertTrue($trait->isCompressPages());

        $trait = $this->createTraitForArgumentValue(false);
        $this->assertFalse($trait->setCompressPages(false)->isCompressPages());
    }

    public function testLzwEncodePagesArgument()
    {
        $trait = $this->createTraitForArgumentValue(null);
        $this->assertFalse($trait->isLzwEncodePages());

        $trait = $this->createTraitForArgumentValue(true);
        $this->assertTrue($trait->setLzwEncodePages(true)->isLzwEncodePages());
    }
}
