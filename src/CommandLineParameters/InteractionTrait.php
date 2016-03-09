<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\Ghostscript\CommandLineParameters;

/**
 * The interaction-related parameters trait
 *
 * @package GravityMedia\Ghostscript\CommandLineParameters
 * @see http://ghostscript.com/doc/current/Use.htm#Interaction_related_parameters
 */
trait InteractionTrait
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

-dBATCH
    Causes Ghostscript to exit after processing all files named on the command line, rather than going into an interactive loop reading PostScript commands. Equivalent to putting -c quit at the end of the command line.

-dNOPAGEPROMPT
    Disables only the prompt, but not the pause, at the end of each page. This may be useful on PC displays that get confused if a program attempts to write text to the console while the display is in a graphics mode.

-dNOPAUSE
    Disables the prompt and pause at the end of each page. Normally one should use this (along with -dBATCH) when producing output on a printer or to a file; it also may be desirable for applications where another program is "driving" Ghostscript.

-dNOPROMPT
    Disables the prompt printed by Ghostscript when it expects interactive input, as well as the end-of-page prompt (-dNOPAGEPROMPT). This allows piping input directly into Ghostscript, as long as the data doesn't refer to currentfile.

-dQUIET
    Suppresses routine information comments on standard output. This is currently necessary when redirecting device output to standard output.

-dSHORTERRORS
    Makes certain error and information messages more Adobe-compatible.

-sstdout=filename
    Redirect PostScript %stdout to a file or stderr, to avoid it being mixed with device stdout. To redirect stdout to stderr use -sstdout=%stderr. To cancel redirection of stdout use -sstdout=%stdout or -sstdout=-.

    Note that this redirects PostScript output to %stdout but does not change the destination FILE of device output as with -sOutputFile=- or even -sOutputFile=%stdout since devices write directly using the stdout FILE * pointer with C function calls such as fwrite or fputs.

-dTTYPAUSE
    Causes Ghostscript to read a character from /dev/tty, rather than standard input, at the end of each page. This may be useful if input is coming from a pipe. Note that -dTTYPAUSE overrides -dNOPAUSE. Also note that -dTTYPAUSE requires opening the terminal device directly, and may cause problems in combination with -dSAFER. Permission errors can be avoided by adding the device to the permitted reading list before invoking safer mode. For example: gs -dTTYPAUSE -dDELAYSAFER -c '<< /PermitFileReading [ (/dev/tty)] >> setuserparams .locksafe' -dSAFER

     */
}
