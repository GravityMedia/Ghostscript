#Ghostscript

Object oriented Ghostscript processing library for PHP

##Requirements##

This library has the following requirements:

 - PHP 5.5+
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

use Ghostscript\Device\Pdf as PdfDevice;
use Ghostscript\Ghostscript;
use Ghostscript\Parameters;

$inputFile = '/path/to/input/file.pdf';
$outputFile = '/path/to/output/file.pdf';

$interactionParameters = new Parameters\Interaction();
$interactionParameters
    ->setQuiet(true)
    ->setBatch(true)
    ->setPause(false);

$otherParameters = new Parameters\Other();
$otherParameters
    ->setSafer(true);

$pdfDevice = new PdfDevice(array('configuration' => PdfDevice::CONFIGURATION_DEFAULT));
$pdfDevice
    ->setOutputFile($outputFile);

$ghostscript = new Ghostscript();
$ghostscript
    ->addParameters($interactionParameters)
    ->addParameters($otherParameters)
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
