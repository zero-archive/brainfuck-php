<?php

use \dotzero\Brainfuck;

class BrainfuckTest extends PHPUnit_Framework_TestCase
{
    private $examples = null;

    protected function setUp()
    {
        $this->examples = realpath(__DIR__ . '/../examples');
    }

    public function testExampleHelloWorld()
    {
        $code = file_get_contents($this->examples . '/hello_world.bf');

        $bf = new Brainfuck($code);

        $this->assertEquals('Hello World!' . PHP_EOL, $bf->run(true));
    }

    public function testExamplePrintInput()
    {
        $code = file_get_contents($this->examples . '/print_input.bf');
        $input = 'Foo bar?!';

        $bf = new Brainfuck($code, $input);

        $this->assertEquals($input, $bf->run(true));
    }

    public function testExampleSort()
    {
        $code = file_get_contents($this->examples . '/sort.bf');
        $input = array(1, 2, 3, 4, 5, 6, 7, 8, 9);

        shuffle($input);

        $bf = new Brainfuck($code, $input);

        sort($input);

        $this->assertEquals(implode('', $input), $bf->run(true));
    }
}
