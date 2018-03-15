<?php

// https://codefights.com/arcade/graphs-arcade/contours-of-everything/5DmC8isJ3GBRcMJo2/solutions

function isBook($adj) {
    
    $vertices = count($adj);
    
    // find the two vertices that are the base of this book
    for ($count = $i = 0; $i < $vertices;$i++, $count = 0){
        
        // no book has a self loop 
        if ($adj[$i][$i] === true)return false;
        
        for ($j = 0; $j < $vertices;$j++)
            if ($adj[$i][$j])
                $count++;

        if ($count == $vertices-1)
            $base[] = $i;
    }
    
    // if you didn't find 2 bases then it isn't a book
    if ($base[0] === NULL || $base[1] === NULL)return false;
    
    // go through each vertex that isn't a base and make sure 
    // there isn't a connection to another vertex that isn't the base
    for ($i = 0; $i < $vertices;$i++)
        if ($i != $base[0] && $i != $base[1])
            for ($j = 0; $j < $vertices;$j++)
                if ($adj[$i][$j] && $j != $base[0] && $j != $base[1])
                    return false;
    
    return true;
}
