<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest;

use GravityMedia\Ghostscript\Input;
use PHPUnit\Framework\TestCase;

/**
 * The input test class
 *
 * @package GravityMedia\GhostscriptTest
 *
 * @covers  \GravityMedia\Ghostscript\Input
 */
class InputTest extends TestCase
{
    public function testDefaultInput()
    {
        $input = new Input();

        $this->assertNull($input->getProcessInput());
        $this->assertNull($input->getPostScriptCode());
        $this->assertContainsOnly('array', $input->getFiles());
        $this->assertCount(0, $input->getFiles());
    }

    public function testInput()
    {
        $input = new Input();
        $input->setProcessInput('input');
        $input->setPostScriptCode('.setpdfwrite');
        $input->addFile('/path/to/output/file.pdf');
        $input->setFiles(['/path/to/output/file.pdf']);

        $this->assertSame('input', $input->getProcessInput());
        $this->assertSame('.setpdfwrite', $input->getPostScriptCode());
        $this->assertContainsOnly('string', $input->getFiles());
        $this->assertCount(1, $input->getFiles());
    }
}
