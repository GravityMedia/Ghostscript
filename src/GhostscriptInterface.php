<?php
/**
 * This file is part of the Ghostscript package.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript;

use GravityMedia\Ghostscript\Device\BoundingBoxInfo;
use GravityMedia\Ghostscript\Device\Inkcov;
use GravityMedia\Ghostscript\Device\NoDisplay;
use GravityMedia\Ghostscript\Device\PdfInfo;
use GravityMedia\Ghostscript\Device\PdfWrite;

/**
 * @package GravityMedia\Ghostscript
 */
interface GhostscriptInterface
{
    /**
     * Get option.
     *
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getOption($name, $default = null);

    /**
     * Get version.
     *
     * @return string
     * @throws \RuntimeException
     *
     */
    public function getVersion();

    /**
     * Create PDF device object.
     *
     * @param null|string $outputFile
     *
     * @return PdfWrite
     */
    public function createPdfDevice($outputFile = null);

    /**
     * Create no display device object.
     *
     * @return NoDisplay
     */
    public function createNoDisplayDevice();

    /**
     * Create PDF info device object.
     *
     * @param string $pdfInfoPath Path to toolbin/pdf_info.ps
     *
     * @return PdfInfo
     */
    public function createPdfInfoDevice($pdfInfoPath);

    /**
     * Create bounding box info device object.
     *
     * @return BoundingBoxInfo
     */
    public function createBoundingBoxInfoDevice();

    /**
     * Create inkcov device object
     *
     * @return Inkcov
     */
    public function createInkcovDevice();
}
