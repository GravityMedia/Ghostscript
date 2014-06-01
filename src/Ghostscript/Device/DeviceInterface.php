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
     * Get device flags
     *
     * @return \Ghostscript\ShellWrapper\Command\Collections\Flags
     */
    public function getDeviceFlags();

    /**
     * Get device name
     *
     * @return string
     */
    public function getDeviceName();
}
