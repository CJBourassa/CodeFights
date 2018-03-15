<?php

// https://codefights.com/arcade/graphs-arcade/kingdom-roads/d9RrPoAsHauEZ8NJD/solutions

function namingRoads($roads) {
    
    // $roads[$i] is now [road, city2, city1]
    for ($i=0; $i<count($roads);$i++)
        $roads[$i] = array_reverse($roads[$i]);
    
    // now we can sort $roads by the road numbers
    sort($roads);
    
    // remove the road number from $roads since we know they're in order
    for ($i=0; $i<count($roads);$i++)
        unset($roads[$i][0]);
    
    // go through the edges
    for ($i=0; $i<count($roads)-1;$i++)
        // if the next road shares a city with the current road...it's not confusing
        if (array_intersect($roads[$i], $roads[$i+1]))
            return false;
    
    return true;
}
