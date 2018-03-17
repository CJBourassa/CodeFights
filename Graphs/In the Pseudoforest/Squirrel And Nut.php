<?php

// https://codefights.com/arcade/graphs-arcade/in-the-pseudoforest/HNjswnTuPkYkmDavw/solutions

function squirrelAndNut($tree, $triples) {
    
    // build adjacency list
    $edges = array_chunk($tree, 2);
    foreach ($edges as list($u, $v)){
        $al[$u][] = $v;
        $al[$v][] = $u;
    }
    
    // recursively build paths from node 1 to every other node
    getPaths($al, $paths);
    
    foreach ($triples as list($a, $b, $c)) {
        
        // common ancestors are values shared in both a and b, from highest to lowest
        $commonAncestors = array_intersect($paths[$a], $paths[$b]);
        
        // merge paths a and b together
        $combinedPaths = array_merge($paths[$b], $paths[$a]);
        
        // if c isn't the lowest common ancestor then there's a 
        // shorter path from a to b that doesn't include c
        if (in_array($c, $commonAncestors))
            $result[] = $c == $commonAncestors[count($commonAncestors) - 1];
    
        // otherwise if c is in path a or path b, then we can take the perfect picture
        else 
            $result[] = in_array($c, $combinedPaths);
    } 
    
    return $result;
}

// recursive utility function that performs a
// pseudo-BFS and keeps track of the node it came 
// from to store individual paths from node 1 to every other node
function getPaths($al, &$paths, $root = 1, $path = []) {
    
    $parent = $path[count($path) - 1];
    $path[] = $root;
    $paths[$root] = $path;
    
    foreach ($al[$root] as $u) 
        if ($u != $parent) 
            getPaths($al, $paths, $u, $path);
}