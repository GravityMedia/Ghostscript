<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Enum;

use GravityMedia\Ghostscript\Enum\DefaultRenderingIntent;

/**
 * The default rendering intent enum test class
 *
 * @package GravityMedia\GhostscriptTest\Enum
 *
 * @covers  \GravityMedia\Ghostscript\Enum\DefaultRenderingIntent
 */
class DefaultRenderingIntentTest extends \PHPUnit_Framework_TestCase
{
    public function testValues()
    {
        $values = [
            DefaultRenderingIntent::__DEFAULT,
            DefaultRenderingIntent::PERCEPTUAL,
            DefaultRenderingIntent::SATURATION,
            DefaultRenderingIntent::RELATIVE_COLORIMETRIC,
            DefaultRenderingIntent::ABSOLUTE_COLORIMETRIC
        ];

        $this->assertEquals($values, DefaultRenderingIntent::values());
    }
}
