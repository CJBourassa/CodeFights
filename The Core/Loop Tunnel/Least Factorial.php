<?php

// https://codefights.com/arcade/code-arcade/loop-tunnel/7BFPq6TpsNjzgcpXy/solutions

function leastFactorial($n) {

    for ($v = $k = 1; $k < $n;$v++)
        $k *= $v;

    return $k;
}