<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Enum;

use GravityMedia\Ghostscript\Enum\AutoRotatePages;
use PHPUnit\Framework\TestCase;

/**
 * The auto rotate pages enum test class
 *
 * @package GravityMedia\GhostscriptTest\Enum
 *
 * @covers  \GravityMedia\Ghostscript\Enum\AutoRotatePages
 */
class AutoRotatePagesTest extends TestCase
{
    public function testValues()
    {
        $values = [
            AutoRotatePages::NONE,
            AutoRotatePages::ALL,
            AutoRotatePages::PAGE_BY_PAGE
        ];

        $this->assertEquals($values, AutoRotatePages::values());
    }
}
