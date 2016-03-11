<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\Ghostscript\CommandLineParameters;

/**
 * The resource-related parameters trait
 *
 * @package GravityMedia\Ghostscript\CommandLineParameters
 * @link http://ghostscript.com/doc/current/Use.htm#Resource_related_parameters
 */
trait ResourceTrait
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

-sGenericResourceDir=path
    Specifies a path to resource files. The value is platform dependent. It must end with a directory separator.

    A note for Windows users, Artifex recommends the use of the forward slash delimiter due to the special interpretation of \" by the Microsoft C startup code. See Parsing C Command-Line Arguments for more information.

    Adobe specifies GenericResourceDir to be an absolute path to a single resource directory. Ghostscript instead maintains multiple resource directories and uses an extended method for finding resources, which is explained in "Finding PostScript Level 2 resources".

    Due to the extended search method, Ghostscript uses GenericResourceDir only as a default directory for resources being not installed. Therefore GenericResourceDir may be considered as a place where new resources to be installed. The default implementation of the function ResourceFileName uses GenericResourceDir when (1) it is an absolute path, or (2) the resource file is absent. The extended search method does not call ResourceFileName .

    Default value is (./Resource/) for Unix, and an equivalent one on other platforms.

-sFontResourceDir=path
    Specifies a path where font files are installed. It's meaning is similar to GenericResourceDir.

    Default value is (./Font/) for Unix, and an equivalent one on other platforms.

     */
}
