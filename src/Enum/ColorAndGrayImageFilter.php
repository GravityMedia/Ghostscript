<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Enum;

/**
 * The color and grayscale image filter enum
 *
 * @package GravityMedia\Ghostscript\Enum
 */
class ColorAndGrayImageFilter
{
    /**
     * Select JPEG compression
     */
    const DCT_ENCODE = 'DCTEncode';

    /**
     * Select Flate (ZIP) compression
     */
    const FLATE_ENCODE = 'FlateEncode';

    /**
     * Available color and grayscale image filter values
     *
     * @var string[]
     */
    private static $values = [
        self::DCT_ENCODE,
        self::FLATE_ENCODE
    ];

    /**
     * Get available color and grayscale image filter values
     *
     * @return string[]
     */
    public static function values()
    {
        return self::$values;
    }
}
