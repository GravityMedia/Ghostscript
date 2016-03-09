<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\Ghostscript\CommandLineParameters;

/**
 * The rendering parameters trait
 *
 * @package GravityMedia\Ghostscript\CommandLineParameters
 * @see http://ghostscript.com/doc/current/Use.htm#Rendering_parameters
 */
trait RenderingTrait
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

-dCOLORSCREEN
-dCOLORSCREEN=0
-dCOLORSCREEN=false
    On high-resolution devices (at least 150 dpi resolution, or -dDITHERPPI specified), -dCOLORSCREEN forces the use of separate halftone screens with different angles for CMYK or RGB if halftones are needed (this produces the best-quality output); -dCOLORSCREEN=0 uses separate screens with the same frequency and angle; -dCOLORSCREEN=false forces the use of a single binary screen. The default if COLORSCREEN is not specified is to use separate screens with different angles if the device has fewer than 5 bits per color, and a single binary screen (which is never actually used under normal circumstances) on all other devices.

-dDITHERPPI=lpi
    Forces all devices to be considered high-resolution, and forces use of a halftone screen or screens with lpi lines per inch, disregarding the actual device resolution. Reasonable values for lpi are N/5 to N/20, where N is the resolution in dots per inch.

-dDOINTERPOLATE
    Turns on image interpolation for all images, improving image quality for scaled images at the expense of speed. Note that -dNOINTERPOLATE overrides -dDOINTERPOLATE if both are specified.

    -dNOINTERPOLATE does nearest neighbour scaling (Bresenham's line algorithm through the image, plotting the closest texture coord at each pixel). If we are downscaling this results in some source pixels not appearing at all in the destination. If we are upscaling, at least some source pixels cover more than one destination pixel.

    In all but special cases -dDOINTERPOLATE uses a Mitchell filter function to scale the contributions for each output pixel; upscaling, every output pixel ends up being the weighted sum of 16 input pixels, downscaling more. Every source pixel has an effect on the output pixels.

    Computationally, -dDOINTERPOLATE is much heavier work than -dNOINTERPOLATE (lots of floating point muliplies and adds for every output pixel vs simple integer additions, subtractions, and shifts).

    The exact algorithm used is from Graphics Gems 3, Chapter I.2 General Filtered Image Rescaling.

-dTextAlphaBits=n
-dGraphicsAlphaBits=n
    These options control the use of subsample antialiasing. Their use is highly recommended for producing high quality rasterizations. The subsampling box size n should be 4 for optimum output, but smaller values can be used for faster rendering. Antialiasing is enabled separately for text and graphics content. Allowed values are 1, 2 or 4.

    Note that because of the way antialiasing blends the edges of shapes into the background when they are drawn some files that rely on joining separate filled polygons together to cover an area may not render as expected with GraphicsAlphaBits at 2 or 4. If you encounter strange lines within solid areas, try rendering that file again with -dGraphicsAlphaBits=1.

-dAlignToPixels=n
    Chooses glyph alignent to integral pixel boundaries (if set to the value 1) or to subpixels (value 0). Subpixels are a smaller raster grid which is used internally for text antialiasing. The number of subpixels in a pixel usually is 2^TextAlphaBits, but this may be automatically reduced for big characters to save space in character cache.

    The parameter has no effect if -dTextAlphaBits=1. Default value is 0.

    Setting -dAlignToPixels=0 can improve rendering of poorly hinted fonts, but may impair the appearance of well-hinted fonts.

-dGridFitTT=n
    This specifies the initial value for the implementation specific user parameter GridFitTT. It controls grid fitting of True Type fonts (Sometimes referred to as "hinting", but strictly speaking the latter is a feature of Type 1 fonts). Setting this to 2 enables automatic grid fitting for True Type glyphs. The value 0 disables grid fitting. The default value is 2. For more information see the description of the user parameter GridFitTT.

-dUseCIEColor
    Set UseCIEColor in the page device dictionary, remapping device-dependent color values through a Postscript defined CIE color space. Document DeviceGray, DeviceRGB and DeviceCMYK source colors will be substituted respectively by Postscript CIEA, CIEABC and CIEDEFG color spaces. See the document GS9 Color Management for details on how this option will interact with Ghostscript's ICC-based color workflow. If accurate colors are desired, it is recommended that an ICC workflow be used.

-dNOCIE
    Substitutes DeviceGray for CIEBasedA, DeviceRGB for CIEBasedABC and CIEBasedDEF spaces and DeviceCMYK fpr CIEBasedDEFG color spaces. Useful only on very slow systems where color accuracy is less important.

-dNOSUBSTDEVICECOLORS
    This switch prevents the substitution of the ColorSpace resources (DefaultGray, DefaultRGB, and DefaultCMYK) for the DeviceGray, DeviceRGB, and DeviceCMYK color spaces. This switch is primarily useful for PDF creation using the pdfwrite device when retaining the color spaces from the original document is important.

-dNOPSICC
    Disables the automatic loading and use of an input color space that is contained in a PostScript file as DSC comments starting with the %%BeginICCProfile: comment. ICC profiles are sometimes embedded by applications to convey the exact input color space allowing better color fidelity. Since the embedded ICC profiles often use multidimensional RenderTables, color conversion may be slower than using the Default color conversion invoked when the -dUseCIEColor option is specified, therefore the -dNOPSICC option may result in improved performance at slightly reduced color fidelity.

-dNOINTERPOLATE
    Turns off image interpolation, improving performance on interpolated images at the expense of image quality. -dNOINTERPOLATE overrides -dDOINTERPOLATE.

-dNOTRANSPARENCY
    Turns off PDF 1.4 transparency, resulting in faster (but possibly incorrect) rendering of pages containing PDF 1.4 transparency and blending.

-dNO_TN5044
    Turns off the TN 5044 psuedo operators. These psuedo operators are not a part of the official Postscript specification. However they are defined in Technical Note #5044 Color Separation Conventions for PostScript Language Programs. These psuedo operators are required for some files from QuarkXPress. However some files from Corel 9 and Illustrator 88 do not operate properly if these operators are present.

-dDOPS
    Enables processing of DoPS directives in PDF files. DoPS has in fact been deprecated for some time. Use of this option is not recommended in security-conscious applications, as it increases the scope for malicious code. -dDOPS has no effect on processing of PostScript source files. Note: in releases 7.30 and earlier, processing of DoPS was always enabled.

     */
}
