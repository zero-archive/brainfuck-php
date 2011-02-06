<?php
require '../libs/brainfuck.php';

if(file_exists($argv[1]))
{
    $code = file_get_contents($argv[1]);
    $bf = new Brainfuck($code, $argv[2]);
    $bf->run();
}