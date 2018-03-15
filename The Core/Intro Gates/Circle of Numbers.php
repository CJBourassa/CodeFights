<?php
 
// https://codefights.com/arcade/code-arcade/intro-gates/vExYvcGnFsEYSt8nQ

function circleOfNumbers($n, $firstNumber) {
    // opposite number from $firstNumber is found by adding it to
    // the radius and then taking the modulus to account for when
    // $n/2 + $firstNumber >= $n;
    return ($n/2 + $firstNumber) % $n;
}
