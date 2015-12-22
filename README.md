#Ghostscript

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gravitymedia/ghostscript.svg)](https://packagist.org/packages/gravitymedia/ghostscript)
[![Software License](https://img.shields.io/packagist/l/gravitymedia/ghostscript.svg)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/GravityMedia/Ghostscript.svg)](https://travis-ci.org/GravityMedia/Ghostscript)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/GravityMedia/Ghostscript.svg)](https://scrutinizer-ci.com/g/GravityMedia/Ghostscript/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/GravityMedia/Ghostscript.svg)](https://scrutinizer-ci.com/g/GravityMedia/Ghostscript)
[![Total Downloads](https://img.shields.io/packagist/dt/gravitymedia/ghostscript.svg)](https://packagist.org/packages/gravitymedia/ghostscript)
[![Dependency Status](https://img.shields.io/versioneye/d/php/gravitymedia:ghostscript.svg)](https://www.versioneye.com/user/projects/54a6c25c27b014d85a000150)

Ghostscript is an object oriented Ghostscript processing library for PHP.

##Requirements##

This library has the following requirements:

 - PHP 5.4+ or HHVM
 - Ghostscript 9.00+

##Installation##

Install Composer in your project:

```bash
$ curl -s https://getcomposer.org/installer | php
```

Add the package to your `composer.json` and install it via Composer:

```bash
$ php composer.phar require gravitymedia/ghostscript
```

##Usage##

This is a simple example how to convert an input PDF to an output PDF. 

```php
require_once __DIR__ . '/vendor/autoload.php';

use GravityMedia\Ghostscript\Ghostscript;

$inputFile = '/path/to/input/file.pdf';
$outputFile = '/path/to/output/file.pdf';

$ghostscript = new Ghostscript([
    'quiet' => false
]);

$device = $ghostscript->createPdfDevice($outputFile);

$process = $device->createProcess($inputFile);
$process->run();

if (!$process->isSuccessful()) {
    throw new \RuntimeException($process->getErrorOutput());
}

print $process->getOutput();
```

## Testing

``` bash
$ php composer.phar test
```

## Generating documentation

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
