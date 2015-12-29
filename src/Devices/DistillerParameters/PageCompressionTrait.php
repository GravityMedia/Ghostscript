<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Devices\DistillerParameters;

/**
 * The page compression distiller parameters trait
 *
 * @package GravityMedia\Ghostscript\Devices\DistillerParameters
 */
trait PageCompressionTrait
{
    /**
     * Get argument value
     *
     * @param string $name
     *
     * @return string
     */
    abstract protected function getArgumentValue($name);

    /**
     * Set argument
     *
     * @param string $argument
     *
     * @return $this
     */
    abstract protected function setArgument($argument);

    /**
     * Whether to compress pages
     *
     * @return bool
     */
    public function isCompressPages()
    {
        $value = $this->getArgumentValue('-dCompressPages');
        if (null === $value) {
            return true;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set compress pages flag
     *
     * @param true $compressPages
     *
     * @return $this
     */
    public function setCompressPages($compressPages)
    {
        $this->setArgument(sprintf('-dCompressPages=%s', $compressPages ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to LZW encode pages
     *
     * @return bool
     */
    public function isLzwEncodePages()
    {
        $value = $this->getArgumentValue('-dLZWEncodePages');
        if (null === $value) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set LZW encode pages flag
     *
     * @param string $lzwEncodePages
     *
     * @return $this
     */
    public function setLzwEncodePages($lzwEncodePages)
    {
        $this->setArgument(sprintf('-dLZWEncodePages=%s', $lzwEncodePages ? 'true' : 'false'));

        return $this;
    }
}
