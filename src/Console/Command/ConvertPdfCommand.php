<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Console\Command;

use GravityMedia\Ghostscript\Device\Pdf as PdfDevice;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConvertPdfCommand extends GhostscriptCommand
{
    protected function configure()
    {
        $this
            ->setName('convert:pdf')
            ->setDescription('Convert any file via Ghostscript to PDF')
            ->addArgument(
                'input',
                InputArgument::REQUIRED,
                'The input file'
            )
            ->addArgument(
               'output',
               InputArgument::REQUIRED,
               'The output file'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $inputFile = $input->getArgument('input');
        $outputFile = $input->getArgument('output');

        $pdfDevice = new PdfDevice(array(
            'configuration' => PdfDevice::CONFIGURATION_DEFAULT
        ));
        $pdfDevice->setOutputFile($outputFile);

        $ghostscript = $this
            ->applyDefaultGhostscriptParameters()
            ->getGhostscript()
            ->setDevice($pdfDevice);

        // debug
        $output->writeln('<info>Command:</info> ' . $ghostscript->process($ghostscript->getCommand($inputFile)));
    }
}
