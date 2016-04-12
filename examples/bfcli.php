#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use \dotzero\Brainfuck;

if (empty($argv[1])) {
    printf("Using: %s [file] [input to Brainfuck script]\n", $argv[0]);
    exit(1);
}

if (!file_exists($argv[1])) {
    printf("Error: file %s not exists\n", $argv[1]);
    exit(1);
}

$code = file_get_contents($argv[1]);
$input = '';

unset($argv[0], $argv[1]);
if ($argv) {
    $input = implode(' ', $argv);
}

$bf = new Brainfuck($code, $input);
$bf->run();
