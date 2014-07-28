<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Device;

use GravityMedia\Ghostscript\Command\Parameter\StringOption;

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
    public function getCommandParameterList()
    {
        $parameters = array();
        array_push($parameters, new StringOption('DEVICE', $this->getDeviceName()));
        if (null !== $this->outputFile) {
            array_push($parameters, new StringOption('OutputFile', $this->outputFile));
        }
        return $parameters;
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
