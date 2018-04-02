<?php

// https://codefights.com/arcade/graphs-arcade/orienteering/8uttYsx5KxhJ3gsgz/solutions

function trainingRoute($n, $roads, $route) {
    
    // create distance array, filled with PHP version of infinity
    $distance = array_fill(0, $n, PHP_INT_MAX);
    
    // create distancse matrix, filled with NULL
    $distances = array_fill(0, $n, array_fill(0, $n, NULL));
    
    // go through the route array
    for ($i=0; $i<count($route)-1;$i++){
        // count the number of similar routes
        $num[$route[$i]][$route[$i+1]]++;
        // store the start/finish as a pair and include clean distance array
        $pairs[] = [$route[$i], $route[$i+1], $distance];
    }
    
    
    foreach ($pairs as list($startNode, $finishNode, $distance)){
        
        // if I've already visited this start/finish pair then 
        // I've already added it to the total
        if ($vis[$startNode][$finishNode])continue;
        // add start node to queue
        $p[] = $startNode;
        // distance to start node to itself is 0
        $distance[$startNode] = 0;
        // only run DFS if I haven't already aquired the shortest routes from this node to all others
        if (!$shortestPathsFound[$startNode]){
            while ($p) {
                // pop is equally as fast as shift ... according to TLE wall
                $u = array_pop($p);
                
                // remove u from my boolean queue array 
                $inq[$u] = false;
                
                // foreach neighbor of u
                foreach ($roads[$u] as list($v, $cost)){
                    
                    // if the path from u to v is shorter than previously recorded
                    if ($distance[$u] + $cost < $distance[$v]) {
                        
                        // update distance 
                        $distance[$v] = $distance[$u] + $cost;
                        
                        // if v isn't already in our queue, add it and set inq flag
                        if (!$inq[$v]){
                            $p[] = $v;
                            $inq[$v] = true;
                        }
                    } 
                } // end foreach
            } // end while
        
            // add distance to the finish node times the number of repeated pairs
            $total += $distance[$finishNode] * $num[$startNode][$finishNode];
            // mark this pair as visited
            $vis[$startNode][$finishNode] = $shortestPathsFound[$startNode] = true;
            // store distance array in our matrix
            $distances[$startNode] = $distance;
        }else
            // I've already found the shortest paths from start node, so add it to the total
            $total += $distances[$startNode][$finishNode];
    }
    
    return $total;
}

