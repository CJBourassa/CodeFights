<?php

// https://codefights.com/arcade/code-arcade/intro-gates/HEsmEacHr2s9wahjr/solutions

function maxMultiple($divisor, $bound) {
    // $divisor is a factor of $bound, $bound has to be the highest integer
    // otherwise the highest integer that is a multiple of $divisor and is less than $bound
    return $bound%$divisor ? floor($bound / $divisor) * $divisor : $bound;
}
