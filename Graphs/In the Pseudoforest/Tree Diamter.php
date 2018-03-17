<?php

// https://codefights.com/arcade/graphs-arcade/in-the-pseudoforest/Sby2j4SHqDncwyQjh/solutions

function treeDiameter($n, $tree) {
    global $al; // make adjacency list global to save on baggage
    
    // build adjacency list
    $al = [];
    foreach ($tree as $edge){
         $al[$edge[0]][] = $edge[1];
         $al[$edge[1]][] = $edge[0];
    }
    
    // 1st BFS,starting from node 0 (arbitrary) and fill in distances to all other nodes
    list($node, $maxDistance) = BFS(0);
    // 2nd BFS, starting from the node farthest from node 0
    list($node, $maxDistance) = BFS($node);
    
    return $maxDistance;
}

function BFS($start){
    global $al;
    
    $distance = array_fill(0,$n,-1);
    $distance[$start] = 0;
    $q[] = $start;
    
    while ($q){
        
        $node = array_pop($q);    
        
        foreach ($al[$node] as $neighbor)
            if (!$visited[$neighbor]){
                array_unshift($q, $neighbor);
                $distance[$neighbor] = $distance[$node] + 1;
            }
        
        $visited[$node] = true;
    }
    
    $maxDistance = max($distance);
    $maxDistanceNode = array_search($maxDistance, $distance);

    return [$maxDistanceNode, $maxDistance];
}
