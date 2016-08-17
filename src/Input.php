<?php
/**
 * This file is part of the Ghostscript package.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript;

use Symfony\Component\Process\ProcessUtils;

/**
 * The input class.
 *
 * @package GravityMedia\Ghostscript
 */
class Input
{
    /**
     * The process input.
     *
     * @var null|string|resource
     */
    private $processInput;

    /**
     * The PostScript code.
     *
     * @var null|string
     */
    private $postScriptCode;

    /**
     * The files.
     *
     * @var null|string[]
     */
    private $files;

    /**
     * Get process input.
     *
     * @return null|string|resource
     */
    public function getProcessInput()
    {
        return $this->processInput;
    }

    /**
     * Set process input.
     *
     * @param mixed $processInput
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setProcessInput($processInput)
    {
        $this->processInput = ProcessUtils::validateInput(__METHOD__, $processInput);

        return $this;
    }

    /**
     * Get PostScript code.
     *
     * @return null|string
     */
    public function getPostScriptCode()
    {
        return $this->postScriptCode;
    }

    /**
     * Set PostScript code.
     *
     * @param null|string $postScriptCode
     *
     * @return $this
     */
    public function setPostScriptCode($postScriptCode)
    {
        $this->postScriptCode = $postScriptCode;

        return $this;
    }

    /**
     * Get files.
     *
     * @return string[]
     */
    public function getFiles()
    {
        if (null === $this->files) {
            return [];
        }

        return $this->files;
    }

    /**
     * Add file.
     *
     * @param string $file
     *
     * @return $this
     */
    public function addFile($file)
    {
        if (null === $this->files) {
            $this->files = [];
        }

        $this->files[] = $file;

        return $this;
    }

    /**
     * Set files.
     *
     * @param string[] $files
     *
     * @return $this
     */
    public function setFiles(array $files)
    {
        $this->files = $files;

        return $this;
    }
}
