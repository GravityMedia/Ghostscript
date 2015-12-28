<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
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

    /**
     * Leave color unchanged
     */
    const COLOR_CONVERSION_STRATEGY_LEAVE_COLOR_UNCHANGED = 'LeaveColorUnchanged';

    /**
     * Tag everything for color management
     */
    const COLOR_CONVERSION_STRATEGY_USE_DEVICE_INDEPENDENT_COLOR = 'UseDeviceIndependentColor';

    /**
     * Convert all colors to gray
     */
    const COLOR_CONVERSION_STRATEGY_GRAY = 'Gray';

    /**
     * Convert all colors to RGB
     */
    const COLOR_CONVERSION_STRATEGY_RGB = 'RGB';

    /**
     * Convert all colors to CMYK
     */
    const COLOR_CONVERSION_STRATEGY_CMYK = 'CMYK';

    /**
     * Write no rendering intent to the PDF
     */
    const DEFAULT_RENDERING_INTENT_DEFAULT = 'Default';

    /**
     * Perceptual rendering intent
     */
    const DEFAULT_RENDERING_INTENT_PERCEPTUAL = 'Perceptual';

    /**
     * Saturation rendering intent
     */
    const DEFAULT_RENDERING_INTENT_SATURATION = 'Saturation';

    /**
     * Relative colorimetric rendering intent
     */
    const DEFAULT_RENDERING_INTENT_RELATIVE_COLORIMETRIC = 'RelativeColorimetric';

    /**
     * Absolute colorimetric rendering intent
     */
    const DEFAULT_RENDERING_INTENT_ABSOLUTE_COLORIMETRIC = 'AbsoluteColorimetric';

    /**
     * Average groups of samples to get the downsampled value
     */
    const IMAGE_DOWNSAMPLE_TYPE_AVERAGE = 'Average';

    /**
     * Use bicubic interpolation on a group of samples to get the downsampled value
     */
    const IMAGE_DOWNSAMPLE_TYPE_BICUBIC = 'Bicubic';

    /**
     * Pick the center sample from a group of samples to get the downsampled value
     */
    const IMAGE_DOWNSAMPLE_TYPE_SUBSAMPLE = 'Subsample';

    /**
     * Do not downsample images
     */
    const IMAGE_DOWNSAMPLE_TYPE_NONE = 'None';

    /**
     * Select JPEG compression
     */
    const IMAGE_FILTER_DCT_ENCODE = 'DCTEncode';

    /**
     * Select Flate (ZIP) compression
     */
    const IMAGE_FILTER_FLATE_ENCODE = 'FlateEncode';

    /**
     * Select CCITT Group 3 or 4 facsimile encoding
     */
    const IMAGE_FILTER_CCITT_FAX_ENCODE = 'CCITTFaxEncode';

    /**
     * Select run length encoding
     */
    const IMAGE_FILTER_RUN_LENGTH_ENCODE = 'RunLengthEncode';

    /**
     * Preserve transfer functions (pass into the PDF file)
     */
    const TRANSFER_FUNCTION_INFO_PRESERVE = 'Preserve';

    /**
     * Ignore transfer functions (do not pass into the PDF file)
     */
    const TRANSFER_FUNCTION_INFO_REMOVE = 'Remove';

    /**
     * Apply transfer functions to color values
     */
    const TRANSFER_FUNCTION_INFO_APPLY = 'Apply';

    /**
     * Preserve under color removal and black generation arguments
     */
    const UCR_AND_BG_INFO_PRESERVE = 'Preserve';

    /**
     * Ignore under color removal and black generation arguments
     */
    const UCR_AND_BG_INFO_REMOVE = 'Remove';
}
