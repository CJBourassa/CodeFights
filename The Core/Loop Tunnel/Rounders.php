<?php

// https://codefights.com/arcade/code-arcade/loop-tunnel/H5PP5MXvYvWXxTytH/solutions

function rounders($value) {
  
    $value = str_split($value);
    $res = [];
    $toCarry = 0;
    $firstDigit = array_shift($value);

    while ($value){
        $dig = array_pop($value) + $toCarry;
        array_unshift($res, 0);
        $toCarry = ($dig < 5) ? 0 : 1;
    }
    
    array_unshift($res, $firstDigit + $toCarry);
    return +join($res);
}