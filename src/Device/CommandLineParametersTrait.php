<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\Ghostscript\Device;

/**
 * The general Ghostscript command line parameters trait
 *
 * @package GravityMedia\Ghostscript
 *
 * @link    http://ghostscript.com/doc/current/Use.htm#General_switches
 */
trait CommandLineParametersTrait
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

Input control

@filename
    Causes Ghostscript to read filename and treat its contents the same as the command line. (This was intended primarily for getting around DOS's 128-character limit on the length of a command line.) Switches or file names in the file may be separated by any amount of white space (space, tab, line break); there is no limit on the size of the file.

-- filename arg1 ...
-+ filename arg1 ...
    Takes the next argument as a file name as usual, but takes all remaining arguments (even if they have the syntactic form of switches) and defines the name ARGUMENTS in userdict (not systemdict) as an array of those strings, before running the file. When Ghostscript finishes executing the file, it exits back to the shell.

-@ filename arg1 ...
    Does the same thing as -- and -+, but expands @filename arguments.

-
-_
    These are not really switches: they tell Ghostscript to read from standard input, which is coming from a file or a pipe, with or without buffering. On some systems, Ghostscript may read the input one character at a time, which is useful for programs such as ghostview that generate input for Ghostscript dynamically and watch for some response, but can slow processing. If performance is significantly slower than with a named file, try '-_' which always reads the input in blocks. However, '-' is equivalent on most systems.

-c token ...
-c string ...
    Interprets arguments as PostScript code up to the next argument that begins with "-" followed by a non-digit, or with "@". For example, if the file quit.ps contains just the word "quit", then -c quit on the command line is equivalent to quit.ps there. Each argument must be valid PostScript, either individual tokens as defined by the token operator, or a string containing valid PostScript.

-f
    Interprets following non-switch arguments as file names to be executed using the normal run command. Since this is the default behavior, -f is useful only for terminating the list of tokens for the -c switch.

-ffilename
    Execute the given file, even if its name begins with a "-" or "@".

File searching

Note that by "library files" here we mean all the files identified using the search rule under "How Ghostscript finds files" above: Ghostscript's own initialization files, fonts, and files named on the command line.

-Idirectories
-I directories
    Adds the designated list of directories at the head of the search path for library files.

-P
    Makes Ghostscript look first in the current directory for library files.

-P-
    Makes Ghostscript not look first in the current directory for library files (unless, of course, the first explicitly supplied directory is "."). This is now the default.

Setting parameters

-Dname
-dname
    Define a name in systemdict with value=true.

-Dname=token
-dname=token
    Define a name in systemdict with the given value. The value must be a valid PostScript token (as defined by the token operator). If the token is a non-literal name, it must be true, false, or null. It is recommeded that this is used only for simple values -- use -c (above) for complex values such as procedures, arrays or dictionaries.
    Note that these values are defined before other names in systemdict, so any name that that conflicts with one usually in systemdict will be replaced by the normal definition during the interpreter initialization.

-Sname=string
-sname=string
    Define a name in systemdict with a given string as value. This is different from -d. For example, -dXYZ=35 on the command line is equivalent to the program fragment

        /XYZ 35 def

    whereas -sXYZ=35 is equivalent to

        /XYZ (35) def

-uname
    Un-define a name, cancelling -d or -s.

Note that the initialization file gs_init.ps makes systemdict read-only, so the values of names defined with -D, -d, -S, and -s cannot be changed -- although, of course, they can be superseded by definitions in userdict or other dictionaries. However, device parameters set this way (PageSize, Margins, etc.) are not read-only, and can be changed by code in PostScript files.

-gnumber1xnumber2
    Equivalent to -dDEVICEWIDTH=number1 and -dDEVICEHEIGHT=number2, specifying the device width and height in pixels for the benefit of devices such as X11 windows and VESA displays that require (or allow) you to specify width and height. Note that this causes documents of other sizes to be clipped, not scaled: see -dFIXEDMEDIA below.

-rnumber (same as -rnumberxnumber)
-rnumber1xnumber2
    Equivalent to -dDEVICEXRESOLUTION=number1 and -dDEVICEYRESOLUTION=number2, specifying the device horizontal and vertical resolution in pixels per inch for the benefit of devices such as printers that support multiple X and Y resolutions.

Suppress messages

-q
    Quiet startup: suppress normal startup messages, and also do the equivalent of -dQUIET.

     */
}
