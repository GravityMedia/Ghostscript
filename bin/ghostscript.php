<?php
/**
 * This file is part of the Ghostscript package
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

$dir = explode(DIRECTORY_SEPARATOR, __DIR__);
while (!file_exists('vendor/autoload.php')) {
    if (empty($dir) || !chdir(implode(DIRECTORY_SEPARATOR, $dir))) {
        break;
    }
    array_pop($dir);
}

require 'vendor/autoload.php';

$application = new \Symfony\Component\Console\Application();
$application->add(new \GravityMedia\Ghostscript\Console\Command\ConvertPdfCommand());
$application->run();
