<?php

// https://codefights.com/arcade/code-arcade/corner-of-0s-and-1s/eC2Zxu5H5SnuKxvPT/solutions

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
