<?php

// https://codefights.com/arcade/graphs-arcade/contours-of-everything/p7YetaqMPd8RSmSff/solutions

function isCorrectlyCut($adj){
    
    $vertices = count($adj);
    $edges = $vertices / 2;
    
    // check that each vertex has the right number of edges
    for ($i = 0; $i < $vertices; $i++) 
        if (array_sum(array_column($adj, $i)) != $edges-1) 
            return false;
    
    // convert adjacency matrix to adjacency list
    $vertices = count($adj);
    for ($i = 0; $i < $vertices;$i++)
        for ($j = $i; $j < $vertices; $j++){
            if ($i == $j && $adj[$i][$j])
                return false; // no self loops
            if ($adj[$i][$j]){
                $al[$i][] = $j;
                $al[$j][] = $i;
            }
        }
    
    // 2 color problem. If I do one BFS, visit every node,
    // and don't run into a coloring conflict, it's correctly cut
    
    // all vertex colors are initially uncolored
    $color = array_fill(0, $vertices, false);
    $visited = array_fill(0, $vertices, false);
    $q[] = 0;
    $color[0] = $nextColor = 1;
    while ($q){
        
        $vertex = array_pop($q);
        
        $nextColor *= -1; // change color from black to red / red to black
        
        foreach ($al[$vertex] as $neighbor){

            if ($color[$neighbor] == $color[$vertex])
                return false;

            if ($color[$neighbor] === false)
                $color[$neighbor] = $nextColor;
            
            if (!$visited[$neighbor])
                $q[] = $neighbor;
        }
        
        $visited[$vertex] = true;
    }
    
    if (array_search(false, $visited) !== false)
        return false;
    
    return true;
}
