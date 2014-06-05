<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\Device;

/**
 * Device interface
 *
 * @package Ghostscript\Devices
 */
interface DeviceInterface
{
    /**
     * Get command parameter list
     *
     * @return \Commander\Command\ParameterList
     */
    public function getCommandParameterList();

    /**
     * Get device name
     *
     * @return string
     */
    public function getDeviceName();
}
