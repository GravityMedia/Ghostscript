<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Enum;

/**
 * The default rendering intent enum
 *
 * @package GravityMedia\Ghostscript\Enum
 */
class DefaultRenderingIntent
{
    /**
     * Write no rendering intent to the PDF
     */
    const __DEFAULT = 'Default';

    /**
     * Perceptual rendering intent
     */
    const PERCEPTUAL = 'Perceptual';

    /**
     * Saturation rendering intent
     */
    const SATURATION = 'Saturation';

    /**
     * Relative colorimetric rendering intent
     */
    const RELATIVE_COLORIMETRIC = 'RelativeColorimetric';

    /**
     * Absolute colorimetric rendering intent
     */
    const ABSOLUTE_COLORIMETRIC = 'AbsoluteColorimetric';

    /**
     * Available default rendering intent values
     *
     * @var string[]
     */
    private static $values = [
        self::__DEFAULT,
        self::PERCEPTUAL,
        self::SATURATION,
        self::RELATIVE_COLORIMETRIC,
        self::ABSOLUTE_COLORIMETRIC
    ];

    /**
     * Get available default rendering intent values
     *
     * @return string[]
     */
    public static function values()
    {
        return self::$values;
    }
}
