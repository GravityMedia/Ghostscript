<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Enum;

use GravityMedia\Ghostscript\Enum\CannotEmbedFontPolicy;

/**
 * The cannot embed font policy enum test class
 *
 * @package GravityMedia\GhostscriptTest\Enum
 *
 * @covers  \GravityMedia\Ghostscript\Enum\CannotEmbedFontPolicy
 */
class CannotEmbedFontPolicyTest extends \PHPUnit_Framework_TestCase
{
    public function testValues()
    {
        $values = [
            CannotEmbedFontPolicy::OK,
            CannotEmbedFontPolicy::WARNING,
            CannotEmbedFontPolicy::ERROR
        ];

        $this->assertEquals($values, CannotEmbedFontPolicy::values());
    }
}
