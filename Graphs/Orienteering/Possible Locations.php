<?php

// https://codefights.com/arcade/graphs-arcade/orienteering/zTPmRGxZ4EXXp6Rzk/solutions

function possibleLocations($n, $roads) {
    
    // initialize our resultant pairs array
    $pairs = [];
    
    // create variable to store PHP version of infinity
    $max = PHP_INT_MAX;
    
    // create distance matrix, initializing all values to $max
    $distance = array_fill(0, $n, array_fill(0, $n, $max));
    
    // build distance matrix
    for ($u=0; $u<$n;$distance[$u][$u++])
        foreach ($roads[$u] as list($v, $cost))
            $distance[$u][$v] = $cost;
    
    // run floyd warshall algorithm to get vertices apart of a negative cycle
    // vertices apart of a negative cycle will have a negative distance to themselves
    for ($k = 0; $k < $n; $k++)
         for ($i = 0; $i < $n; $i++)
             if ($distance[$i][$k] != $max)
                 for ($j = 0; $j < $n; $j++)
                    if ($distance[$k][$j] != $max)
                        $distance[$i][$j] = min($distance[$i][$j], $distance[$i][$k] + $distance[$k][$j]);
                 
    // run floyd warshall algorithm again to check if there exists 
    // a vertex in a negative cycle along a path from u -> v
    for ($u = 0; $u < $n;$u++){
        // if vertex u is directly apart of a negative cycle, skip it
        if ($distance[$u][$u] < 0)continue;
            for ($v = 0; $v < $n;$v++){
                // u not equal to v and v isn't apart of a negative cycle and there exists a path from u to v
                if ($u != $v && $distance[$v][$v] >= 0 && $distance[$u][$v] < $max)
                    // then there's a chance this vertex v form a pair with u
                    $flag = true;
                else
                    // otherwise continue to next vertex v
                    continue;
                
                for ($k = 0; $k < $n && $flag;$k++)
                    // u can enter a negative cycle on its way to v if
                    // k is a part of a negative cycle and there exists a path from u to k and k to v
                    if ($distance[$k][$k] < 0 && $distance[$u][$k] < $max && $distance[$k][$v] < $max)
                        $flag = false;
                
                // if we didn't detect a negative cycle on our way from u to v, then they are a legitimate pair
                if ($flag)
                    $pairs[] = [$u,$v];
            } // end v for     
    } // end u for

    return $pairs;
}