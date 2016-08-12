<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\Ghostscript\Device;

use GravityMedia\Ghostscript\Process\Arguments as ProcessArguments;
use Symfony\Component\Process\ProcessBuilder;

/**
 * The PDF info device class
 *
 * This class supports the pdf_info.ps script that is contained in Ghostscript toolbin
 * (http://svn.ghostscript.com/ghostscript/trunk/gs/toolbin/).
 *
 * @package GravityMedia\Ghostscript\Devices
 */
class PdfInfo extends NoDisplay
{
    private $pdfInfoPath;

    /**
     * Create null device object
     *
     * @param ProcessBuilder $builder
     * @param ProcessArguments $arguments
     * @param string $pdfInfoPath Path to toolbin/pdf_info.ps
     */
    public function __construct(ProcessBuilder $builder, ProcessArguments $arguments, $pdfInfoPath)
    {
        parent::__construct($builder, $arguments);
        $this->pdfInfoPath = $pdfInfoPath;
    }

    /**
     * @param string $inputFile Path to PDF file to be examined
     * @return \Symfony\Component\Process\Process
     */
    public function createProcess($inputFile = null)
    {
        // the PDF file to be examined must be provided as parameter -sFile=...
        $this->setStringParameter('File', $inputFile);

        // the pdf_info.ps script will be read as input to gs
        return parent::createProcess($this->pdfInfoPath);
    }
}
