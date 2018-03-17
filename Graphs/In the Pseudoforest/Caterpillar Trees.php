<?php

// https://codefights.com/arcade/graphs-arcade/in-the-pseudoforest/EywKKTcqGrfbavDrw/solutions

function caterpillarTrees($n, $edges) {
    
    // build adjacency list
    foreach ($edges as $edge){
        $al[$edge[0]][] = $edge[1];
        $al[$edge[1]][] = $edge[0];
    }
    
    // create unvisited and visited array to track node traversal
    $unvisited = range(0, $n-1);
    $visited = array_fill(0, $n, false);
    
    // BFS until there is no node left unvisited
    while ($unvisited){
        
        // during BFS we will try to disprove that 
        // the graph is a tree and/or caterpillar
        $isCaterpillar = $isTree = true;
        
        // kickstart BFS with node from unvisited
        $q[] = array_pop($unvisited);
        
        while ($q) {
            
            $node = array_pop($q);
            
            // if I've already visited this node then there 
            // has to be a cycle in the graph - a property of 
            // neither Caterpillars nor Trees
            if ($visited[$node])
                $isCaterpillar = $isTree = false;
            
            $degreeCount = 0;
            
            // check every neighbor vertex connected to node
            foreach ($al[$node] as $neighbor){
                
                // if a neighbor has 2 or more neighbors, 
                // it's a part of the main path OR a divergance
                if (count($al[$neighbor]) >= 2)
                    $degreeCount++;
                
                // main path can only have two nodes with 2 or more neighbors
                // a degree count of 3 means there's a divergance from the main path
                if ($degreeCount == 3)
                    $isCaterpillar = false;

                // add neighboring node to the queue if I haven't visited it
                if (!$visited[$neighbor])
                     $q[] = $neighbor;
                
             
            } // all neighbors of $node have been explored
            
            // mark the node as visited 
            $visited[$node] = true;
            // and remove from unvisited array
            unset($unvisited[$node]);
            
        } // this tree has been explored
        
        // true is 1 and false is 0, so just add the flags to the counters
        $Trees += $isTree;
        $Caterpillar+= $isCaterpillar;
        
    } // every node has been visited

    // + sign casts variable to integer, so null values become 0
    return [+$Trees,+$Caterpillar];
}   