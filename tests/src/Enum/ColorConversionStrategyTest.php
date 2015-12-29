<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Enum;

use GravityMedia\Ghostscript\Enum\ColorConversionStrategy;

/**
 * The color conversion strategy enum test class
 *
 * @package GravityMedia\GhostscriptTest\Enum
 *
 * @covers  \GravityMedia\Ghostscript\Enum\ColorConversionStrategy
 */
class ColorConversionStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testValues()
    {
        $values = [
            ColorConversionStrategy::LEAVE_COLOR_UNCHANGED,
            ColorConversionStrategy::USE_DEVICE_INDEPENDENT_COLOR,
            ColorConversionStrategy::GRAY,
            ColorConversionStrategy::SRGB,
            ColorConversionStrategy::CMYK
        ];

        $this->assertEquals($values, ColorConversionStrategy::values());
    }
}
