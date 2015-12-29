<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Enum;

use GravityMedia\Ghostscript\Enum\Binding;

/**
 * The binding enum test class
 *
 * @package GravityMedia\GhostscriptTest\Enum
 *
 * @covers  \GravityMedia\Ghostscript\Enum\Binding
 */
class BindingTest extends \PHPUnit_Framework_TestCase
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
