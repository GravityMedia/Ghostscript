<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Enum;

use GravityMedia\Ghostscript\Enum\TransferFunctionInfo;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * The transfer function info enum test class
 *
 * @package GravityMedia\GhostscriptTest\Enum
 */
#[CoversClass(\GravityMedia\Ghostscript\Enum\TransferFunctionInfo::class)]
class TransferFunctionInfoTest extends TestCase
{
    public function testValues()
    {
        $values = [
            TransferFunctionInfo::PRESERVE,
            TransferFunctionInfo::REMOVE,
            TransferFunctionInfo::APPLY
        ];

        $this->assertEquals($values, TransferFunctionInfo::values());
    }
}
