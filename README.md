#Ghostscript

Object oriented Ghostscript processing library for PHP

[![Packagist](https://img.shields.io/packagist/v/gravitymedia/ghostscript.svg)](https://packagist.org/packages/gravitymedia/ghostscript)
[![Downloads](https://img.shields.io/packagist/dt/gravitymedia/ghostscript.svg)](https://packagist.org/packages/gravitymedia/ghostscript)
[![License](https://img.shields.io/packagist/l/gravitymedia/ghostscript.svg)](https://packagist.org/packages/gravitymedia/ghostscript)
[![Build](https://img.shields.io/travis/GravityMedia/Ghostscript.svg)](https://travis-ci.org/GravityMedia/Ghostscript)
[![Code Quality](https://img.shields.io/scrutinizer/g/GravityMedia/Ghostscript.svg)](https://scrutinizer-ci.com/g/GravityMedia/Ghostscript/?branch=master)
[![Coverage](https://img.shields.io/scrutinizer/coverage/g/GravityMedia/Ghostscript.svg)](https://scrutinizer-ci.com/g/GravityMedia/Ghostscript/?branch=master)
[![PHP Dependencies](https://www.versioneye.com/user/projects/54a6c39d27b014005400004b/badge.svg)](https://www.versioneye.com/user/projects/54a6c39d27b014005400004b)

##Requirements##

This library has the following requirements:

 - PHP 5.4+
 - Ghostscript 9.00+

##Installation##

Install composer in your project:

```bash
$ curl -s https://getcomposer.org/installer | php
```

Create a `composer.json` file in your project root:

```json
{
    "require": {
        "gravitymedia/ghostscript": "dev-master"
    }
}
```

Install via composer:

```bash
$ php composer.phar install
```

##Usage##

```php
require 'vendor/autoload.php';

use GravityMedia\Ghostscript\Device\Pdf as PdfDevice;
use GravityMedia\Ghostscript\Ghostscript;
use GravityMedia\Ghostscript\Parameters;

$inputFile = '/path/to/input/file.pdf';
$outputFile = '/path/to/output/file.pdf';

$interactionParameters = new Parameters\Interaction();
$interactionParameters
    ->setQuiet(true)
    ->setBatch(true)
    ->setPause(false);

$controlParameters = new Parameters\Control();
$controlParameters
    ->setSafer(true);

$pdfDevice = new PdfDevice(array('configuration' => PdfDevice::CONFIGURATION_DEFAULT));
$pdfDevice
    ->setOutputFile($outputFile);

$ghostscript = new Ghostscript();
$ghostscript
    ->addParameters($interactionParameters)
    ->addParameters($controlParameters)
    ->setDevice($pdfDevice);

$process = $ghostscript->createProcess($inputFile);
$process->run();

if (!$process->isSuccessful()) {
    throw new \RuntimeException($process->getErrorOutput(), $process->getExitCode());
}
```
