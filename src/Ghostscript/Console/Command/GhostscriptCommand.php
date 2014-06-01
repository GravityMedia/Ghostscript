<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\Console\Command;

use Ghostscript\Ghostscript;
use Ghostscript\Parameters;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GhostscriptCommand extends Command
{
    /**
     * @var \Ghostscript\Ghostscript
     */
    private $ghostscript;

    /**
     * Initializes the command just after the input has been validated.
     *
     * This is mainly useful when a lot of commands extends one main command
     * where some things need to be initialized based on the input arguments and options.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);
        $this->ghostscript = new Ghostscript();
    }

    /**
     * Get ghostscript instance
     *
     * @return \Ghostscript\Ghostscript
     */
    protected function getGhostscript()
    {
        return $this->ghostscript;
    }

    /**
     * Apply default ghostscript parameters
     *
     * @return \Ghostscript\Console\Command\GhostscriptCommand
     */
    protected function applyDefaultGhostscriptParameters()
    {
        $interactionParameters = new Parameters\Interaction();
        $interactionParameters
            ->setQuiet(true)
            ->setBatch(true)
            ->setPause(false);

        $otherParameters = new Parameters\Other();
        $otherParameters
            ->setSafer(true);

        $ghostscript = $this->getGhostscript();
        $ghostscript
            ->addParameters($interactionParameters)
            ->addParameters($otherParameters);

        return $this;
    }
}
