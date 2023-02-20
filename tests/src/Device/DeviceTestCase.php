<?php

declare(strict_types=1);

namespace GravityMedia\GhostscriptTest\Device;

use GravityMedia\Ghostscript\Device\AbstractDevice;
use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\Process\Arguments;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

abstract class DeviceTestCase extends TestCase
{
    protected Arguments $arguments;

    protected function setUp(): void
    {
        parent::setUp();

        $this->arguments = new Arguments();
    }

    abstract protected function createDevice(?string $version = null): AbstractDevice;

    protected function getGhostscript(?string $version): Ghostscript|MockObject
    {
        if ($version === null) {
            $ghostscript = new Ghostscript();
        } else {
            $ghostscript = $this->createPartialMock(Ghostscript::class, ['getVersion']);

            $ghostscript->expects($this->once())
                ->method('getVersion')
                ->will($this->returnValue($version));
        }
        return $ghostscript;
    }

    public function dataVersionsChecks(): array
    {
        $minVersion = $this->getExpectedMinimumVersion();
        return [
            '8.50' => [fn (self $self) => $self->assertVersionCheck(
                version: '8.50',
                expectedFailure: true,
            )],
            $minVersion => [fn (self $self) => $self->assertVersionCheck(
                version: $minVersion,
                expectedFailure: false,
            )],
            '9.10' => [fn (self $self) => $self->assertVersionCheck(
                version: '9.10',
                expectedFailure: false,
            )],
            '9.50' => [fn (self $self) => $self->assertVersionCheck(
                version: '9.50',
                expectedFailure: false,
            )],
            '10.00.0' => [fn (self $self) => $self->assertVersionCheck(
                version: '10.00.0', // Version from brew (Mac)
                expectedFailure: false,
            )]
        ];
    }

    /**
     * @dataProvider dataVersionsChecks
     */
    public function testVersionCheck(callable $closure): void
    {
        $closure($this);
    }

    protected function assertVersionCheck(
        string $version,
        bool $expectedFailure,
    ): void
    {
        if ($expectedFailure) {
            $expectedMinimumVersion = $this->getExpectedMinimumVersion();
            $this->expectExceptionMessage('Ghostscript version ' . $expectedMinimumVersion . ' or higher is required');
        }

        $device = $this->createDevice($version);
        $this->createProcessForVersionTest($device);
    }

    protected function getExpectedMinimumVersion(): string
    {
        return '9.00';
    }

    protected function createProcessForVersionTest(AbstractDevice $device): Process
    {
        return $device->createProcess();
    }

    /**
     * Returns an OS independent representation of the commandline.
     */
    protected function quoteCommandLine(string $commandline): string
    {
        if ('WIN' === strtoupper(substr(PHP_OS, 0, 3))) {
            return str_replace('"', '\'', $commandline);
        }

        return $commandline;
    }
}
