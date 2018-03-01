<?php
// You are given a two-digit integer n. Return the sum of its digits.

// Example
// For n = 29, the output should be
// addTwoDigits(n) = 11.

// [execution time limit] 4 seconds (php)

// [input] integer n
// A positive two-digit integer.
// Guaranteed constraints:
// 10 ≤ n ≤ 99.

// [output] integer
// The sum of the first and second digits of the input number.

function addTwoDigits($n) {
// split the digits apart and sum them together
return array_sum(str_split($n)); 
}
?>
