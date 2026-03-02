<?php

class Calculator
{
    private $argumentErrorMsg = "Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.";

    public function calc($operator = null, $num1 = null, $num2 = null)
    {
    
        if ($operator === null || $num1 === null || $num2 === null) {
            return "<p>{$this->argumentErrorMsg}</p>";
        }


        if (!is_string($operator) || !in_array($operator, ["+", "-", "*", "/"])) {
            return "<p>{$this->argumentErrorMsg}</p>";
        }

   
        if ((!is_int($num1) && !is_float($num1)) || (!is_int($num2) && !is_float($num2))) {
            return "<p>{$this->argumentErrorMsg}</p>";
        }

    
        if ($operator === "/" && $num2 == 0) {
            $answer = "cannot divide a number by zero";
            return "<p>The calculation is {$num1} {$operator} {$num2}. The answer is {$answer}.</p>";
        }

      
        $answer = 0;

        if ($operator === "+") {
            $answer = $num1 + $num2;
        } elseif ($operator === "-") {
            $answer = $num1 - $num2;
        } elseif ($operator === "*") {
            $answer = $num1 * $num2;
        } elseif ($operator === "/") {
            $answer = $num1 / $num2;
        }

        return "<p>The calculation is {$num1} {$operator} {$num2}. The answer is {$answer}.</p>";
    }
}