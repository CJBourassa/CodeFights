<?php

// https://codefights.com/arcade/graphs-arcade/in-the-pseudoforest/PfY5xCr3SYfSmAgar/solutions

function walkingInTheWoods($n, $wmap){
    
    // build adjacency list
    foreach ($wmap as $edge){
        $al[$edge[0]][] = $edge[1];
        $al[$edge[1]][] = $edge[0];
    }
    
    // pull a node that's not visited yet and run BFS.
    // the answer will be the number of BFS you had to 
    // perform to visit all the nodes 
    $count = -1;
    $unvisited = range(0, $n-1);
    
    while ($unvisited){
        
        $count++;
        $q[] = array_pop($unvisited);
        
        while ($q){
            $node = array_pop($q);
            
            foreach ($al[$node] as $neighbor)
                if (isset($unvisited[$neighbor])){
                    $q[] = $neighbor;
                    unset($unvisited[$neighbor]);
                }
        }
    }

    return $count;
}