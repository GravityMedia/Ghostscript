<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\Ghostscript\Device\CommandLineParameters;

/**
 * The page parameters trait
 *
 * @package GravityMedia\Ghostscript\Device\CommandLineParameters
 *
 * @link    http://ghostscript.com/doc/current/Use.htm#Page_parameters
 */
trait PageTrait
{
    /**
     * Get argument value
     *
     * @param string $name
     *
     * @return null|string
     */
    abstract protected function getArgumentValue($name);

    /**
     * Set argument
     *
     * @param string $argument
     *
     * @return $this
     */
    abstract protected function setArgument($argument);

    /**
     * TODO
     *
     * -dFirstPage=pagenumber
     *     Begins processing on the designated page of the document.
     *
     * -dLastPage=pagenumber
     *     Stops processing after the designated page of the document.
     *
     * -dFIXEDMEDIA
     *     Causes the media size to be fixed after initialization, forcing pages of other sizes or orientations to be
     *     clipped. This may be useful when printing documents on a printer that can handle their requested paper size
     *     but whose default is some other size. Note that -g automatically sets -dFIXEDMEDIA, but -sPAPERSIZE= does
     *     not.
     *
     * -dFIXEDRESOLUTION
     *     Causes the media resolution to be fixed similarly. -r automatically sets -dFIXEDRESOLUTION.
     *
     * -dPSFitPage
     *     The page size from the PostScript file setpagedevice operator, or one of the older statusdict page size
     *     operators (such as letter or a4) will be rotated, scaled and centered on the "best fit" page size from those
     *     availiable in the InputAttributes list. The -dPSFitPage is most easily used to fit pages when used with the
     *     -dFIXEDMEDIA option.
     *
     *     This option is also set by the -dFitPage option.
     *
     * -dORIENT1=true
     * -dORIENT1=false
     *     Defines the meaning of the 0 and 1 orientation values for the setpage[params] compatibility operators. The
     *     default value of ORIENT1 is true (set in gs_init.ps), which is the correct value for most files that use
     *     setpage[params] at all, namely, files produced by badly designed applications that "know" that the output
     *     will be printed on certain roll-media printers: these applications use 0 to mean landscape and 1 to mean
     *     portrait. -dORIENT1=false declares that 0 means portrait and 1 means landscape, which is the convention used
     *     by a smaller number of files produced by properly written applications.
     *
     * -dDEVICEWIDTHPOINTS=w
     * -dDEVICEHEIGHTPOINTS=h
     *     Sets the initial page width to w or initial page height to h respectively, specified in 1/72" units.
     *
     * -sDEFAULTPAPERSIZE=a4
     *     This value will be used to replace the device default papersize ONLY if the default papersize for the device
     *     is 'letter' or 'a4' serving to insulate users of A4 or 8.5x11 from particular device defaults (the
     *     collection of contributed drivers in Ghostscript vary as to the default size).
     *
     * -dFitPage
     *     This is a "convenience" operator that sets the various options to perform page fitting for specific file
     *     types.
     *
     *     This option sets the -dEPSFitPage, -dPDFFitPage, and the -dFitPage options.
     */
}
