<?php

// https://codefights.com/arcade/code-arcade/corner-of-0s-and-1s/KeMqde6oqfF5wBXxf/solutions

function arrayPacking($a) {
    // convert array values to binary
    $a = array_map('decbin',$a);

    // left pad array values with 0, if needed
    $a = array_map('pad', $a);

    // reverse the array to obtain the correct format
    $a = array_reverse($a);

    // join the binary values together and convert back to decimal
    return bindec(join($a));
    }

function pad ($int){
    return str_pad($int, 8, '0', STR_PAD_LEFT);
}
