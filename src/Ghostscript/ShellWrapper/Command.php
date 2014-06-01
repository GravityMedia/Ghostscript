<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\ShellWrapper;

use AdamBrett\ShellWrapper\Command\Collections\Arguments;
use AdamBrett\ShellWrapper\Command\Collections\Flags;
use AdamBrett\ShellWrapper\Command\Collections\Params;
use AdamBrett\ShellWrapper\Command\Collections\SubCommands;

/**
 * The command object
 *
 * @package Ghostscript\ShellWrapper
 */
class Command extends \AdamBrett\ShellWrapper\Command
{
    /**
     * @var array
     */
    protected $options;

    /**
     * The constructor
     *
     * @param string $command
     * @param array $options
     */
    public function __construct($command, array $options = array())
    {
        parent::__construct($command);
        $this->options = $options;

        $arguments = $this->getOption('arguments');
        if ($arguments instanceof Arguments) {
            $this->arguments = $arguments;
        }

        $flags = $this->getOption('flags');
        if ($flags instanceof Flags) {
            $this->flags = $flags;
        }

        $params = $this->getOption('params');
        if ($params instanceof Params) {
            $this->params = $params;
        }

        $subCommands = $this->getOption('sub-commands');
        if ($subCommands instanceof SubCommands) {
            $this->subCommands = $subCommands;
        }
    }

    /**
     * Get command as string
     *
     * @return string
     */
    public function __toString()
    {
        $string = parent::__toString();

        $redirections = $this->getOption('redirections');
        if (is_array($redirections)) {
            foreach ($redirections as $redirection) {
                $redirection = (string)$redirection;
                if (!empty($redirection)) {
                    $string .= " $redirection";
                }
            }
        }

        return $string;
    }

    /**
     * Get option
     *
     * @param string $key
     * @param mixed $default
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
}
