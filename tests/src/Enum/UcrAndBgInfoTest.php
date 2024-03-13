<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Enum;

use GravityMedia\Ghostscript\Enum\UcrAndBgInfo;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * The UCR and BG info enum test class
 *
 * @package GravityMedia\GhostscriptTest\Enum
 */
#[CoversClass(\GravityMedia\Ghostscript\Enum\UcrAndBgInfo::class)]
class UcrAndBgInfoTest extends TestCase
{
    public function testValues()
    {
        $values = [
            UcrAndBgInfo::PRESERVE,
            UcrAndBgInfo::REMOVE
        ];

        $this->assertEquals($values, UcrAndBgInfo::values());
    }
}
