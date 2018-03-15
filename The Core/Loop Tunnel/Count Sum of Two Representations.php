<?php

// https://codefights.com/arcade/code-arcade/loop-tunnel/hBw5BJiZ4LmXcy92u/solutions

function countSumOfTwoRepresentations2($n, $l, $r) {
  
    $diff = min($n-$l,$r) - max($n-$r,$l);

    return max(0, floor(($diff+2)/2));
}

