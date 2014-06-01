<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\Device;

use Ghostscript\ShellWrapper\Command;

/**
 * Abstract device object
 *
 * @package Ghostscript\Devices
 */
abstract class AbstractDevice implements DeviceInterface
{
    /**
     * @var string
     */
    protected $outputFile;

    /**
     * Get flags
     *
     * @return \Ghostscript\ShellWrapper\Command\Collections\Flags
     */
    public function getDeviceFlags()
    {
        $flags = new Command\Collections\Flags();
        $flags->addFlag(new Command\StringFlag('DEVICE', $this->getDeviceName()));
        if (null !== $this->outputFile) {
            $flags->addFlag(new Command\StringFlag('OutputFile', $this->outputFile));
        }
        return $flags;
    }

    /**
     * Set output file
     *
     * @param string $outputFile
     *
     * @return \Ghostscript\Device\AbstractDevice
     */
    public function setOutputFile($outputFile)
    {
        $this->outputFile = $outputFile;
        return $this;
    }

    /**
     * Get output file
     *
     * @return string
     */
    public function getOutputFile()
    {
        return $this->outputFile;
    }
}
