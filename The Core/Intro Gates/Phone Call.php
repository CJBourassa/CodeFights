<?php

// https://codefights.com/arcade/code-arcade/intro-gates/mZAucMXhNMmT7JWta

function phoneCall($min1, $min2_10, $min11, $s) {
    // if I don't have the funds for the first minute, call duration is 0
    // else subtract cost of first minute from $s
    if($s < $min1) return 0;
    else $s -= $min1;

    // if I don't have enough cash to spend the next 9 minutes on the phone, 
        // return the longest duration I can have, making sure to add first minute
    // else duduct the cost of being on the phone for 9 minutes @ cost of $min_10
    if($s <= $min2_10 * 9) return 1 + floor($s / $min2_10);
    else $s -= 9 * $min2_10;

    // return the longest duration call I can have with remaining money, making sure
    // to include the previous 10 minutes of conversation
    return 10 + floor($s / $min11);
}
