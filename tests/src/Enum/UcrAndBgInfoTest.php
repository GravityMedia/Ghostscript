<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Enum;

use GravityMedia\Ghostscript\Enum\UcrAndBgInfo;

/**
 * The UCR and BG info enum test class
 *
 * @package GravityMedia\GhostscriptTest\Enum
 *
 * @covers  \GravityMedia\Ghostscript\Enum\UcrAndBgInfo
 */
class UcrAndBgInfoTest extends \PHPUnit_Framework_TestCase
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
