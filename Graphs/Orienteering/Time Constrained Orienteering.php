<?php

// https://codefights.com/arcade/graphs-arcade/orienteering/eoScXP4FKuWtcEuGQ

function timeConstrainedOrienteering($n, $start, $roads) {
    
    // build adjacency list
    foreach ($roads as list($u, $v, $cost)){
        $al[$u][] = [$u, $v, $cost];
        $al[$v][] = [$v, $u, $cost];
    }
    
    // create priority queue
    $pq = new splPriorityQueue();
    $pq->setExtractFlags(SplPriorityQueue::EXTR_DATA);

    // add all neighbors of starting vertex to the priority queue
    foreach ($al[$start] as list($u, $v, $cost))
        $pq->insert([$u, $v, $cost], -1 * $cost);

    // mark the starting node as being in the minimum spanning tree
    $inTree[$start] = true;
    
    // Any edge we take from the start will have a unique weight
    $count = 1;
    
    // initialize a variable to keep track of how many nodes are left to explore
    $nodesLeft = $n - 1;
    
    // while there are nodes left to be explored
    while ($nodesLeft){
        
        // exactract an edge with the lowest cost from the priority queue
        list($from, $to, $cost) = $pq->extract();

        // if the edge connects two vertices we've already added to the MST, skip it
        if ($inTree[$to] && $inTree[$from])continue;
        
        // check which of the two vertices we need to explore
        $target = $inTree[$from] ? $to : $from;

        // add all edges connected to $target
        foreach ($al[$target] as $edge)
            $pq->insert($edge, -1 * $edge[2]);
        
        // add target to tree
        $inTree[$target] = true;
        $nodesLeft--;

        // if the cost is greater than the current max then we MUST have reached
        // a node in the MST that has a unique (greater) value than every other
        // path in the tree
        if ($cost > $currentMax){
            $currentMax = $cost;
            $count++;
        }
    }
    return $count;
}
