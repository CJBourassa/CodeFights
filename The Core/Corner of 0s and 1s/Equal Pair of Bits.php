<?php
/* You're given two integers, n and m. Find position of the rightmost pair of 
 * equal bits in their binary representations (it is guaranteed that such 
 * a pair exists), counting from right to left.
 */

function equalPairOfBits($n, $m) {
  return $n + $m + 1 & ~($m) - $n ;
}

