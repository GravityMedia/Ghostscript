<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Enum;

use GravityMedia\Ghostscript\Enum\Binding;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * The binding enum test class
 *
 * @package GravityMedia\GhostscriptTest\Enum
 */
#[CoversClass(\GravityMedia\Ghostscript\Enum\Binding::class)]
class BindingTest extends TestCase
{
    public function testValues()
    {
        $values = [
            Binding::LEFT,
            Binding::RIGHT
        ];

        $this->assertEquals($values, Binding::values());
    }
}
