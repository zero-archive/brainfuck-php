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
     * @var null|string Source code
     */
    private $code = null;

    /**
     * @var int Source code pointer
     */
    private $code_pointer = 0;

    /**
     * @var array Data cells
     */
    private $cells = array();

    /**
     * @var int Data cell pointer
     */
    private $pointer = 0;

    /**
     * @var null|string User input
     */
    private $input = null;

    /**
     * @var int User input pointer
     */
    private $input_pointer = 0;

    /**
     * @var array Buffer
     */
    private $buffer = array();

    /**
     * @var string Output
     */
    private $output = '';

    /**
     * @var boolean Wrap over/underflows?
     */
    private $wrap = true;

    /**
     * Brainfuck constructor.
     *
     * @param string $code Source code
     * @param null|string $input User input
     */
    public function __construct($code, $input = null, $wrap = null)
    {
        $this->code = $code;
        $this->input = ($input) ? $input : null;
        $this->wrap = (boolean) $wrap;
    }

    /**
     * Execute Brainfuck interpreter
     *
     * @param bool $return
     * @return string
     */
    public function run($return = false)
    {
        while ($this->code_pointer < strlen($this->code)) {
            $this->interpret($this->code[$this->code_pointer]);
            $this->code_pointer++;
        }

        if ($return) {
            return $this->output;
        } else {
            echo $this->output;
        }
    }

    /**
     * Command interpreter
     *
     * @param $command
     */
    private function interpret($command)
    {
        if (!isset($this->cells[$this->pointer])) {
            $this->cells[$this->pointer] = 0;
        }

        switch ($command) {
            case '>' :
                $this->pointer++;
                break;
            case '<' :
                $this->pointer--;
                break;
            case '+' :
                $this->cells[$this->pointer]++;
                if ($this->wrap && $this->cells[$this->pointer] > 255) {
                    $this->cells[$this->pointer] = 0;
                }
                break;
            case '-' :
                $this->cells[$this->pointer]--;
                if ($this->wrap && $this->cells[$this->pointer] < 0) {
                    $this->cells[$this->pointer] = 255;
                }
                break;
            case '.' :
                $this->output .= chr($this->cells[$this->pointer]);
                break;
            case ',' :
                if (isset($this->input[$this->input_pointer])) {
                    $this->cells[$this->pointer] = ord($this->input[$this->input_pointer]);
                }
                $this->input_pointer++;
                break;
            case '[' :
                if ($this->cells[$this->pointer] == 0) {
                    $delta = 1;
                    while ($delta AND $this->code_pointer++ < strlen($this->code)) {
                        switch ($this->code[$this->code_pointer]) {
                            case '[' :
                                $delta++;
                                break;
                            case ']' :
                                $delta--;
                                break;
                        }
                    }
                } else {
                    $this->buffer[] = $this->code_pointer;
                }
                break;
            case ']' :
                $this->code_pointer = array_pop($this->buffer) - 1;
        }
    }
}
