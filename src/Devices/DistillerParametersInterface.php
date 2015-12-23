<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schr�der <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Devices;

/**
 * The distiller parameters interface
 *
 * @package GravityMedia\Ghostscript\Devices
 */
interface DistillerParametersInterface
{
    /**
     * Do not auto rotate pages
     */
    const AUTO_ROTATE_PAGES_NONE = 'None';

    /**
     * Auto rotate all pages
     */
    const AUTO_ROTATE_PAGES_ALL = 'All';

    /**
     * Auto rotate page by page
     */
    const AUTO_ROTATE_PAGES_PAGE_BY_PAGE = 'PageByPage';

    /**
     * Left binding
     */
    const BINDING_LEFT = 'Left';

    /**
     * Right binding
     */
    const BINDING_RIGHT = 'Right';

    /**
     * Ignore non embeddable fonts and continue
     */
    const CANNOT_EMBED_FONT_POLICY_OK = 'OK';

    /**
     * Display a warning for non embeddable fonts
     */
    const CANNOT_EMBED_FONT_POLICY_WARNING = 'Warning';

    /**
     * Quit current job for non embeddable fonts
     */
    const CANNOT_EMBED_FONT_POLICY_ERROR = 'Error';
}
