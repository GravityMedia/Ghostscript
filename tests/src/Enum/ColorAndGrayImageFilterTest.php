<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Enum;

use GravityMedia\Ghostscript\Enum\ColorAndGrayImageFilter;

/**
 * The color and grayscale image filter enum test class
 *
 * @package GravityMedia\GhostscriptTest\Enum
 *
 * @covers  \GravityMedia\Ghostscript\Enum\ColorAndGrayImageFilter
 */
class ColorAndGrayImageFilterTest extends \PHPUnit_Framework_TestCase
{
    public function testValues()
    {
        $values = [
            ColorAndGrayImageFilter::DCT_ENCODE,
            ColorAndGrayImageFilter::FLATE_ENCODE
        ];

        $this->assertEquals($values, ColorAndGrayImageFilter::values());
    }
}
