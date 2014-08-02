<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Ghostscript\Command;

use GravityMedia\Ghostscript\Device\Pdf as PdfDevice;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

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
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $inputFile = $input->getArgument('input');
        $outputFile = $input->getArgument('output');

        $pdfDevice = new PdfDevice(
            array(
                'configuration' => PdfDevice::CONFIGURATION_DEFAULT
            )
        );
        $pdfDevice->setOutputFile($outputFile);

        $ghostscript = $this
            ->getGhostscript()
            ->setDevice($pdfDevice);

        $process = new Process($ghostscript->createCommander($inputFile));
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput(), $process->getExitCode());
        }

        // debug
        $output->writeln('<info>Command:</info> ' . $process->getCommandLine());
        foreach (explode(PHP_EOL, $process->getOutput()) as $comment) {
            $output->writeln('<comment>' . $comment . '</comment>');
        }
    }
}
