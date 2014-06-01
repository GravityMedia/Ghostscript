<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace Ghostscript\Console\Command;

use Ghostscript\Device\Pdf as PdfDevice;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConvertPdfCommand extends GhostscriptCommand
{
    protected function configure()
    {
        $this
            ->setName('ghostscript:convert:pdf')
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

        $ghostscriptCommand = $ghostscript->getCommand($inputFile);
        $ghostscriptOutput = $ghostscript->process($ghostscriptCommand)
            ->getShell()
            ->getOutput();

        // debug
        $output->writeln('<info>' . $ghostscriptCommand . '</info>');
        if (!empty($ghostscriptOutput)) {
            $output->writeln('<comment>' . implode('</comment>' . "\n" . '<comment>', $ghostscriptOutput) . '</comment>');
        }
    }
}
