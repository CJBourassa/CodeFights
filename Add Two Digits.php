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

$n = strval($n); // Turn the two digit number into a string
  
// Strings are stored as arrays in PHP, 
// so read each digit as your would if 
// they were stored in an array;
return $n[0] + $n[1]; 
}
?>
