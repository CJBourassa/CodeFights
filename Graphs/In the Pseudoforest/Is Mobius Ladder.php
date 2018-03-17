<?php

// https://codefights.com/arcade/graphs-arcade/in-the-pseudoforest/9MPHNYoJQeviGsBEf/solutions

function isMobiusLadder($n, $ladder) {
    // There needs to be exactly 3 edges per node
    if (count($ladder) != 3 * $n / 2) return false;
    
    // needs to be an even number of vertices
    if ($n % 2) return false;
    
    // if the first test passed then this has to be a mobius ladder
    if ($n == 4) return true; 

    // build adjacency list
    foreach ($ladder as $edge){
        $al[$edge[0]][] = $edge[1];
        $al[$edge[1]][] = $edge[0];
    }
    
    // The only thing left to check is the length of cycles in the graph
    // For this to be a mobius ladder, there can't be any cycles of length 3
        // i is node 1, u is node 2, and v is node 3
        // if there is a path such that
            // i->u->v->i then this is not a mobius ladder
    for ($i=0; $i<$n;$i++)
        foreach ($al[$i] as $u)
            foreach ($al[$u] as $v)
                if (in_array($i, $al[$v]))
                    return false;
    
    return true;
}


