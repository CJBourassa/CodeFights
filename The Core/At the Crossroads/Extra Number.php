<?php
//You're given three integers, a, b and c. It is guaranteed that two of these 
//integers are equal to each other. What is the value of the third integer?

//Example
//For a = 2, b = 7 and c = 2, the output should be
//extraNumber(a, b, c) = 7.
//The two equal numbers are a and c. The third number (b) equals 7, 
//which is the answer.

//[execution time limit] 4 seconds (php)

//[input] integer a
//Guaranteed constraints:
//1 ≤ a ≤ 109.

//[input] integer b
//Guaranteed constraints:
//1 ≤ b ≤ 109.

//[input] integer c
//Guaranteed constraints:
//1 ≤ c ≤ 109.

//[output] integer



function extraNumber($a, $b, $c) {
    if ($a == $b)
        return $c;
    if ($b == $c)
        return $a;
    return $b;
}