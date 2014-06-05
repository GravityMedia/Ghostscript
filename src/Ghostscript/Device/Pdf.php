<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\Device;

use Commander\Command\Parameter\Argument;
use Ghostscript\Command\Parameter\TokenOption;

/**
 * PDF device object
 *
 * @package Ghostscript\Devices
 */
class Pdf extends AbstractDevice
{
    /**
     * Default configuration
     */
    const CONFIGURATION_DEFAULT = '/default';

    /**
     * Screen configuration
     */
    const CONFIGURATION_SCREEN = '/screen';

    /**
     * eBook configuration
     */
    const CONFIGURATION_EBOOK = '/ebook';

    /**
     * Printer configuration
     */
    const CONFIGURATION_PRINTER = '/printer';

    /**
     * Prepress configuration
     */
    const CONFIGURATION_PREPRESS = '/prepress';

    /**
     * Gray device
     */
    const DEVICE_GRAY = '/DeviceGray';

    /**
     * RGB device
     */
    const DEVICE_RGB = '/DeviceRGB';

    /**
     * CMYK device
     */
    const DEVICE_CMYK = '/DeviceCMYK';

    /**
     * @var array
     */
    protected $options;

    /**
     * @var string
     */
    protected $compatibilityLevel;

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
        return 'pdfwrite';
    }

    /**
     * @inheritdoc
     */
    public function getCommandParameterList()
    {
        $parameters = parent::getCommandParameterList();

        // @see http://ghostscript.com/doc/current/Ps2pdf.htm#Options
        $configuration = $this->getOption('configuration');
        if (in_array($configuration, array(self::CONFIGURATION_DEFAULT, self::CONFIGURATION_SCREEN, self::CONFIGURATION_EBOOK, self::CONFIGURATION_PRINTER, self::CONFIGURATION_PREPRESS))) {
            $parameters->addParameter(new TokenOption('PDFSETTINGS', new Argument($configuration)));
        }
        $processColorModel = $this->getOption('process-color-model');
        if (in_array($processColorModel, array(self::DEVICE_GRAY, self::DEVICE_RGB, self::DEVICE_CMYK))) {
            $parameters->addParameter(new TokenOption('ProcessColorModel', new Argument($processColorModel)));
        }

        if (null !== $this->compatibilityLevel) {
            $parameters->addParameter(new TokenOption('CompatibilityLevel', new Argument($this->compatibilityLevel)));
        }
        return $parameters;
    }

    /**
     * Set compatibility level
     *
     * @param string $compatibilityLevel
     *
     * @return \Ghostscript\Device\Pdf
     */
    public function setCompatibilityLevel($compatibilityLevel)
    {
        $this->compatibilityLevel = $compatibilityLevel;
        return $this;
    }

    /**
     * Get compatibility level
     *
     * @return string
     */
    public function getCompatibilityLevel()
    {
        return $this->compatibilityLevel;
    }
}
