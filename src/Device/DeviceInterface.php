<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Device;

/**
 * Device interface
 *
 * @package GravityMedia\Ghostscript\Devices
 */
interface DeviceInterface
{
    /**
     * Get command parameter list
     *
     * @return \GravityMedia\Commander\Command\ParameterList
     */
    public function getCommandParameterList();

    /**
     * Get device name
     *
     * @return string
     */
    public function getDeviceName();
}
