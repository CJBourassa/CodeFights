<?php
// Given a divisor and a bound, find the largest integer N such that:
//   N is divisible by divisor.
//   N is less than or equal to bound.
//   N is greater than 0.
//   It is guaranteed that such a number exists.

//  Example
//  For divisor = 3 and bound = 10, the output should be
//  maxMultiple(divisor, bound) = 9.
//  The largest integer divisible by 3 and not larger than 10 is 9.

//  execution time limit] 4 seconds (php)

// [input] integer divisor
// Guaranteed constraints:
// 2 ≤ divisor ≤ 10.

// [input] integer bound
// Guaranteed constraints:
// 5 ≤ bound ≤ 100.

// [output] integer
// The largest integer not greater than bound that is divisible by divisor.


function maxMultiple($divisor, $bound) {
// $divisor is a factor of $bound, $bound has to be the highest integer
if (!($bound%$divisor)) return $bound;
// the highest integer that is a multiple of $divisor and is less than $bound
else return floor($bound / $divisor) * $divisor;
}