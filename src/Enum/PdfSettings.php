<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Enum;

/**
 * The PDF settings enum
 *
 * @package GravityMedia\Ghostscript\Enum
 */
class PdfSettings
{
    /**
     * Output intended to be useful across a wide variety of uses, possibly at the expense of a larger output file
     */
    const __DEFAULT = 'default';

    /**
     * Low-resolution output similar to the Acrobat Distiller "Screen Optimized" setting
     */
    const SCREEN = 'screen';

    /**
     * Medium-resolution output similar to the Acrobat Distiller "eBook" setting
     */
    const EBOOK = 'ebook';

    /**
     * Output similar to the Acrobat Distiller "Print Optimized" setting
     */
    const PRINTER = 'printer';

    /**
     * Output similar to Acrobat Distiller "Prepress Optimized" setting
     */
    const PREPRESS = 'prepress';

    /**
     * Available PDF settings values
     *
     * @var string[] $values
     */
    private static $values = [
        self::__DEFAULT,
        self::SCREEN,
        self::EBOOK,
        self::PRINTER,
        self::PREPRESS
    ];

    /**
     * Get available PDF settings values
     *
     * @return string[]
     */
    public static function values()
    {
        return self::$values;
    }
}
