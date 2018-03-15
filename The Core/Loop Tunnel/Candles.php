<?php

// https://codefights.com/arcade/code-arcade/loop-tunnel/LAKReA3CR9EwkZGSz/solutions

function candles($candlesNumber, $makeNew) {
    
    $total = $burnt = $leftovers = $candlesNumber;

    while ($leftovers >= $makeNew){
        $c = floor($leftovers / $makeNew);
        $total += $c;
        $leftovers = $c + ($leftovers - $c * $makeNew);
    }

    return $total;
}