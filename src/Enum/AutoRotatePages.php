<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Enum;

/**
 * The auto rotate pages enum
 *
 * @package GravityMedia\Ghostscript\Enum
 */
class AutoRotatePages
{
    /**
     * Do not auto rotate pages
     */
    const NONE = 'None';

    /**
     * Auto rotate all pages
     */
    const ALL = 'All';

    /**
     * Auto rotate page by page
     */
    const PAGE_BY_PAGE = 'PageByPage';

    /**
     * Available auto rotate pages values
     *
     * @var string[] $values
     */
    private static $values = [
        self::NONE,
        self::ALL,
        self::PAGE_BY_PAGE
    ];

    /**
     * Get available auto rotate pages values
     *
     * @return string[]
     */
    public static function values()
    {
        return self::$values;
    }
}
