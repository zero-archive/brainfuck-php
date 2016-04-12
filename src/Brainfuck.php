<?php

namespace dotzero;

/**
 * Class Brainfuck
 *
 * A PHP implementation of interpreter for Brainfuck.
 *
 * @package dotzero
 * @version 1.0
 * @author dotzero <mail@dotzero.ru>
 * @link http://www.dotzero.ru/
 * @link https://github.com/dotzero/brainfuck-php
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Brainfuck
{
    /**
     * Source code & pointer
     */
    private $code = NULL;
    private $code_pointer = 0;

    /**
     * Data cells & pointer
     */
    private $cells = array();
    private $pointer = 0;

    /**
     * User input & pointer
     */
    private $input = NULL;
    private $input_pointer = 0;

    /**
     * Stack
     */
    private $buffer = array();

    /**
     * @param string $code
     * @param string $input
     */
    public function __construct($code, $input = FALSE)
    {
        $this->code = $code;
        $this->input = ($input) ? $input : FALSE;
    }

    /**
     * Execute interpreter
     */
    public function run()
    {
        while($this->code_pointer < strlen($this->code))
        {
            $this->interpret($this->code[$this->code_pointer]);
            $this->code_pointer++;
        }
    }

    /**
     * Commands interpreter
     *
     * @param string $command
     */
    private function interpret($command)
    {
        if (!isset($this->cells[$this->pointer])) {
            $this->cells[$this->pointer] = 0;
        }

        switch ($command)
        {
            case '>' :
                $this->pointer++;
                break;
            case '<' :
                $this->pointer--;
                break;
            case '+' :
                $this->cells[$this->pointer]++;
                break;
            case '-' :
                $this->cells[$this->pointer]--;
                break;
            case '.' :
                echo chr($this->cells[$this->pointer]);
                break;
            case ',' :
                if (isset($this->input[$this->input_pointer])) {
                    $this->cells[$this->pointer] = ord($this->input[$this->input_pointer]);
                }
                $this->input_pointer++;
                break;
            case '[' :
                if($this->cells[$this->pointer] == 0)
                {
                    $delta = 1;
                    while($delta AND $this->code_pointer++ < strlen($this->code))
                    {
                        switch ($this->code[$this->code_pointer])
                        {
                            case '[' : $delta++; break;
                            case ']' : $delta--; break;
                        }
                    }
                }
                else
                {
                    $this->buffer[] = $this->code_pointer;
                }
                break;
            case ']' :
                $this->code_pointer = array_pop($this->buffer) - 1;
        }
    }
}
