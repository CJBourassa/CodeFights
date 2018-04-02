<?php

// https://codefights.com/arcade/graphs-arcade/orienteering/vhRnxuezwBeLjy7y3/solutions

function timeConstrainedOrienteering2($n, $roads){
    
    // modified floyd warshall algorithm to store the smallest edge along a path from i to j
    for ($k = 0; $k < $n; $k++)
         for ($i = 0; $i < $n; $i++)
             if ($roads[$i][$k] != -1)
                 for ($j = 0; $j < $n; $j++)
                     if ($roads[$k][$j] != -1)
                        if ($roads[$i][$j] == -1 || max($roads[$i][$k],$roads[$k][$j]) < $roads[$i][$j])
                            $roads[$i][$j] = max($roads[$i][$k], $roads[$k][$j]);
                
    return $roads;
}

/* VERY TIGHT TIMING -- Need to resubmit solution a few times 
            
    // load our result matrix with -1 (everything unconnected)
    $result = array_fill(0,$n, array_fill(0,$n,-1));
    
    // build priority queue
        $pq = new splPriorityQueue();
        $pq->setExtractFlags(SplPriorityQueue::EXTR_DATA);
    
    // Build a MST using every vertex $u as a root node
    for ($u = 0; $u < $n; $u++) {
        
        // add neighbors of u to our priority queue
        foreach ($roads[$u] as $v=>$cost)
            if ($cost != -1)
                $pq->insert([$v, $cost], -1 * $cost);
        
        
        // reset maximum edge cost in MSP
        $maxEdgeCost = 0;
        
        // distance from vertex u to itself is 0
        $result[$u][$u] = 0;
        
        // reset MST array 
        $included = [];
        $included[$u] = true;
    
        while (!$pq->isEmpty()) {
            // pull lowest cost edge from priority que
            list($v, $cost) = $pq->extract();
            
            // skip this vertex if it's in our MST
            if ($included[$v])continue;
            $included[$v] = true;
            
            // update maximum edge cost to this edge's cost if it's greater
            $maxEdgeCost = max($maxEdgeCost, $cost);
            
            // set the highest edge cost from u to v
            $result[$u][$v] = $maxEdgeCost;
            
            // add neighbors of v to our priority queue
            foreach ($roads[$v] as $k => $cost)
                if ($cost != -1)
                    $pq->insert([$k, $cost], -1 * $cost);
        } // end of BFS while
    } // end of $n while
    return $result;
*/