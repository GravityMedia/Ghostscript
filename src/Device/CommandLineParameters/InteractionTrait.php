<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\Ghostscript\Device\CommandLineParameters;

/**
 * The interaction-related parameters trait.
 *
 * @package GravityMedia\Ghostscript\Device\CommandLineParameters
 *
 * @link    http://ghostscript.com/doc/current/Use.htm#Interaction_related_parameters
 */
trait InteractionTrait
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
     * Whether BATCH flag is set
     *
     * @return bool
     */
    public function isBatch()
    {
        return $this->hasArgument('-dBATCH');
    }

    /**
     * Set BATCH flag
     *
     * Causes Ghostscript to exit after processing all files named on the command line, rather than going into an
     * interactive loop reading PostScript commands. Equivalent to putting -c quit at the end of the command line.
     *
     * @return $this
     */
    public function setBatch()
    {
        $this->setArgument('-dBATCH');

        return $this;
    }

    /**
     * Whether NOPAGEPROMPT flag is set
     *
     * @return bool
     */
    public function isNoPagePrompt()
    {
        return $this->hasArgument('-dNOPAGEPROMPT');
    }

    /**
     * Set NOPAGEPROMPT flag
     *
     * Disables only the prompt, but not the pause, at the end of each page. This may be useful on PC displays that get
     * confused if a program attempts to write text to the console while the display is in a graphics mode.
     *
     * @return $this
     */
    public function setNoPagePrompt()
    {
        $this->setArgument('-dNOPAGEPROMPT');

        return $this;
    }

    /**
     * Whether NOPAUSE flag is set
     *
     * @return bool
     */
    public function isNoPause()
    {
        return $this->hasArgument('-dNOPAUSE');
    }

    /**
     * Set NOPAUSE flag
     *
     * Disables the prompt and pause at the end of each page. Normally one should use this (along with -dBATCH) when
     * producing output on a printer or to a file; it also may be desirable for applications where another program is
     * "driving" Ghostscript.
     *
     * @return $this
     */
    public function setNoPause()
    {
        $this->setArgument('-dNOPAUSE');

        return $this;
    }

    /**
     * Whether NOPROMPT flag is set
     *
     * @return bool
     */
    public function isNoPrompt()
    {
        return $this->hasArgument('-dNOPROMPT');
    }

    /**
     * Set NOPROMPT flag
     *
     * Disables the prompt printed by Ghostscript when it expects interactive input, as well as the end-of-page prompt
     * (-dNOPAGEPROMPT). This allows piping input directly into Ghostscript, as long as the data doesn't refer to
     * currentfile.
     *
     * @return $this
     */
    public function setNoPrompt()
    {
        $this->setArgument('-dNOPROMPT');

        return $this;
    }

    /**
     * Whether QUIET flag is set
     *
     * @return bool
     */
    public function isQuiet()
    {
        return $this->hasArgument('-dQUIET');
    }

    /**
     * Set QUIET flag
     *
     * Suppresses routine information comments on standard output. This is currently necessary when redirecting device
     * output to standard output.
     *
     * @return $this
     */
    public function setQuiet()
    {
        $this->setArgument('-dQUIET');

        return $this;
    }

    /**
     * Whether SHORTERRORS flag is set
     *
     * @return bool
     */
    public function isShortErrors()
    {
        return $this->hasArgument('-dSHORTERRORS');
    }

    /**
     * Set SHORTERRORS flag
     *
     * Makes certain error and information messages more Adobe-compatible.
     *
     * @return $this
     */
    public function setShortErrors()
    {
        $this->setArgument('-dSHORTERRORS');

        return $this;
    }

    /**
     * Get value of stdout parameter if set
     *
     * @return string|null
     */
    public function getStdout()
    {
        return $this->getArgumentValue('-sstdout');
    }

    /**
     * Set stdout parameter
     *
     * Redirect PostScript %stdout to a file or stderr, to avoid it being mixed with device stdout. To redirect stdout
     * to stderr use -sstdout=%stderr. To cancel redirection of stdout use -sstdout=%stdout or -sstdout=-.
     *
     * Note that this redirects PostScript output to %stdout but does not change the destination FILE of device output
     * as with -sOutputFile=- or even -sOutputFile=%stdout since devices write directly using the stdout FILE * pointer
     * with C function calls such as fwrite or fputs.
     *
     * @param string $filename file to redirect PostScript %stdout to
     *
     * @return $this
     */
    public function setStdout($filename)
    {
        $this->setArgument(sprintf('-sstdout=%s', $filename));

        return $this;
    }

    /**
     * Whether TTYPAUSE flag is set
     *
     * @return bool
     */
    public function isTtyPause()
    {
        return $this->hasArgument('-dTTYPAUSE');
    }

    /**
     * Set TTYPAUSE flag
     *
     * Causes Ghostscript to read a character from /dev/tty, rather than standard input, at the end of each page. This
     * may be useful if input is coming from a pipe. Note that -dTTYPAUSE overrides -dNOPAUSE. Also note that -dTTYPAUSE
     * requires opening the terminal device directly, and may cause problems in combination with -dSAFER. Permission
     * errors can be avoided by adding the device to the permitted reading list before invoking safer mode. For example:
     * gs -dTTYPAUSE -dDELAYSAFER -c '<< /PermitFileReading [ (/dev/tty)] >> setuserparams .locksafe' -dSAFER
     *
     * @return $this
     */
    public function setTtyPause()
    {
        $this->setArgument('-dTTYPAUSE');

        return $this;
    }
}
