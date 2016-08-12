<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\Ghostscript\Device\CommandLineParameters;

/**
 * The ICC color parameters trait
 *
 * @package GravityMedia\Ghostscript\Device\CommandLineParameters
 *
 * @link    http://ghostscript.com/doc/current/Use.htm#ICC_color_parameters
 */
trait IccColorTrait
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
     * -sDefaultGrayProfile=filename
     *     Set the ICC profile that will be associated with undefined device gray color spaces. If this is not set, the
     *     profile file name "default_gray.icc" will be used as the default.
     *
     * -sDefaultRGBProfile=filename
     *     Set the ICC profile that will be associated with undefined device RGB color spaces. If this is not set, the
     *     profile file name "default_rgb.icc" will be used as the default.
     *
     * -sDefaultCMYKProfile=filename
     *     Set the ICC profile that will be associated with undefined device CMYK color spaces. If this is not set, the
     *     profile file name "default_cmyk.icc" will be used as the default.
     *
     * -sDeviceNProfile=filename
     *     Associate a DeviceN color space contained in a PS or PDF document with an ICC profile. Note that neither PS
     *     nor PDF provide in-document ICC profile definitions for DeviceN color spaces. With this interface it is
     *     possible to provide this definition. The colorants tag order in the ICC profile defines the lay-down order
     *     of the inks associated with the profile. A windows-based tool for creating these source profiles is
     *     contained in ./toolbin/color/icc_creator.
     *
     * -sOutputICCProfile=filename
     *     Set the ICC profile that will be associated with the output device. Care should be taken to ensure that the
     *     number of colorants associated with the device is the same as the profile. If this is not set, an
     *     appropriate profile (i.e. one with the proper number of colorants) will be selected from those in the
     *     directory specified by ICCProfilesDir (see below). Note that if the output device is CMYK + spot colorants,
     *     a CMYK profile can be used to provide color management for the CMYK colorants only. In this case, spot
     *     colors will pass through unprocessed assuming the device supports those colorants. It is also possible for
     *     these devices to specify NCLR ICC profiles for output.
     *
     * -sICCOutputColors="Cyan, Magenta, Yellow, Black, Orange, Violet"
     *     For the psdcmyk and tiffsep separation devices, the device ICC profile can be an NCLR profile, which means
     *     something that includes non-traditional inks like Orange, Violet, etc. In this case, the list of the
     *     colorant names in the order that they exist in the profile must be provided with this command line option.
     *     Note that if a colorant name that is specified for the profile occurs also within the document (e.g.
     *     "Orange" above), then these colorants will be associated with the same separation. It is possible through a
     *     compile time option LIMIT_TO_ICC defined in gdevdevn.h to restrict the output colorants of the psdcmyk and
     *     tiffsep device to the colorants of the ICC profile or to allow additional spot colorants in the document to
     *     be created as different separations. If restricted, the other spot colorants will go through the alternate
     *     tint transform and then be mapped to the color space defined by the NCLR profile. If an NCLR ICC profile is
     *     specified and ICCOutputColors is not used, then a set of default names will be used for the extra colorants
     *     (non-CMYK) in the profile.
     *
     * -sProofProfile=filename
     *     Enable the specificiation of a proofing profile that will make the color management system link multiple
     *     profiles together to emulate the device defined by the proofing profile. See the document GS9 Color
     *     Management for details about this option.
     *
     * -sDeviceLinkProfile=filename
     *     Define a device link profile. This profile is used following the output device profile. Care should be taken
     *     to ensure that the output device process color model is the same as the output color space for the device
     *     link profile. In addition, the color space of the OutputICCProfile should match the input color space of the
     *     device link profile. For example, the following would be a valid specification -sDEVICE=tiff32nc
     *     -sOutputICCProfile=srgb.icc -sDeviceLinkProfile=linkRGBtoCMYK.icc. In this case, the output device's color
     *     model is CMYK (tiff32nc) and the colors are mapped through sRGB and through a devicelink profile that maps
     *     sRGB to CMYK values. See the document GS9 Color Management for details about this option.
     *
     * -sNamedProfile=filename
     *     Define a structure that is to be used by the color management module (CMM) to provide color management of
     *     named colors. While the ICC does define a named color format, this structure can in practice be much more
     *     general. Many developers wish to use their own proprietary-based format for spot color management. This
     *     command option is for developer use when an implementation for named color management is designed for the
     *     function gsicc_transform_named_color located in gsicccache.c . An example implementation is currently
     *     contained in the code for the handling of both Separation and DeviceN colors. For the general user this
     *     command option should really not be used.
     *
     * -dRenderIntent=0/1/2/3
     *     Set the rendering intent that should be used with the profile specified above by -sOutputICCProfile. The
     *     options 0, 1, 2, and 3 correspond to the ICC intents of Perceptual, Colorimetric, Saturation, and Absolute
     *     Colorimetric.
     *
     * -dBlackPtComp=0/1
     *     Specify if black point compensation should be used with the profile specified above by -sOutputICCProfile.
     *
     * -dKPreserve=0/1/2
     *     Specify if black preservation should be used when mapping from CMYK to CMYK. When using littleCMS as the
     *     CMM, the code 0 corresponds to no preservation, 1 corresponds to the PRESERVE_K_ONLY approach described in
     *     the littleCMS documentation and 2 corresponds to the PRESERVE_K_PLANE approach. This is only valid when
     *     using littleCMS for color management.
     *
     * -sGraphicICCProfile=filename
     *     Set the ICC profile that will be associated with the output device for vector-based graphics (e.g. Fill,
     *     Stroke operations). Care should be taken to ensure that the number of colorants associated with the device
     *     is the same as the profile. This can be used to obtain more saturated colors for graphics.
     *
     * -dGraphicIntent=0/1/2/3
     *     Set the rendering intent that should be used with graphic objects. The options are the same as specified for
     *     -dRenderIntent.
     *
     * -dGraphicBlackPt=0/1
     *     Specify if black point compensation should be used for graphic objects.
     *
     * -dGraphicKPreserve=0/1/2
     *     Specify if black preservation should be used when mapping from CMYK to CMYK for graphic objects. The options
     *     are the same as specified for -dKPreserve.
     *
     * -sImageICCProfile=filename
     *     Set the ICC profile that will be associated with the output device for images. Care should be taken to
     *     ensure that the number of colorants associated with the device is the same as the profile. This can be used
     *     to obtain perceptually pleasing images.
     *
     * -dImageIntent=0/1/2/3
     *     Set the rendering intent that should be used for images.
     *
     * -dImageBlackPt=0/1
     *     Specify if black point compensation should be used with images.
     *
     * -dImageKPreserve=0/1/2
     *     Specify if black preservation should be used when mapping from CMYK to CMYK for image objects. The options
     *     are the same as specified for -dKPreserve.
     *
     * -sTextICCProfile=filename
     *     Set the ICC profile that will be associated with the output device for text. Care should be taken to ensure
     *     that the number of colorants associated with the device is the same as the profile. This can be used ensure
     *     K only text.
     *
     * -dTextIntent=0/1/2/3
     *     Set the rendering intent that should be used text objects. The options are the same as specified for
     *     -dRenderIntent.
     *
     * -dTextBlackPt=0/1
     *     Specify if black point compensation should be used with text objects.
     *
     * -dTextKPreserve=0/1/2
     *     Specify if black preservation should be used when mapping from CMYK to CMYK for text objects. The options
     *     are the same as specified for -dKPreserve.
     *
     * -dOverrideICC
     *     Override any ICC profiles contained in the source document with the profiles specified by
     *     sDefaultGrayProfile, sDefaultRGBProfile, sDefaultCMYKProfile. Note that if no profiles are specified for the
     *     default Device color spaces, then the system default profiles will be used. For detailed override control in
     *     the specification of source colors see SourceObjectICC.
     *
     * -sSourceObjectICC=filename
     *     This option provides an extreme level of override control to specify the source color spaces and rendering
     *     intents to use with graphics, images and text for both RGB and CMYK source objects. The specification is
     *     made through a file that contains on a line a key name to specify the object type (e.g. Image_CMYK) followed
     *     by an ICC profile file name, a rendering intent number (0 for perceptual, 1 for colorimetric, 2 for
     *     saturation, 3 for absolute colorimetric) and information for black point compensation, black preservation,
     *     and source ICC override. It is also possible to turn off color management for certain object types, use
     *     device link profiles for object types and do custom color replacements. An example file is given in
     *     ./gs/toolbin/color/src_color/objsrc_profiles_example.txt. Profiles to demonstrate this method of
     *     specification are also included in this folder. Note that if objects are colorimetrically specified through
     *     this mechanism other operations like -dImageIntent, -dOverrideICC, have no affect. See further details in
     *     the document GS9 Color Management.
     *
     * -dDeviceGrayToK=true/false
     *     By default, Ghostscript will map DeviceGray color spaces to pure K when the output device is CMYK based.
     *     This may not always be desired. In particular, it may be desired to map from the gray ICC profile specified
     *     by -sDefaultGrayProfile to the output device profile. To achieve this, one should specify
     *     -dDeviceGrayToK=false.
     *
     * -dUseFastColor=true/false
     *     This is used to avoid the use of ICC profiles for source colors that are defined by DeviceGray, DeviceRGB
     *     and DeviceCMYK definitions. With UseFastColor set to true, the traditional Postscript 255 minus operations
     *     are used to convert between RGB and CMYK with black generation and undercolor removal mappings.
     *
     * -dSimulateOverprint=true/false
     *     This option enables continous tone CMYK devices (e.g. tiff32nc) the capability to provide a simulation of
     *     spot color overprinting. The default setting is true. Note that not all spot color overprint cases can be
     *     accurately simulated with a CMYK only device. For example, a case where you have a spot color overprinted
     *     with CMYK colors will be indistiguishable from a case where you have spot color equivalent CMYK colorants
     *     overprinted with CMYK colors, even though they may need to show significantly different overprint
     *     simulations. To obtain a full overprint simulation, use the psdcmyk or tiffsep device, where the spot colors
     *     are kept in their own individual planes.
     *
     * -dUsePDFX3Profile=int
     *     This option enables rendering with an output intent defined in the PDF source file. If this option is
     *     included in the command line, source device color values (e.g DeviceCMYK, DeviceRGB, or DeviceGray) that
     *     match the color model of the output intent will be interpreted to be in the output intent color space. In
     *     addition, if the output device color model matches the output intent color model, then the destination ICC
     *     profile will be the output intent ICC profile. If there is a mismatch between the device color model and the
     *     output intent, the output intent profile will be used as a proofing profile, since that is the intended
     *     rendering. Note that a PDF document can have multiple rendering intents per the PDF specification. As such,
     *     with the option -dUsePDFX3Profile the first output intent encountered will be used. It is possible to
     *     specify a particular output intent where int is an integer (a value of 0 is the same as not specifying a
     *     number). Probing of the output intents for a particular file is possible using extractICCprofiles.ps in
     *     ./gs/toolbin. Finally, note that the ICC profile member entry is an option in the output intent dictionary.
     *     In these cases, the output intent specifies a registry and a standard profile (e.g. Fogra39). Ghostscript
     *     will not make use of these output intents. Instead, if desired, these standard profiles should be used with
     *     the commands specified above (e.g. -sOutputICCProfile).
     *
     * -sICCProfilesDir=path
     *     Set a directory in which to search for the above profiles. The directory path must end with a file system
     *     delimiter.
     *
     *     If the user doesn't use the -sICCProfilesDir= command line option, Ghostscript creates a default value for
     *     it by looking on the directory paths explained in How Ghostscript finds files. If the current directory is
     *     the first path a test is made for the iccprofiles directory. Next, the remaining paths with the string
     *     Resource in it are tested. The prefix up to the path separator character preceding the string Resource,
     *     concatenated with the string iccprofiles is used and if this exists, then this path will be used for
     *     ICCProfilesDir.
     *
     *     Note that if the build is performed with COMPILE_INITS=1, then the profiles contained in gs/iccprofiles will
     *     be placed in the ROM file system. If a directory is specified on the command line using -sICCProfilesDir=,
     *     that directory is searched before the iccprofiles/ directory of the ROM file system is searched.
     */
}
