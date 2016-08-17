<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\Ghostscript\Device\CommandLineParameters;

/**
 * The other parameters trait.
 *
 * @package GravityMedia\Ghostscript\Device\CommandLineParameters
 *
 * @link    http://ghostscript.com/doc/current/Use.htm#Other_parameters
 */
trait OtherTrait
{
    /**
     * Whether argument is set
     *
     * @param string $name
     *
     * @return bool
     */
    abstract protected function hasArgument($name);

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
     * Whether FILTERIMAGE flag is set
     *
     * @return bool
     */
    public function isFilterImage()
    {
        return $this->hasArgument('-dFILTERIMAGE');
    }

    /**
     * Set FILTERIMAGE flag
     *
     * If set, ths will ignore all images in the input (in this context image means a bitmap), these will therefore not
     * be rendered.
     *
     * @return $this
     */
    public function setFilterImage()
    {
        $this->setArgument('-dFILTERIMAGE');

        return $this;
    }

    /**
     * Whether FILTERTEXT flag is set
     *
     * @return bool
     */
    public function isFilterText()
    {
        return $this->hasArgument('-dFILTERTEXT');
    }

    /**
     * Set FILTERTEXT flag
     *
     * If set, ths will ignore all text in the input (just because it looks like text doesn't mean it is, it might be an
     * image), text will therefore not be rendered.
     *
     * @return $this
     */
    public function setFilterText()
    {
        $this->setArgument('-dFILTERTEXT');

        return $this;
    }

    /**
     * Whether FILTERVECTOR flag is set
     *
     * @return bool
     */
    public function isFilterVector()
    {
        return $this->hasArgument('-dFILTERVECTOR');
    }

    /**
     * Set FILTERVECTOR flag
     *
     * If set, ths will ignore anything whch is neither text nor an image.
     *
     * @return $this
     */
    public function setFilterVector()
    {
        $this->setArgument('-dFILTERVECTOR');

        return $this;
    }

    /**
     * Whether DELAYBIND flag is set
     *
     * @return bool
     */
    public function isDelayBind()
    {
        return $this->hasArgument('-dDELAYBIND');
    }

    /**
     * Set DELAYBIND flag
     *
     * Causes bind to remember all its invocations, but not actually execute them until the .bindnow procedure is
     * called. Useful only for certain specialized packages like pstotext that redefine operators. See the documentation
     * for .bindnow for more information on using this feature.
     *
     * @return $this
     */
    public function setDelayBind()
    {
        $this->setArgument('-dDELAYBIND');

        return $this;
    }

    /**
     * Whether DOPDFMARKS flag is set
     *
     * @return bool
     */
    public function isDoPdfMarks()
    {
        return $this->hasArgument('-dDOPDFMARKS');
    }

    /**
     * Set DOPDFMARKS flag
     *
     * Causes pdfmark to be called for bookmarks, annotations, links and cropbox when processing PDF files. Normally,
     * pdfmark is only called for these types for PostScript files or when the output device requests it (e.g. pdfwrite
     * device).
     *
     * @return $this
     */
    public function setDoPdfMarks()
    {
        $this->setArgument('-dDOPDFMARKS');

        return $this;
    }

    /**
     * Whether JOBSERVER flag is set
     *
     * @return bool
     */
    public function isJobServer()
    {
        return $this->hasArgument('-dJOBSERVER');
    }

    /**
     * Set JOBSERVER flag
     *
     * Define \004 (^D) to start a new encapsulated job used for compatibility with Adobe PS Interpreters that
     * ordinarily run under a job server. The -dNOOUTERSAVE switch is ignored if -dJOBSERVER is specified since job
     * servers always execute the input PostScript under a save level, although the exitserver operator can be used to
     * escape from the encapsulated job and execute as if the -dNOOUTERSAVE was specified.
     *
     * This also requires that the input be from stdin, otherwise an error will result
     * (Error: /invalidrestore in --restore--).
     *
     * Example usage is:
     *
     * gs ... -dJOBSERVER - < inputfile.ps
     * -or-
     * cat inputfile.ps | gs ... -dJOBSERVER -
     *
     * Note: The ^D does not result in an end-of-file action on stdin as it may on some PostScript printers that rely on
     * TBCP (Tagged Binary Communication Protocol) to cause an out-of-band ^D to signal EOF in a stream input data. This
     * means that direct file actions on stdin such as flushfile and closefile will affect processing of data beyond the
     * ^D in the stream.
     *
     * @return $this
     */
    public function setJobServer()
    {
        $this->setArgument('-dJOBSERVER');

        return $this;
    }

    /**
     * Whether NOBIND flag is set
     *
     * @return bool
     */
    public function isNoBind()
    {
        return $this->hasArgument('-dNOBIND');
    }

    /**
     * Set NOBIND flag
     *
     * Disables the bind operator. Useful only for debugging.
     *
     * @return $this
     */
    public function setNoBind()
    {
        $this->setArgument('-dNOBIND');

        return $this;
    }

    /**
     * Whether NOCACHE flag is set
     *
     * @return bool
     */
    public function isNoCache()
    {
        return $this->hasArgument('-dNOCACHE');
    }

    /**
     * Set NOCACHE flag
     *
     * Disables character caching. Useful only for debugging.
     *
     * @return $this
     */
    public function setNoCache()
    {
        $this->setArgument('-dNOCACHE');

        return $this;
    }

    /**
     * Whether NOGC flag is set
     *
     * @return bool
     */
    public function isNoGc()
    {
        return $this->hasArgument('-dNOGC');
    }

    /**
     * Set NOGC flag
     *
     * Suppresses the initial automatic enabling of the garbage collector in Level 2 systems. (The vmreclaim operator is
     * not disabled.) Useful only for debugging.
     *
     * @return $this
     */
    public function setNoGc()
    {
        $this->setArgument('-dNOGC');

        return $this;
    }

    /**
     * Whether NOOUTERSAVE flag is set
     *
     * @return bool
     */
    public function isNoOuterSave()
    {
        return $this->hasArgument('-dNOOUTERSAVE');
    }

    /**
     * Set NOOUTERSAVE flag
     *
     * Suppresses the initial save that is used for compatibility with Adobe PS Interpreters that ordinarily run under a
     * job server. If a job server is going to be used to set up the outermost save level, then -dNOOUTERSAVE should be
     * used so that the restore between jobs will restore global VM as expected.
     *
     * @return $this
     */
    public function setNoOuterSave()
    {
        $this->setArgument('-dNOOUTERSAVE');

        return $this;
    }

    /**
     * Whether NOSAFER flag is set
     *
     * @return bool
     */
    public function isNoSafer()
    {
        return $this->hasArgument('-dNOSAFER');
    }

    /**
     * Set NOSAFER flag (equivalent to DELAYSAFER)
     *
     * This flag disables SAFER mode until the .setsafe procedure is run. This is intended for clients or scripts that
     * cannot operate in SAFER mode. If Ghostscript is started with -dNOSAFER or -dDELAYSAFER, PostScript programs are
     * allowed to read, write, rename or delete any files in the system that are not protected by operating system
     * permissions.
     *
     * This mode should be used with caution, and .setsafe should be run prior to running any PostScript file with
     * unknown contents.
     *
     * @return $this
     */
    public function setNoSafer()
    {
        $this->setArgument('-dNOSAFER');

        return $this;
    }

    /**
     * Whether SAFER flag is set
     *
     * @return bool
     */
    public function isSafer()
    {
        return $this->hasArgument('-dSAFER');
    }

    /**
     * Set SAFER flag
     *
     * Disables the deletefile and renamefile operators, and the ability to open piped commands (%pipe%cmd) at all. Only
     * %stdout and %stderr can be opened for writing. Disables reading of files other than %stdin, those given as a
     * command line argument, or those contained on one of the paths given by LIBPATH and FONTPATH and specified by the
     * system params /FontResourceDir and /GenericResourceDir.
     *
     * This mode also sets the .LockSafetyParams parameter of the default device, or the device specified with the
     * -sDEVICE= switch to protect against programs that attempt to write to files using the OutputFile device
     * parameter. Note that since the device parameters specified on the command line (including OutputFile) are set
     * prior to SAFER mode, the -sOutputFile=... on the command line is unrestricted.
     *
     * SAFER mode also prevents changing the /GenericResourceDir, /FontResourceDir and either the /SystemParamsPassword
     * or the /StartJobPassword.
     *
     * Note: While SAFER mode is not the default, in a subsequent release of Ghostscript, SAFER mode will be the default
     * thus scripts or programs that need to open files or set restricted parameters will require the -dNOSAFER command
     * line option.
     *
     * When running -dNOSAFER it is possible to perform a save, followed by .setsafe, execute a file or procedure in
     * SAFER mode, then use restore to return to NOSAFER mode. In order to prevent the save object from being restored
     * by the foreign file or procedure, the .runandhide operator should be used to hide the save object from the
     * restricted procedure.
     *
     * @return $this
     */
    public function setSafer()
    {
        $this->setArgument('-dSAFER');

        return $this;
    }

    /**
     * Whether PreBandThreshold flag is true
     *
     * @return bool
     */
    public function isPreBandThreshold()
    {
        $value = $this->getArgumentValue('-dPreBandThreshold');
        if (null === $value) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set PreBandThreshold flag
     *
     * If the target device is a halftone device, then images that are normally stored in the command list during banded
     * output will be halftoned during the command list writing phase, if the resulting image will result in a smaller
     * command list. The decision to halftone depends upon the output and source resolution as well as the output and
     * source color space.
     *
     * @param bool $preBandThreshold
     *
     * @return $this
     */
    public function setPreBandThreshold($preBandThreshold)
    {
        $this->setArgument(sprintf('-dPreBandThreshold=%s', $preBandThreshold ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether STRICT flag is set
     *
     * @return bool
     */
    public function isStrict()
    {
        return $this->hasArgument('-dSTRICT');
    }

    /**
     * Set STRICT flag
     *
     * Disables as many Ghostscript extensions as feasible, to be more helpful in debugging applications that produce
     * output for Adobe and other RIPs.
     *
     * @return $this
     */
    public function setStrict()
    {
        $this->setArgument('-dSTRICT');

        return $this;
    }

    /**
     * Whether WRITESYSTEMDICT flag is set
     *
     * @return bool
     */
    public function isWriteSystemDict()
    {
        return $this->hasArgument('-dWRITESYSTEMDICT');
    }

    /**
     * Set WRITESYSTEMDICT flag
     *
     * Leaves systemdict writable. This is necessary when running special utility programs such as font2c and pcharstr,
     * which must bypass normal PostScript access protection.
     *
     * @return $this
     */
    public function setWriteSystemDict()
    {
        $this->setArgument('-dWRITESYSTEMDICT');

        return $this;
    }
}
