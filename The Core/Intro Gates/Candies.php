<?php

// https://codefights.com/arcade/code-arcade/intro-gates/DdNKFA3XCX6XN7bNz

function candies($n, $m) {
    // floor($m / $n) represents the number of candies that each child can get
    // Multiply this value by the number of children to get the total number of 
    // candies that will be given
    return floor($m / $n) * $n;
}
