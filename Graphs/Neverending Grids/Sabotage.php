<?php
    // https://codefights.com/arcade/graphs-arcade/neverending-grids/HPiABBdPjKW8JvLAy

function sabotage($hangar) {
    $width = count($hangar[0]);
    $height = count($hangar);
    
    // start by saying there are $width x $height impossible escape routes  
    $total = $width * $height;
    
    // go through each cell and determine if an exit can be reach from here
    for ($i = 0; $i < $height;$i++)
        for ($j = 0; $j < $width;$j++){
            
            // reset our visited array and path array that our recurive function uses
            $visited = $path = [];
            
            if (findExit($j, $i, $hangar, $visited, false, $path)){
                
                // found a cell with valid escape route. Remove 1 from total
                $total--;
                
                // go through each cell in the path and mark it as a possible cell
                foreach ($path as list($y, $x))
                    $hangar[$y][$x] = 2;
            }
                
        } 
    
    return $total;
}

//  recursive utility function that builds a path to an exit 
function findExit($x, $y, $hangar, &$visited, $flag, &$path){
    
    // we escaped! ... or already came across an escape route that included this cell
    if ($hangar[$y][$x] == null || $hangar[$y][$x] == 2)return true;
    
    // already visited this node
    if ($visited[$y][$x])return false;
    
    $visited[$y][$x] = true;
    $path[] = [$y,$x];
    
    if ($hangar[$y][$x] == "U")
        if (findExit($x, $y-1, $hangar, $visited, $flag, $path))
            $flag = true;
    
    if ($hangar[$y][$x] == "D")
        if (findExit($x, $y+1, $hangar, $visited, $flag, $path))
            $flag = true;
    
    if ($hangar[$y][$x] == "L")
        if (findExit($x-1, $y, $hangar, $visited, $flag, $path))
            $flag = true;
    
    if ($hangar[$y][$x] == "R")
        if (findExit($x+1, $y, $hangar, $visited, $flag, $path))
            $flag = true;

    return $flag;
}


