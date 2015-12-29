<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Device\DistillerParameters;

use GravityMedia\Ghostscript\Enum\PdfSettings;

/**
 * The advanced distiller parameters trait
 *
 * @package GravityMedia\Ghostscript\Device\DistillerParameters
 */
trait AdvancedTrait
{
    /**
     * Get argument value
     *
     * @param string $name
     *
     * @return null|string
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
     * Get PDF settings
     *
     * @return string
     */
    abstract public function getPdfSettings();

    /**
     * Whether ASCII85 encode pages
     *
     * @return bool
     */
    public function isAscii85EncodePages()
    {
        $value = $this->getArgumentValue('-dASCII85EncodePages');
        if (null === $value) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set ASCII85 encode pages flag
     *
     * @param bool $ascii85EncodePages
     *
     * @return $this
     */
    public function setAscii85EncodePages($ascii85EncodePages)
    {
        $this->setArgument(sprintf('-dASCII85EncodePages=%s', $ascii85EncodePages ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to auto position EPS files
     *
     * @return bool
     */
    public function isAutoPositionEpsFiles()
    {
        $value = $this->getArgumentValue('-dAutoPositionEPSFiles');
        if (null === $value) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set auto position EPS files flag
     *
     * @param bool $autoPositionEpsFiles
     *
     * @return $this
     */
    public function setAutoPositionEpsFiles($autoPositionEpsFiles)
    {
        $this->setArgument(sprintf('-dAutoPositionEPSFiles=%s', $autoPositionEpsFiles ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to create job ticket
     *
     * @return bool
     */
    public function isCreateJobTicket()
    {
        $value = $this->getArgumentValue('-dCreateJobTicket');
        if (null === $value) {
            switch ($this->getPdfSettings()) {
                case PdfSettings::PRINTER:
                case PdfSettings::PREPRESS:
                    return true;
                default:
                    return false;
            }
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set create job ticket flag
     *
     * @param bool $createJobTicket
     *
     * @return $this
     */
    public function setCreateJobTicket($createJobTicket)
    {
        $this->setArgument(sprintf('-dCreateJobTicket=%s', $createJobTicket ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to detect blends
     *
     * @return bool
     */
    public function isDetectBlends()
    {
        $value = $this->getArgumentValue('-dDetectBlends');
        if (null === $value) {
            return true;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set detect blends flag
     *
     * @param bool $detectBlends
     *
     * @return $this
     */
    public function setDetectBlends($detectBlends)
    {
        $this->setArgument(sprintf('-dDetectBlends=%s', $detectBlends ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to emit DSC warnings
     *
     * @return bool
     */
    public function isEmitDscWarnings()
    {
        $value = $this->getArgumentValue('-dEmitDSCWarnings');
        if (null === $value) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set emit DSC warnings flag
     *
     * @param bool $emitDscWarnings
     *
     * @return $this
     */
    public function setEmitDscWarnings($emitDscWarnings)
    {
        $this->setArgument(sprintf('-dEmitDSCWarnings=%s', $emitDscWarnings ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to lock distiller params
     *
     * @return bool
     */
    public function isLockDistillerParams()
    {
        $value = $this->getArgumentValue('-dLockDistillerParams');
        if (null === $value) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set lock distiller params flag
     *
     * @param bool $lockDistillerParams
     *
     * @return $this
     */
    public function setLockDistillerParams($lockDistillerParams)
    {
        $this->setArgument(sprintf('-dLockDistillerParams=%s', $lockDistillerParams ? 'true' : 'false'));

        return $this;
    }

    /**
     * Get OPM
     *
     * @return int
     */
    public function getOpm()
    {
        $value = $this->getArgumentValue('-dOPM');
        if (null === $value) {
            return 1;
        }

        return intval($value);
    }

    /**
     * Set OPM
     *
     * @param int $opm
     *
     * @return $this
     */
    public function setOpm($opm)
    {
        $this->setArgument(sprintf('-dOPM=%s', $opm));

        return $this;
    }

    /**
     * Whether to parse DSC comments
     *
     * @return bool
     */
    public function isParseDscComments()
    {
        $value = $this->getArgumentValue('-dParseDSCComments');
        if (null === $value) {
            return true;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set parse DSC comments flag
     *
     * @param bool $parseDscComments
     *
     * @return $this
     */
    public function setParseDscComments($parseDscComments)
    {
        $this->setArgument(sprintf('-dParseDSCComments=%s', $parseDscComments ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to parse DSC comments for doc info
     *
     * @return bool
     */
    public function isParseDscCommentsForDocInfo()
    {
        $value = $this->getArgumentValue('-dParseDSCCommentsForDocInfo');
        if (null === $value) {
            return true;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set parse DSC comments for doc info flag
     *
     * @param bool $parseDscCommentsForDocInfo
     *
     * @return $this
     */
    public function setParseDscCommentsForDocInfo($parseDscCommentsForDocInfo)
    {
        $this->setArgument(sprintf('-dParseDSCCommentsForDocInfo=%s', $parseDscCommentsForDocInfo ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to preserve copy page
     *
     * @return bool
     */
    public function isPreserveCopyPage()
    {
        $value = $this->getArgumentValue('-dPreserveCopyPage');
        if (null === $value) {
            return true;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set preserve copy page flag
     *
     * @param bool $preserveCopyPage
     *
     * @return $this
     */
    public function setPreserveCopyPage($preserveCopyPage)
    {
        $this->setArgument(sprintf('-dPreserveCopyPage=%s', $preserveCopyPage ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to preserve EPS info
     *
     * @return bool
     */
    public function isPreserveEpsInfo()
    {
        $value = $this->getArgumentValue('-dPreserveEPSInfo');
        if (null === $value) {
            return true;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set preserve EPS info flag
     *
     * @param bool $preserveEpsInfo
     *
     * @return $this
     */
    public function setPreserveEpsInfo($preserveEpsInfo)
    {
        $this->setArgument(sprintf('-dPreserveEPSInfo=%s', $preserveEpsInfo ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to preserve OPI comments
     *
     * @return bool
     */
    public function isPreserveOpiComments()
    {
        $value = $this->getArgumentValue('-dPreserveOPIComments');
        if (null === $value) {
            switch ($this->getPdfSettings()) {
                case PdfSettings::PRINTER:
                case PdfSettings::PREPRESS:
                    return true;
                default:
                    return false;
            }
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set preserve OPI comments flag
     *
     * @param bool $preserveOpiComments
     *
     * @return $this
     */
    public function setPreserveOpiComments($preserveOpiComments)
    {
        $this->setArgument(sprintf('-dPreserveOPIComments=%s', $preserveOpiComments ? 'true' : 'false'));

        return $this;
    }

    /**
     * Whether to use prologue
     *
     * @return bool
     */
    public function isUsePrologue()
    {
        $value = $this->getArgumentValue('-dUsePrologue');
        if (null === $value) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set use prologue flag
     *
     * @param bool $usePrologue
     *
     * @return $this
     */
    public function setUsePrologue($usePrologue)
    {
        $this->setArgument(sprintf('-dUsePrologue=%s', $usePrologue ? 'true' : 'false'));

        return $this;
    }
}
