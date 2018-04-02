<?php

// https://codefights.com/arcade/graphs-arcade/neverending-grids/DAgKs7P6tw5CrYnkG

function painterBot($canvas, $operations, $d) {
    // credit to Besnik. I had a different solution that would only pass TLE wall 1 out of 20 submits.
    $m = count($canvas);
    $n = count($canvas[0]);

    foreach ($operations as list($x, $y, $color)) 
        floodFill($canvas, $x, $y, $color, $d, $m, $n);
    
    return $canvas;
}

function floodFill(&$canvas, $x, $y, $color, $d, $m, $n) {
    $initial = $canvas[$x][$y];
    $queue = [[$x,$y]];
    $visited = [];
    while (count($queue)) {
        list($i, $j) = array_pop($queue);
        if (!isset($visited[$i*$n + $j]) && abs($canvas[$i][$j] - $initial) <= $d) {
            $canvas[$i][$j] = $color;
            $visited[$i*$n + $j] = true;
            if ($i > 0 && !isset($visited[$i*$n + $j - $n])) $queue[] = [$i - 1, $j];
            if ($i < $m-1 && !isset($visited[$i*$n + $j + $n])) $queue[] = [$i + 1, $j];          
            if ($j > 0 && !isset($visited[$i*$n + $j - 1])) $queue[] = [$i, $j - 1];
            if ($j < $n-1 && !isset($visited[$i*$n + $j + 1])) $queue[] = [$i, $j + 1];          
        }
    }
}
