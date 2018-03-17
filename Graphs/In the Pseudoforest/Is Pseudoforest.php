<?php

// https://codefights.com/arcade/graphs-arcade/in-the-pseudoforest/4neXxESSsRy92ghTD/solutions

function isPseudoforest($n, $wmap) {
    
    // create adjacency list
    foreach ($wmap as $edge){
        $al[$edge[0]][] = $edge[1];
        $al[$edge[1]][] = $edge[0];
    }
 
    // build array of unvisited nodes
    $unvisited = range(0, $n-1);
    
    // while there is a node we haven't visited...
    while ($unvisited) {

        // set cycles to 0 for this tree
        $cycles = 0;
        
        // kickstart our queue with unvisited vertex and parent (null) pair
        $q[] = [array_pop($unvisited), null];
               
        // while our queue isn't empty
        while ($q) {
            
            // pull node/parent pair from queue
            list($node, $parent) = array_pop($q);
            
            // for each vertice connected to this node
            foreach ($al[$node] as $neighbor) {
                
                // check if the neighbor has already been visited
                if (isset($unvisited[$neighbor])) {
                    
                    // neighbor is unvisited, mark it as visited and add it to the que 
                    unset($unvisited[$neighbor]);
                    $q[] = [$neighbor, $node];
            
                // neighbor has been visited. 
                // If it has a parent and it isn't our neighbor 
                // then we've just detected a cycle
                } elseif ($parent && $parent != $neighbor) {
                    $cycles++;
                    if ($cycles == 3) 
                        return false;
                }
            }
        }
    }
    return true;
}