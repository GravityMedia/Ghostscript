<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Device;

use GravityMedia\Ghostscript\Argument;

/**
 * Abstract device object
 *
 * @package GravityMedia\Ghostscript\Devices
 */
abstract class AbstractDevice implements DeviceInterface
{
    /**
     * @var string
     */
    protected $outputFile;

    /**
     * @inheritdoc
     */
    public function getDeviceOptionsAsArguments()
    {
        $arguments = array();
        array_push($arguments, new Argument\StringOption('DEVICE', $this->getDeviceName()));
        if (null !== $this->outputFile) {
            array_push($arguments, new Argument\StringOption('OutputFile', $this->outputFile));
        }
        return $arguments;
    }

    /**
     * Set output file
     *
     * @param string $outputFile
     *
     * @return \GravityMedia\Ghostscript\Device\AbstractDevice
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
