<?php

// https://codefights.com/arcade/graphs-arcade/contours-of-everything/gLs2qAzAGivaxYSAq/solutions

function isFlower($adj) {
    
    $size = count($adj);
    
    // build an adjacency matrix
    for ($i = 0; $i < $size;$i++){
        $am[$i][] = $i;
        for ($j = 0; $j < $size;$j++){
            if ($adj[$i][$j])
                $am[$i][] = $j;
            
            sort($am[$i]);
        }
        
        if ($i && !in_array(count($am[$i]), $connections))
            $diff++;
        
        $connections[] = count($am[$i]);
    }

    if ($diff > 1)
        return false;

    // find and mark all matching pairs in adjacency matrix for deletion
    for ($i = 0; $i < $size - 1;$i++)
        for ($j = $i + 1; $j < $size;$j++)
            if ($am[$i] === $am[$j]){
                if (!in_array($i, $toRemove))$toRemove[] = $i;
                if (!in_array($j, $toRemove))$toRemove[] = $j;
            }
        
    // if there isn't 1 match then this is NOT a flower
    if ($toRemove === NULL)
        return false;

    foreach ($toRemove as $node)
        unset($am[$node]);
    
    return count($am) <= 1;
}
