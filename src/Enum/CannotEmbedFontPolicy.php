<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Enum;

/**
 * The cannot embed font policy enum
 *
 * @package GravityMedia\Ghostscript\Enum
 */
class CannotEmbedFontPolicy
{
    /**
     * Ignore non embeddable fonts and continue
     */
    const OK = 'OK';

    /**
     * Display a warning for non embeddable fonts
     */
    const WARNING = 'Warning';

    /**
     * Quit current job for non embeddable fonts
     */
    const ERROR = 'Error';

    /**
     * Available cannot embed font policy values
     *
     * @var string[]
     */
    private static $values = [
        self::OK,
        self::WARNING,
        self::ERROR
    ];

    /**
     * Get available cannot embed font policy values
     *
     * @return string[]
     */
    public static function values()
    {
        return self::$values;
    }
}
