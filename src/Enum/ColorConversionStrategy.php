<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Enum;

/**
 * The color conversion strategy enum
 *
 * @package GravityMedia\Ghostscript\Enum
 */
class ColorConversionStrategy
{
    /**
     * Leave color unchanged
     */
    const LEAVE_COLOR_UNCHANGED = 'LeaveColorUnchanged';

    /**
     * Tag everything for color management
     */
    const USE_DEVICE_INDEPENDENT_COLOR = 'UseDeviceIndependentColor';

    /**
     * Convert all colors to gray
     */
    const GRAY = 'Gray';

    /**
     * Convert all colors to sRGB
     */
    const SRGB = 'sRGB';

    /**
     * Convert all colors to CMYK
     */
    const CMYK = 'CMYK';

    /**
     * Available color conversion strategy values
     *
     * @var string[]
     */
    private static $values = [
        self::LEAVE_COLOR_UNCHANGED,
        self::USE_DEVICE_INDEPENDENT_COLOR,
        self::GRAY,
        self::SRGB,
        self::CMYK
    ];

    /**
     * Get available color conversion strategy values
     *
     * @return string[]
     */
    public static function values()
    {
        return self::$values;
    }
}
