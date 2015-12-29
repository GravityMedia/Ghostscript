<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Enum;

use GravityMedia\Ghostscript\Enum\PdfSettings;

/**
 * The PDF settings enum test class
 *
 * @package GravityMedia\GhostscriptTest\Enum
 *
 * @covers  \GravityMedia\Ghostscript\Enum\PdfSettings
 */
class PdfSettingsTest extends \PHPUnit_Framework_TestCase
{
    public function testValues()
    {
        $values = [
            PdfSettings::__DEFAULT,
            PdfSettings::SCREEN,
            PdfSettings::EBOOK,
            PdfSettings::PRINTER,
            PdfSettings::PREPRESS
        ];

        $this->assertEquals($values, PdfSettings::values());
    }
}
