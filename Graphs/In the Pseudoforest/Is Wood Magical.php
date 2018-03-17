<?php

// https://codefights.com/arcade/graphs-arcade/in-the-pseudoforest/kqiRXc3R35xPfZyCf/solutions

function isWoodMagical($n, $wmap) {
    
    // build adjacency list
    foreach ($wmap as $edge){
        $adjacencyList[$edge[0]][] = $edge[1];
        $adjacencyList[$edge[1]][] = $edge[0];
    }
    
    // create array to store color of vertices (-1 means uncolored)
    $colored = array_fill(0,$n,0);

    // change $n to $vertice for clarity
    $vertice = $n;
    $color = -1;

    // perform a BFS on every node and see if there are any coloring conflicts
    while ($vertice-- >= 0) {
       if (!$colored[$vertice]){
           
           $oldList[] = $vertice;
           $colors[$vertice] = $color;
           $color *= -1;
           
           while ($oldList){
               $newList = [];
               foreach ($oldList as $node)
                   foreach ($adjacencyList[$node] as $neighbor)
                       if (!$colored[$neighbor]){
                           $colored[$neighbor] = $color;
                           $newList[] = $neighbor;
                       }else if ($colored[$neighbor] != $color)
                           return false;
               
               $oldList = $newList;
               $color *= -1;
           }
           $oldList = [];
       }
    }
    return true;
}