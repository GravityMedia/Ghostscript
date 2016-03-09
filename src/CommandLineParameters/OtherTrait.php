<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\Ghostscript\CommandLineParameters;

/**
 * The other parameters trait
 *
 * @package GravityMedia\Ghostscript\CommandLineParameters
 * @see http://ghostscript.com/doc/current/Use.htm#Other_parameters
 */
trait OtherTrait
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

-dFILTERIMAGE
    If set, ths will ignore all images in the input (in this context image means a bitmap), these will therefore not be rendered.
-dFILTERTEXT
    If set, ths will ignore all text in the input (just because it looks like text doesn't mean it is, it might be an image), text will therefore not be rendered.
-dFILTERVECTOR
    If set, ths will ignore anything whch is neither text nor an image..

-dDELAYBIND
    Causes bind to remember all its invocations, but not actually execute them until the .bindnow procedure is called. Useful only for certain specialized packages like pstotext that redefine operators. See the documentation for .bindnow for more information on using this feature.

-dDOPDFMARKS
    Causes pdfmark to be called for bookmarks, annotations, links and cropbox when processing PDF files. Normally, pdfmark is only called for these types for PostScript files or when the output device requests it (e.g. pdfwrite device).

-dJOBSERVER
    Define \004 (^D) to start a new encapsulated job used for compatibility with Adobe PS Interpreters that ordinarily run under a job server. The -dNOOUTERSAVE switch is ignored if -dJOBSERVER is specified since job servers always execute the input PostScript under a save level, although the exitserver operator can be used to escape from the encapsulated job and execute as if the -dNOOUTERSAVE was specified.

    This also requires that the input be from stdin, otherwise an error will result (Error: /invalidrestore in --restore--).

    Example usage is:

        gs ... -dJOBSERVER - < inputfile.ps
                         -or-
        cat inputfile.ps | gs ... -dJOBSERVER -

    Note: The ^D does not result in an end-of-file action on stdin as it may on some PostScript printers that rely on TBCP (Tagged Binary Communication Protocol) to cause an out-of-band ^D to signal EOF in a stream input data. This means that direct file actions on stdin such as flushfile and closefile will affect processing of data beyond the ^D in the stream.

-dNOBIND
    Disables the bind operator. Useful only for debugging.

-dNOCACHE
    Disables character caching. Useful only for debugging.

-dNOGC
    Suppresses the initial automatic enabling of the garbage collector in Level 2 systems. (The vmreclaim operator is not disabled.) Useful only for debugging.

-dNOOUTERSAVE
    Suppresses the initial save that is used for compatibility with Adobe PS Interpreters that ordinarily run under a job server. If a job server is going to be used to set up the outermost save level, then -dNOOUTERSAVE should be used so that the restore between jobs will restore global VM as expected.

-dNOSAFER (equivalent to -dDELAYSAFER).
    This flag disables SAFER mode until the .setsafe procedure is run. This is intended for clients or scripts that cannot operate in SAFER mode. If Ghostscript is started with -dNOSAFER or -dDELAYSAFER, PostScript programs are allowed to read, write, rename or delete any files in the system that are not protected by operating system permissions.

    This mode should be used with caution, and .setsafe should be run prior to running any PostScript file with unknown contents.

-dSAFER
    Disables the deletefile and renamefile operators, and the ability to open piped commands (%pipe%cmd) at all. Only %stdout and %stderr can be opened for writing. Disables reading of files other than %stdin, those given as a command line argument, or those contained on one of the paths given by LIBPATH and FONTPATH and specified by the system params /FontResourceDir and /GenericResourceDir.

    This mode also sets the .LockSafetyParams parameter of the default device, or the device specified with the -sDEVICE= switch to protect against programs that attempt to write to files using the OutputFile device parameter. Note that since the device parameters specified on the command line (including OutputFile) are set prior to SAFER mode, the -sOutputFile=... on the command line is unrestricted.

    SAFER mode also prevents changing the /GenericResourceDir, /FontResourceDir and either the /SystemParamsPassword or the /StartJobPassword.

    Note: While SAFER mode is not the default, in a subsequent release of Ghostscript, SAFER mode will be the default thus scripts or programs that need to open files or set restricted parameters will require the -dNOSAFER command line option.

    When running -dNOSAFER it is possible to perform a save, followed by .setsafe, execute a file or procedure in SAFER mode, then use restore to return to NOSAFER mode. In order to prevent the save object from being restored by the foreign file or procedure, the .runandhide operator should be used to hide the save object from the restricted procedure.

-dPreBandThreshold=true/false
    If the target device is a halftone device, then images that are normally stored in the command list during banded output will be halftoned during the command list writing phase, if the resulting image will result in a smaller command list. The decision to halftone depends upon the output and source resolution as well as the output and source color space.

-dSTRICT
    Disables as many Ghostscript extensions as feasible, to be more helpful in debugging applications that produce output for Adobe and other RIPs.

-dWRITESYSTEMDICT
    Leaves systemdict writable. This is necessary when running special utility programs such as font2c and pcharstr, which must bypass normal PostScript access protection.

     */
}
