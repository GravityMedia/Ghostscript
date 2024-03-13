<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Enum;

use GravityMedia\Ghostscript\Enum\ImageDownsampleType;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * The image downsample type enum test class
 *
 * @package GravityMedia\GhostscriptTest\Enum
 */
#[CoversClass(\GravityMedia\Ghostscript\Enum\ImageDownsampleType::class)]
class ImageDownsampleTypeTest extends TestCase
{
    public function testValues()
    {
        $values = [
            ImageDownsampleType::AVERAGE,
            ImageDownsampleType::BICUBIC,
            ImageDownsampleType::SUBSAMPLE,
            ImageDownsampleType::NONE,
        ];

        $this->assertEquals($values, ImageDownsampleType::values());
    }
}
