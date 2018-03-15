<?php

// https://codefights.com/arcade/code-arcade/at-the-crossroads/QrCSNQWhnQoaK9KgK/solutions

function arithmeticExpression($a, $b, $c) {
    // check if any of the four possible expressions is true
    return $a + $b == $c || $a - $b == $c || $a * $b == $c || $a / $b == $c;
}


