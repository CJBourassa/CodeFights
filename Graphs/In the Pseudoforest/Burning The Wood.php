<?php

// https://codefights.com/arcade/graphs-arcade/in-the-pseudoforest/GeaKuCxLvje3bfsBx/solutions

function burningTheWood($n, $wmap, $start, $k) {
    
    // build adjacency matrix
    foreach ($wmap as $edge){
        $al[$edge[0]][] = $edge[1];
        $al[$edge[1]][] = $edge[0];
    }
    
    // add the starting node to the result and nextlevelnodes array
    $result[] = $nextLevelNodes[] = $start;
    
    // k represents the levels we will be traversing during the BFS
    for ($i=0; $i<$k;$i++){
        
        // nextList stores all the nodes in the ith level of the BFS
        $currentLevelNodes = $nextLevelNodes;
        
        // clear our next level nodes array for next traversal
        $nextLevelNodes = [];
        
        // for each node in the i'th level of the BFS 
        foreach ($currentLevelNodes as $node){
            
            // mark it as visited
            $visited[$node] = true;
            
            // if unvisited, mark it as visited and 
            // add to nextlevelnodes array and result
            foreach ($al[$node] as $neighbor)
                if (!$visited[$neighbor]){
                    $visited[$neighbor] = true;
                    $nextLevelNodes[] = $result[] = $neighbor;
                }
        
        }
    }
    // sort the results, per requested output
    sort($result);
    
    return $result;
}
