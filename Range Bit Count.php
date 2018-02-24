<?php

// You are given two numbers a and b where 0 ≤ a ≤ b. Imagine you construct an 
// array of all the integers from a to b inclusive. You need to count the number
//  of 1s in the binary representations of all the numbers in the array.

// Example
// For a = 2 and b = 7, the output should be
// rangeBitCount(a, b) = 11.
// Given a = 2 and b = 7 the array is: [2, 3, 4, 5, 6, 7]. Converting the numbers to binary, we get [10, 11, 100, 101, 110, 111], which contains 1 + 2 + 1 + 2 + 2 + 3 = 11 1s.

// [execution time limit] 4 seconds (php)

// [input] integer a
// Guaranteed constraints:
// 0 ≤ a ≤ b.
// [input] integer b
// Guaranteed constraints:
// a ≤ b ≤ 10.

// [output] integer

function rangeBitCount($a, $b) {
// if both are zero return 0
if (!$a && !$b)
    return 0;
// go through each number and use substr_count to tally up the number of
// 1s in the binary representation of each value from $a -> $b, inclusive
for (;$a <= $b;$a++) 
    $total += substr_count(decbin($a), "1");

return $total;
}
