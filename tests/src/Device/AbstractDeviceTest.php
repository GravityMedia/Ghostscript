<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Device;

use GravityMedia\Ghostscript\Device\AbstractDevice;
use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\Input;
use GravityMedia\Ghostscript\Process\Argument;
use GravityMedia\Ghostscript\Process\Arguments as ProcessArguments;

/**
 * The abstract device test class
 *
 * @package GravityMedia\GhostscriptTest\Devices
 *
 * @covers  \GravityMedia\Ghostscript\Device\AbstractDevice
 *
 * @uses    \GravityMedia\Ghostscript\Ghostscript
 * @uses    \GravityMedia\Ghostscript\Input
 * @uses    \GravityMedia\Ghostscript\Device\CommandLineParameters\EpsTrait
 * @uses    \GravityMedia\Ghostscript\Device\CommandLineParameters\FontTrait
 * @uses    \GravityMedia\Ghostscript\Device\CommandLineParameters\IccColorTrait
 * @uses    \GravityMedia\Ghostscript\Device\CommandLineParameters\InteractionTrait
 * @uses    \GravityMedia\Ghostscript\Device\CommandLineParameters\OtherTrait
 * @uses    \GravityMedia\Ghostscript\Device\CommandLineParameters\OutputSelectionTrait
 * @uses    \GravityMedia\Ghostscript\Device\CommandLineParameters\PageTrait
 * @uses    \GravityMedia\Ghostscript\Device\CommandLineParameters\RenderingTrait
 * @uses    \GravityMedia\Ghostscript\Device\CommandLineParameters\ResourceTrait
 * @uses    \GravityMedia\Ghostscript\Process\Argument
 * @uses    \GravityMedia\Ghostscript\Process\Arguments
 */
class AbstractDeviceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param array $arguments
     *
     * @return AbstractDevice
     */
    protected function createDevice(array $arguments = [])
    {
        $ghostscript = new Ghostscript();
        $processArguments = new ProcessArguments();
        $processArguments->setArguments($arguments);

        return $this->getMockForAbstractClass(AbstractDevice::class, [$ghostscript, $processArguments]);
    }

    public function testArgumentGetter()
    {
        $device = $this->createDevice(['-dFoo=/Bar']);
        $method = new \ReflectionMethod(AbstractDevice::class, 'getArgument');
        $method->setAccessible(true);

        $this->assertNull($method->invoke($device, '-dBaz'));

        /** @var \GravityMedia\Ghostscript\Process\Argument $argument */
        $argument = $method->invoke($device, '-dFoo');
        $this->assertInstanceOf(Argument::class, $argument);
        $this->assertSame('/Bar', $argument->getValue());
    }

    public function testArgumentTester()
    {
        $device = $this->createDevice(['-dFoo=/Bar']);
        $method = new \ReflectionMethod(AbstractDevice::class, 'hasArgument');
        $method->setAccessible(true);

        $this->assertFalse($method->invoke($device, '-dBar'));
        $this->assertTrue($method->invoke($device, '-dFoo'));
    }

    public function testArgumentValueGetter()
    {
        $device = $this->createDevice(['-dFoo=/Bar']);
        $method = new \ReflectionMethod(AbstractDevice::class, 'getArgumentValue');
        $method->setAccessible(true);

        $this->assertNull($method->invoke($device, '-dBaz'));
        $this->assertSame('/Bar', $method->invoke($device, '-dFoo'));
    }

    public function testArgumentSetter()
    {
        $ghostscript = new Ghostscript();
        $processArguments = new ProcessArguments();

        /** @var AbstractDevice $device */
        $device = $this->getMockForAbstractClass(AbstractDevice::class, [$ghostscript, $processArguments]);

        $method = new \ReflectionMethod(AbstractDevice::class, 'setArgument');
        $method->setAccessible(true);
        $method->invoke($device, '-dFoo=/Bar');

        $argument = $processArguments->getArgument('-dFoo');
        $this->assertInstanceOf(Argument::class, $argument);
        $this->assertSame('/Bar', $argument->getValue());
    }

    public function testProcessCreation()
    {
        $process = $this->createDevice()->createProcess();

        $this->assertEquals("'gs'", $process->getCommandLine());
    }

    public function testProcessCreationWithInput()
    {
        $file = __DIR__ . '/../../data/input.pdf';
        $processInput = fopen($file, 'r');
        $code = '.setpdfwrite';

        $input = new Input();
        $input->addFile($file);
        $input->setProcessInput($processInput);
        $input->setPostScriptCode($code);

        $process = $this->createDevice()->createProcess($input);

        $this->assertEquals("'gs' '-c' '$code' '-f' '$file' '-'", $process->getCommandLine());
        $this->assertEquals($input, $process->getInput());

        fclose($processInput);
    }

    public function testProcessCreationWithPostScriptInput()
    {
        $input = '.setpdfwrite';

        $process = $this->createDevice()->createProcess($input);

        $this->assertEquals("'gs' '-c' '$input'", $process->getCommandLine());
    }

    public function testProcessCreationWithFileInput()
    {
        $input = __DIR__ . '/../../data/input.pdf';

        $process = $this->createDevice()->createProcess($input);

        $this->assertEquals("'gs' '-f' '$input'", $process->getCommandLine());
    }

    public function testProcessCreationWithResourceInput()
    {
        $input = fopen(__DIR__ . '/../../data/input.pdf', 'r');

        $process = $this->createDevice()->createProcess($input);

        $this->assertEquals("'gs' '-'", $process->getCommandLine());
        $this->assertEquals($input, $process->getInput());

        fclose($input);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testProcessCreationThrowsExceptionOnMissingInputFile()
    {
        $input = new Input();
        $input->addFile('/path/to/input/file.pdf');

        $this->createDevice()->createProcess($input);
    }
}
