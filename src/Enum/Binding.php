<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Enum;

/**
 * The binding enum
 *
 * @package GravityMedia\Ghostscript\Enum
 */
class Binding
{
    /**
     * Left binding
     */
    const LEFT = 'Left';

    /**
     * Right binding
     */
    const RIGHT = 'Right';

    /**
     * Available binding values
     *
     * @var string[] $values
     */
    private static $values = [
        self::LEFT,
        self::RIGHT
    ];

    /**
     * Get available binding values
     *
     * @return string[]
     */
    public static function values()
    {
        return self::$values;
    }
}
