<?php

// https://codefights.com/arcade/graphs-arcade/contours-of-everything/PmSaQEhfNqCPFfGrW/solutions

function isBull($adj) {
    
    $vertices = count($adj);
    
    // check to make sure there are 3 nodes that make a triangle
    for ($count = $i = 0; $i < $vertices;$i++, $count = 0){
        
        // self loop check
        if ($adj[$i][$i]) 
            return false; 
        
        for ($j = 0; $j < $vertices;$j++)
            if ($adj[$i][$j])
                $count++;
        
        if ($count >= 2)
            $triangle[] = $i;
    }

    // if all 5 nodes connect to at least 2 other nodes or 
    // a triangle can't be formed return false
    if (count($triangle) === 5 || count($triangle) <= 2)
        return false;

    // It's not a bull if there aren't 10 edges
    for ($i = 0; $i<$vertices;$i++)
        for ($j = 0; $j < $vertices;$j++)
            if ($adj[$i][$j])
                $count++;
    
    if ($count !== 10)return false;

    
    //check to make sure the "triangles" don't form a square
    for ($i = 0; $i < $vertices;$i++)
        if (in_array($i, $triangle))
            for ($j = 0; $j < $vertices;$j++)
                if ($adj[$i][$j])
                    $am[$i][] = $j;
            
        
    $am = array_values($am);
    
    for ($i = 0; $i < count($am)-1;$i++)
        for ($j=$i+1; $j<  count($am);$j++)
            if ($am[$i] == $am[$j])
                return false;
    
    // Must be a Bull
    return true;
}
