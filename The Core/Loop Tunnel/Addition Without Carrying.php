<?php

// https://codefights.com/arcade/code-arcade/loop-tunnel/xzeZqCQjpfDJuN72S/solutions

function additionWithoutCarrying($param1, $param2) {
    
    $res = [];
    $param1 = str_split($param1);
    $param2 = str_split($param2);
    
    while ($param1 || $param2){
        $dig1 = array_pop($param1);
        $dig2 = array_pop($param2);
        $digSum = ($dig1 + $dig2)%10;
        array_unshift($res, $digSum);
    }
    return +join($res);
}
