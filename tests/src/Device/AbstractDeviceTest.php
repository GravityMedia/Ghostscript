<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Device;

use GravityMedia\Ghostscript\Device\AbstractDevice;
use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\Process\Argument;
use GravityMedia\Ghostscript\Process\Arguments as ProcessArguments;
use Symfony\Component\Process\Process;

/**
 * The abstract device test class
 *
 * @package GravityMedia\GhostscriptTest\Devices
 *
 * @covers  \GravityMedia\Ghostscript\Device\AbstractDevice
 *
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

    public function testStringParameterSetter()
    {
        $ghostscript = new Ghostscript();
        $processArguments = new ProcessArguments();

        /** @var AbstractDevice $device */
        $device = $this->getMockForAbstractClass(AbstractDevice::class, [$ghostscript, $processArguments]);

        $device->setStringParameter('Foo', 'Bar');

        $argument = $processArguments->getArgument('-sFoo');
        $this->assertInstanceOf(Argument::class, $argument);
        $this->assertSame('Bar', $argument->getValue());
    }

    public function testTokenParameterSetter()
    {
        $ghostscript = new Ghostscript();
        $processArguments = new ProcessArguments();

        /** @var AbstractDevice $device */
        $device = $this->getMockForAbstractClass(AbstractDevice::class, [$ghostscript, $processArguments]);

        $device->setTokenParameter('Foo', 42);

        $argument = $processArguments->getArgument('-dFoo');
        $this->assertInstanceOf(Argument::class, $argument);
        $this->assertEquals(42, $argument->getValue());
    }

    public function testProcessCreation()
    {
        $this->assertInstanceOf(
            Process::class,
            $this->createDevice()->createProcess(__DIR__ . '/../../data/input.pdf')
        );
    }

    public function testProcessCommandLine()
    {
        $inputFile = __DIR__ . '/../../data/input.pdf';
        $this->assertEquals(
            "'gs' '-c' '' '-f' '$inputFile'",
            $this->createDevice()->createProcess($inputFile)->getCommandLine()
        );
    }

    public function testProcessCommandLineWithAddingInputFileBefore()
    {
        $inputFile = __DIR__ . '/../../data/input.pdf';
        $this->assertEquals(
            "'gs' '-c' '' '-f' '$inputFile'",
            $this->createDevice()->addInputFile($inputFile)->createProcess()->getCommandLine()
        );
    }

    public function testProcessCommandLineWithStdin()
    {
        $this->assertEquals(
            "'gs' '-c' '' '-f' '-'",
            $this->createDevice()->createProcess('-')->getCommandLine()
        );
    }

    public function testProcessCommandLineWithAddingStdinInputBefore()
    {
        $this->assertEquals(
            "'gs' '-c' '' '-f' '-'",
            $this->createDevice()->addInputStdin()->createProcess()->getCommandLine()
        );
    }

    public function testProcessCommandLineStdinIsLastInput()
    {
        $inputFile = __DIR__ . '/../../data/input.pdf';
        $this->assertEquals(
            "'gs' '-c' '' '-f' '$inputFile' '-'",
            $this->createDevice()->addInputStdin()->addInputFile($inputFile)->createProcess()->getCommandLine()
        );
    }

    public function testConsecutiveProcessCommandLines()
    {
        $inputFile = __DIR__ . '/../../data/input.pdf';
        $device = $this->createDevice();
        $this->assertEquals(
            "'gs' '-c' '' '-f' '$inputFile' '-'",
            $device->addInputFile($inputFile)->addInputStdin()->createProcess()->getCommandLine()
        );
        // Second process created from same device has no input set.
        $this->assertEquals(
            "'gs' '-c' '' '-f'",
            $device->createProcess()->getCommandLine()
        );
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testProcessCreationThrowsExceptionOnMissingInputFile()
    {
        $this->createDevice()->createProcess('/path/to/input/file.pdf');
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testAddingMissingInputFileThrowsException()
    {
        $this->createDevice()->addInputFile('/path/to/input/file.pdf');
    }
}
