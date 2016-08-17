<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Simon Schrape <s.schrape@epubli.com>
 */

namespace GravityMedia\Ghostscript\Device;

use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\Process\Arguments;

/**
 * The PDF info device class.
 *
 * This class supports the pdf_info.ps script that is contained in Ghostscript toolbin.
 *
 * @link    http://svn.ghostscript.com/ghostscript/trunk/gs/toolbin/
 *
 * @package GravityMedia\Ghostscript\Devices
 */
class PdfInfo extends NoDisplay
{
    /**
     * The PDF info path.
     *
     * @var string
     */
    private $pdfInfoPath;

    /**
     * Create PDF info device object.
     *
     * @param Ghostscript $ghostscript
     * @param Arguments   $arguments
     * @param string      $pdfInfoPath Path to toolbin/pdf_info.ps
     */
    public function __construct(Ghostscript $ghostscript, Arguments $arguments, $pdfInfoPath)
    {
        parent::__construct($ghostscript, $arguments);

        $this->pdfInfoPath = $pdfInfoPath;
    }

    /**
     * Create process object.
     *
     * @param string $input Path to PDF file to be examined
     *
     * @throws \RuntimeException
     *
     * @return \Symfony\Component\Process\Process
     */
    public function createProcess($input = null)
    {
        if (!is_string($input) || !file_exists($input)) {
            throw new \RuntimeException('Input file does not exist');
        }

        $this->setArgument(sprintf('-sFile=%s', $input));

        return parent::createProcess($this->pdfInfoPath);
    }
}
