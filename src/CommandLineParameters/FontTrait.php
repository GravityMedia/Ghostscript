<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\Ghostscript\CommandLineParameters;

/**
 * The font-related parameters trait
 *
 * @package GravityMedia\Ghostscript\CommandLineParameters
 * @see http://ghostscript.com/doc/current/Use.htm#Font_related_parameters
 */
trait FontTrait
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

    /*
     * TODO

-dDISKFONTS
    Causes individual character outlines to be loaded from the disk the first time they are encountered. (Normally Ghostscript loads all the character outlines when it loads a font.) This may allow loading more fonts into memory at the expense of slower rendering. DISKFONTS is effective only if the diskfont feature was built into the executable; otherwise it is ignored.

-dLOCALFONTS
    Causes Type 1 fonts to be loaded into the current VM -- normally local VM -- instead of always being loaded into global VM. Useful only for compatibility with Adobe printers for loading some obsolete fonts.

-dNOCCFONTS
    Suppresses the use of fonts precompiled into the Ghostscript executable. See "Precompiling fonts" in the documentation on fonts for details. This is probably useful only for debugging.

-dNOFONTMAP
    Suppresses the normal loading of the Fontmap file. This may be useful in environments without a file system.

-dNOFONTPATH
    Suppresses consultation of GS_FONTPATH. This may be useful for debugging.

-dNOPLATFONTS
    Disables the use of fonts supplied by the underlying platform (X Windows or Microsoft Windows). This may be needed if the platform fonts look undesirably different from the scalable fonts.

-dNONATIVEFONTMAP
    Disables the use of font map and corresponding fonts supplied by the underlying platform. This may be needed to ensure consistent rendering on the platforms with different fonts, for instance, during regression testing.

-sFONTMAP=filename1;filename2;...
    Specifies alternate name or names for the Fontmap file. Note that the names are separated by ":" on Unix systems, by ";" on MS Windows systems, and by "," on VMS systems, just as for search paths.
*/

    /**
     * Get FONTPATH parameter value
     *
     * @return string|null
     */
    public function getFontPath()
    {
        return $this->getArgumentValue('-sFONTPATH');
    }

    /**
     * Set FONTPATH parameter
     *
     * @param string $fontPath Specifies a list of directories that will be scanned when looking for fonts not found on
     * the search path, overriding the environment variable GS_FONTPATH.
     *
     * @return $this
     */
    public function setFontPath($fontPath)
    {
        $this->setArgument(sprintf('-sFONTPATH=%s', $fontPath));

        return $this;
    }

    /*
-sSUBSTFONT=fontname
    Causes the given font to be substituted for all unknown fonts, instead of using the normal intelligent substitution algorithm. Also, in this case, the font returned by findfont is the actual font named fontname, not a copy of the font with its FontName changed to the requested one. THIS OPTION SHOULD NOT BE USED WITH HIGH LEVEL DEVICES, such as pdfwrite, because it prevents such devices from providing the original font names in the output document. The font specified (fontname) will be embedded instead, limiting all future users of the document to the same approximate rendering.

-dOLDCFF
    Reverts to using the old, sequential, PostScript CFF parser. New CFF parser is coded in C and uses direct access to the font data. This option and the old parser will be removed when the new parser proves its reliability.

     */
}
