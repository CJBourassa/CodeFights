<?php
//Given an integer n, return the largest number that contains exactly n digits.

//Example
//For n = 2, the output should be
//largestNumber(n) = 99.

//[execution time limit] 4 seconds (php)

//[input] integer n
//Guaranteed constraints:
//1 ≤ n ≤ 9.

//[output] integer
//The largest integer of length n.

function largestNumber($n) {;
    return substr(9999999, 0, $n);
}

