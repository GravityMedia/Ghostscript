#Ghostscript
[![Project Status](http://stillmaintained.com/GravityMedia/Ghostscript.png)](http://stillmaintained.com/GravityMedia/Ghostscript)
[![Build Status](https://travis-ci.org/GravityMedia/Ghostscript.svg?branch=master)](https://travis-ci.org/GravityMedia/Ghostscript)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GravityMedia/Ghostscript/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GravityMedia/Ghostscript/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/GravityMedia/Ghostscript/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GravityMedia/Ghostscript/?branch=master)

Object oriented Ghostscript processing library for PHP

##Requirements##

This library has the following requirements:

 - PHP 5.4+
 - Ghostscript 9.00+

##Installation##

Install composer in your project:

```bash
curl -s https://getcomposer.org/installer | php
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
php composer.phar install
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

$command = $ghostscript
    ->getCommand($inputFile);

$output = $ghostscript
    ->process($command)
    ->getShell()
    ->getOutput();

var_dump((string)$command);
var_dump($output);
```
