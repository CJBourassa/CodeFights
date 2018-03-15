<?php

// https://codefights.com/arcade/code-arcade/at-the-crossroads/aFF9HDm2Rsti9j5kc/solutions

function isInfiniteProcess($a, $b) {
    // true if...
    // $a is even and $b is odd
    // or
    // $b is even and $a is odd
    // or
    // $a > $b 
    return !($a%2) && $b%2 || !($b%2) && $a%2 || $a > $b;
}
