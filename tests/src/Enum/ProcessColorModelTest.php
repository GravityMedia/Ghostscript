<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\GhostscriptTest\Enum;

use GravityMedia\Ghostscript\Enum\ProcessColorModel;

/**
 * The binding enum test class
 *
 * @package GravityMedia\GhostscriptTest\Enum
 *
 * @covers  \GravityMedia\Ghostscript\Enum\ProcessColorModel
 */
class ProcessColorModelTest extends \PHPUnit_Framework_TestCase
{
    public function testValues()
    {
        $values = [
            ProcessColorModel::DEVICE_RGB,
            ProcessColorModel::DEVICE_CMYK,
            ProcessColorModel::DEVICE_GRAY
        ];

        $this->assertEquals($values, ProcessColorModel::values());
    }
}
