<?php

// https://codefights.com/arcade/code-arcade/loop-tunnel/LbuWRHnMoJH9SAo4o

function magicalWell($a, $b, $n) {
    
    for ($i=1;$i <= $n; $i++, $a++, $b++)
        $total += $a * $b;

    return +$total;
}
