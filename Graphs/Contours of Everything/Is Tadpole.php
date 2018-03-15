<?php

// https://codefights.com/arcade/graphs-arcade/contours-of-everything/jDf7ARdM9wYZLB28w/solutions

function isTadpole($adj) {
    
    $size = count($adj);
    
    //There needs to be at least 3 nodes that connect to 
    //two other nodes to form the smallest possible head
    for ($count = $i = 0; $i < $size;$i++, $count = 0){
        for ($j = 0; $j < $size;$j++)
            if ($adj[$i][$j])
                $count++;
            
        if ($count == 4)
            return false;
        if ($count >= 2)
            $head++;
    }
    if ($head < 3)return false;

    // there has to be one vertex that has 3 trues 
    // (node that connects the head to the tail)
    for ($count = $i = 0; $i < $size;$i++, $count = 0){
        for ($j = 0; $j < $size;$j++)
            if ($adj[$i][$j])
                $count++;
            
        if ($count == 3){
            $base = $i;
            $baseCount++;
        }elseif($count == 1)
            $tail = $i;
        
    }
    if ($baseCount != 1)return false;

    // the tail can at most be n - 3 long
    $count = 0;
    $prev = -1;
    $toRemove[] = $tail;

    // check to make sure there is a simple path from tail to vertex
    while ($tail != $base && $count < $size-3){
        for ($i = 0; $i < $size;$i++)
            if ($adj[$tail][$i] && $i != $prev){
                
                $prev = $tail;
                $tail = $i;
                
                if ($tail == $base)
                    break(2);
                
                $toRemove[] = $i;
            }
        
        $count++;
    }

    if ($tail !== $base)
        return false;

    // remove all the nodes that connect to the tail
    foreach ($toRemove as $node){
        for ($i = 0; $i < $size;$i++)
            unset($adj[$i][$node]);
        
        unset($adj[$node]);
    }
    
    $adj = array_values($adj);
    
    // check to make sure that there are 2 trues in each column
    for ($i = 0; $i < count($adj);$i++){
        $am[$i][] = $i;
        for ($j = 0; $j < count($adj);$j++)
            if ($adj[$i][$j]){
                $am[$i][] = $j;
                sort($am[$i]);
            }
        
    }
    
    for ($i = 0; $i < count($am);$i++)
        for ($j = $i + 1; $j < count($am);$j++)
            if ($am[$i] == $am[$j])
                return false;
    
    return true;
}

