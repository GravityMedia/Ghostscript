<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Enum;

/**
 * The transfer function info enum
 *
 * @package GravityMedia\Ghostscript\Enum
 */
class TransferFunctionInfo
{
    /**
     * Preserve transfer functions (pass into the PDF file)
     */
    const PRESERVE = 'Preserve';

    /**
     * Ignore transfer functions (do not pass into the PDF file)
     */
    const REMOVE = 'Remove';

    /**
     * Apply transfer functions to color values
     */
    const APPLY = 'Apply';

    /**
     * Available transfer function info values
     *
     * @var string[]
     */
    private static $values = [
        self::PRESERVE,
        self::REMOVE,
        self::APPLY
    ];

    /**
     * Get available transfer function info values
     *
     * @return string[]
     */
    public static function values()
    {
        return self::$values;
    }
}
