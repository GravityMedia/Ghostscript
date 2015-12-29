<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Enum;

/**
 * The image downsample type enum
 *
 * @package GravityMedia\Ghostscript\Enum
 */
class ImageDownsampleType
{
    /**
     * Average groups of samples to get the downsampled value
     */
    const AVERAGE = 'Average';

    /**
     * Use bicubic interpolation on a group of samples to get the downsampled value
     */
    const BICUBIC = 'Bicubic';

    /**
     * Pick the center sample from a group of samples to get the downsampled value
     */
    const SUBSAMPLE = 'Subsample';

    /**
     * Do not downsample images
     */
    const NONE = 'None';

    /**
     * Available image downsample type values
     *
     * @var string[]
     */
    private static $values = [
        self::AVERAGE,
        self::BICUBIC,
        self::SUBSAMPLE,
        self::NONE,
    ];

    /**
     * Get available image downsample type values
     *
     * @return string[]
     */
    public static function values()
    {
        return self::$values;
    }
}
