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
     * Get device name
     *
     * @return string
     */
    public function getDeviceName();

    /**
     * Get device options as arguments
     *
     * @return \GravityMedia\Commander\Argument\ArgumentInterface[]
     */
    public function getDeviceOptionsAsArguments();
}
