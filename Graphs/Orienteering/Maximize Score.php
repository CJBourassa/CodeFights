<?php

// https://codefights.com/arcade/graphs-arcade/orienteering/vy2GgGTkFW2s5Antu/solutions

function maximizeScore($n, $roads) {
    $max = $min = 100000;
    $distance = array_fill(0, $n, array_fill(0, $n, $max));
    
    // build distance matrix
    for ($i=0; $i<$n;$distance[$i][$i] = 0, $i++)
        foreach ($roads[$i] as list($node, $cost))
            $distance[$i][$node] = $cost;
    
    // run floyd warshall algorithm to get node distances
    for ($k = 0; $k < $n; $k++)
         for ($i = 0; $i < $n; $i++)
             if ($distance[$i][$k] != $max)
                 for ($j = 0; $j < $n; $j++)
                    if ($distance[$k][$j] != $max && $distance[$i][$k] + $distance[$k][$j] < $distance[$i][$j])
                        $distance[$i][$j] = $distance[$i][$k] + $distance[$k][$j];
          
    // find the lowest number in the distance matrix
    for ($i = 0; $i < $n; $i++)
        for ($j = 0; $j < $n;$j++)
            if ($distance[$i][$j] < $min && $i != $j){
                $result = [$i, $j];
                $min = $distance[$i][$j];
            }  
    
    return $result;
}
