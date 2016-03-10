<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\Ghostscript\Enum;

/**
 * The process color model enum
 *
 * @package GravityMedia\Ghostscript\Enum
 */
class ProcessColorModel
{
    const DEVICE_RGB = 'DeviceRGB';
    const DEVICE_CMYK = 'DeviceCMYK';
    const DEVICE_GRAY = 'DeviceGray';


    /**
     * Available process color model values
     *
     * @var string[] $values
     */
    private static $values = [
        self::DEVICE_RGB,
        self::DEVICE_CMYK,
        self::DEVICE_GRAY
    ];

    /**
     * Get available process color model values
     *
     * @return string[]
     */
    public static function values()
    {
        return self::$values;
    }
}
