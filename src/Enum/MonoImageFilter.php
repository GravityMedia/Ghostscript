<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Enum;

/**
 * The monochrome image filter enum
 *
 * @package GravityMedia\Ghostscript\Enum
 */
class MonoImageFilter
{
    /**
     * Select CCITT Group 3 or 4 facsimile encoding
     */
    const CCITT_FAX_ENCODE = 'CCITTFaxEncode';

    /**
     * Select Flate (ZIP) compression
     */
    const FLATE_ENCODE = 'FlateEncode';

    /**
     * Select run length encoding
     */
    const RUN_LENGTH_ENCODE = 'RunLengthEncode';

    /**
     * Available monochrome image filter values
     *
     * @var string[]
     */
    private static $values = [
        self::CCITT_FAX_ENCODE,
        self::FLATE_ENCODE,
        self::RUN_LENGTH_ENCODE
    ];

    /**
     * Get available monochrome image filter values
     *
     * @return string[]
     */
    public static function values()
    {
        return self::$values;
    }
}
