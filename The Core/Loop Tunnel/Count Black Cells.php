<?php

// https://codefights.com/arcade/code-arcade/loop-tunnel/RcK4vupi8sFhakjnh/description

function countBlackCells($n, $m) {
    
    return $n + $m + getGCD($n, $m) - 2;
}

function getGCD($a, $b){
    
    while ($b){
        $temp = $a % $b;
        $a = $b;
        $b = $temp;
    }
    
    return $a;
}
