<?php

// https://codefights.com/arcade/graphs-arcade/orienteering/TYt5rotw5phqWRuTF

function orienteeringBeginner($n, $roads) {
    
    // prefil distance array with PHP version of infinity
    $distance = array_fill(0, $n, PHP_INT_MAX);
    
    // distance to start is 0
    $distance[0] = 0;
    
    // create priority queue 
    $pq = new splPriorityQueue();
    $pq->setExtractFlags(SplPriorityQueue::EXTR_BOTH);
    $pq->insert(0, 0);
    
    // BFS until the queue is empty
    while (!$pq->isEmpty()) {
        
        // extract node and it's cost to get there
        $node = $pq->extract();
        $u = $node["data"];
        $w = $node["priority"] * -1;

        // for each vertex $v adjacent to $u
        foreach ($roads[$u] as list($v, $x)) {
            
            // cost from getting from $u to $v
            $cost = $w + $x;
            
            // if path from $u to $v is shorter than previously encountered
            if ($distance[$v] > $cost){
                
                // update the distance to $v
                $distance[$v] = $cost;
                
                // and add $v to the priority queue
                $pq->insert($v, -1 * $cost);
            } // end of if
        } // end of foreach
    } // end of while
    
    return $distance[$n-1];
}
