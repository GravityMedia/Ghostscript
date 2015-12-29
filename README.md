# Ghostscript

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gravitymedia/ghostscript.svg)](https://packagist.org/packages/gravitymedia/ghostscript)
[![Software License](https://img.shields.io/packagist/l/gravitymedia/ghostscript.svg)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/GravityMedia/Ghostscript.svg)](https://travis-ci.org/GravityMedia/Ghostscript)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/GravityMedia/Ghostscript.svg)](https://scrutinizer-ci.com/g/GravityMedia/Ghostscript/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/GravityMedia/Ghostscript.svg)](https://scrutinizer-ci.com/g/GravityMedia/Ghostscript)
[![Total Downloads](https://img.shields.io/packagist/dt/gravitymedia/ghostscript.svg)](https://packagist.org/packages/gravitymedia/ghostscript)
[![Dependency Status](https://img.shields.io/versioneye/d/php/gravitymedia:ghostscript.svg)](https://www.versioneye.com/user/projects/54a6c25c27b014d85a000150)

Ghostscript is an object oriented Ghostscript binary wrapper for PHP.

## Requirements

This library has the following requirements:

 - PHP 5.4+ or HHVM
 - Ghostscript 9.00+

## Installation

Install Composer in your project:

```bash
$ curl -s https://getcomposer.org/installer | php
```

Add the package to your `composer.json` and install it via Composer:

```bash
$ php composer.phar require gravitymedia/ghostscript
```

## Usage

This is a simple example how to convert an input PDF to an output PDF. 

```php
// Initialize autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Import classes
use GravityMedia\Ghostscript\Ghostscript;
use Symfony\Component\Process\Process;

// Define input and output files
$inputFile = '/path/to/input/file.pdf';
$outputFile = '/path/to/output/file.pdf';

// Create Ghostscript object
$ghostscript = new Ghostscript([
    'quiet' => false
]);

// Create and configure the device
$device = $ghostscript->createPdfDevice($outputFile);
$device->setCompatibilityLevel(1.4);

// Create process
$process = $device->createProcess($inputFile);

// Print the command line
print '$ ' . $process->getCommandLine() . PHP_EOL;

// Run process
$process->run(function ($type, $buffer) {
    if ($type === Process::ERR) {
        throw new \RuntimeException($buffer);
    }

    print $buffer;
});
```

## Testing

Clone this repository, install Composer and all dependencies:

``` bash
$ php composer.phar install
```

Run the test suite:

``` bash
$ php composer.phar test
```

## Generating documentation

Clone this repository, install Composer and all dependencies:

``` bash
$ php composer.phar install
```

Generate the documentation to the `build/docs` directory:

``` bash
$ php composer.phar doc
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Daniel Schröder](https://github.com/pCoLaSD)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
