<?php
/**
 * This file is part of the Ghostscript test package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\GhostscriptTest\Device;

use GravityMedia\Ghostscript\Device\AbstractDevice;
use GravityMedia\Ghostscript\Process\Arguments as ProcessArguments;
use Symfony\Component\Process\ProcessBuilder;

/**
 * The abstract device test class
 *
 * @package GravityMedia\GhostscriptTest\Devices
 *
 * @covers  \GravityMedia\Ghostscript\Device\AbstractDevice
 *
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
        $processBuilder = new ProcessBuilder();
        $processArguments = new ProcessArguments();
        $processArguments->setArguments($arguments);

        return $this->getMockForAbstractClass(
            'GravityMedia\Ghostscript\Device\AbstractDevice',
            [$processBuilder, $processArguments]
        );
    }

    public function testArgumentGetter()
    {
        $device = $this->createDevice(['-dFoo=/Bar']);
        $method = new \ReflectionMethod('GravityMedia\Ghostscript\Device\AbstractDevice', 'getArgument');
        $method->setAccessible(true);

        $this->assertNull($method->invoke($device, '-dBaz'));

        /** @var \GravityMedia\Ghostscript\Process\Argument $argument */
        $argument = $method->invoke($device, '-dFoo');
        $this->assertInstanceOf('GravityMedia\Ghostscript\Process\Argument', $argument);
        $this->assertSame('/Bar', $argument->getValue());
    }

    public function testArgumentValueGetter()
    {
        $device = $this->createDevice(['-dFoo=/Bar']);
        $method = new \ReflectionMethod('GravityMedia\Ghostscript\Device\AbstractDevice', 'getArgumentValue');
        $method->setAccessible(true);

        $this->assertNull($method->invoke($device, '-dBaz'));
        $this->assertSame('/Bar', $method->invoke($device, '-dFoo'));
    }

    public function testArgumentSetter()
    {
        $processBuilder = new ProcessBuilder();
        $processArguments = new ProcessArguments();

        /** @var AbstractDevice $device */
        $device = $this->getMockForAbstractClass(
            'GravityMedia\Ghostscript\Device\AbstractDevice',
            [$processBuilder, $processArguments]
        );

        $method = new \ReflectionMethod('GravityMedia\Ghostscript\Device\AbstractDevice', 'setArgument');
        $method->setAccessible(true);
        $method->invoke($device, '-dFoo=/Bar');

        $argument = $processArguments->getArgument('-dFoo');
        $this->assertInstanceOf('GravityMedia\Ghostscript\Process\Argument', $argument);
        $this->assertSame('/Bar', $argument->getValue());
    }

    public function testStringParameterSetter()
    {
        $processBuilder = new ProcessBuilder();
        $processArguments = new ProcessArguments();

        /** @var AbstractDevice $device */
        $device = $this->getMockForAbstractClass(
            'GravityMedia\Ghostscript\Device\AbstractDevice',
            [$processBuilder, $processArguments]
        );

        $device->setStringParameter('Foo', 'Bar');

        $argument = $processArguments->getArgument('-sFoo');
        $this->assertInstanceOf('GravityMedia\Ghostscript\Process\Argument', $argument);
        $this->assertSame('Bar', $argument->getValue());
    }

    public function testTokenParameterSetter()
    {
        $processBuilder = new ProcessBuilder();
        $processArguments = new ProcessArguments();

        /** @var AbstractDevice $device */
        $device = $this->getMockForAbstractClass(
            'GravityMedia\Ghostscript\Device\AbstractDevice',
            [$processBuilder, $processArguments]
        );

        $device->setTokenParameter('Foo', 42);

        $argument = $processArguments->getArgument('-dFoo');
        $this->assertInstanceOf('GravityMedia\Ghostscript\Process\Argument', $argument);
        $this->assertEquals(42, $argument->getValue());
    }

    public function testProcessCreation()
    {
        $this->assertInstanceOf(
            'Symfony\Component\Process\Process',
            $this->createDevice()->createProcess(__DIR__ . '/../../data/input.pdf')
        );
    }

    public function testProcessCommandLine()
    {
        $inputFile = __DIR__.'/../../data/input.pdf';
        $this->assertEquals(
            "'-c' '' '-f' '$inputFile'",
            $this->createDevice()->createProcess($inputFile)->getCommandLine()
        );
    }

    public function testProcessCommandLineWithAddingInputFileBefore()
    {
        $inputFile = __DIR__.'/../../data/input.pdf';
        $this->assertEquals(
            "'-c' '' '-f' '$inputFile'",
            $this->createDevice()->addInputFile($inputFile)->createProcess()->getCommandLine()
        );
    }

    public function testProcessCommandLineWithStdin()
    {
        $this->assertEquals(
            "'-c' '' '-f' '-'",
            $this->createDevice()->createProcess('-')->getCommandLine()
        );
    }

    public function testProcessCommandLineWithAddingStdinInputBefore()
    {
        $this->assertEquals(
            "'-c' '' '-f' '-'",
            $this->createDevice()->addInputStdin()->createProcess()->getCommandLine()
        );
    }

    public function testProcessCommandLineStdinIsLastInput()
    {
        $inputFile = __DIR__.'/../../data/input.pdf';
        $this->assertEquals(
            "'-c' '' '-f' '$inputFile' '-'",
            $this->createDevice()->addInputStdin()->addInputFile($inputFile)->createProcess()->getCommandLine()
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
