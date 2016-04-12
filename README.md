# PHP Brainfuck interpreter

[![Build Status](https://travis-ci.org/dotzero/brainfuck-php.svg?branch=master)](https://travis-ci.org/dotzero/brainfuck-php)
[![Latest Stable Version](https://poser.pugx.org/dotzero/brainfuck/version)](https://packagist.org/packages/dotzero/brainfuck)
[![License](https://poser.pugx.org/dotzero/brainfuck/license)](https://packagist.org/packages/dotzero/brainfuck)

This is PHP implementation of interpreter for Brainfuck.

The brainfuck programming language is an esoteric programming language
noted for its extreme minimalism. It is a Turing tarpit, designed
to challenge and amuse programmers, and is not suitable for practical use.

## Usage

```php
$code = <<<EOT
++++++++++[>+++++++>++++++++++>+++>+<<<<-]>++
.>+.+++++++..+++.>++.<<+++++++++++++++.>.+++.
------.--------.>+.>.
EOT;

$bf = new Brainfuck($code);
$bf->run();
```

## Install

### Via composer:

```bash
$ composer require dotzero/brainfuck
```

### Without composer

Clone the project using:

```bash
$ git clone https://github.com/dotzero/brainfuck-php
```

and include the source file with:

```php
    require_once("brainfuck-php/src/Brainfuck.php");
```

## Test

First install the dependencies, and after you can run:

```bash
$ vendor/bin/phpunit
```

## License

Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
