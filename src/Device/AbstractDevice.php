<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Device;

use GravityMedia\Commander\Command\Parameter\Argument;
use GravityMedia\Commander\Command\ParameterList;
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
        $parameters = new ParameterList();
        $parameters->addParameter(new StringOption('DEVICE', new Argument($this->getDeviceName())));
        if (null !== $this->outputFile) {
            $parameters->addParameter(new StringOption('OutputFile', new Argument($this->outputFile)));
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
