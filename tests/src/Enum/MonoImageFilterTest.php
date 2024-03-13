<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Enum;

use GravityMedia\Ghostscript\Enum\MonoImageFilter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * The monochrome image filter enum test class
 *
 * @package GravityMedia\GhostscriptTest\Enum
 */
#[CoversClass(\GravityMedia\Ghostscript\Enum\MonoImageFilter::class)]
class MonoImageFilterTest extends TestCase
{
    public function testValues()
    {
        $values = [
            MonoImageFilter::CCITT_FAX_ENCODE,
            MonoImageFilter::FLATE_ENCODE,
            MonoImageFilter::RUN_LENGTH_ENCODE
        ];

        $this->assertEquals($values, MonoImageFilter::values());
    }
}
