<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Device;

/**
 * EPS device object
 *
 * @package GravityMedia\Ghostscript\Devices
 */
class Eps extends AbstractDevice
{
    /**
     * @var array
     */
    protected $options;

    /**
     * The constrctor
     *
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        $this->options = $options;
    }

    /**
     * Get option
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getOption($key, $default = null)
    {
        if (array_key_exists($key, $this->options)) {
            return $this->options[$key];
        }
        return $default;
    }

    /**
     * Get device name
     *
     * @return string
     */
    public function getDeviceName()
    {
        return 'eps2write';
    }
}
