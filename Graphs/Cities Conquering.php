<?php

// https://codefights.com/arcade/graphs-arcade/kingdom-roads/pmmMeP4JkqgKbzyTy/solutions

function citiesConquering($n, $roads) {
    
    // create result array and fill it with -1
    $result = array_fill(0,$n, -1);
    
    // sort each road and then sort roads to get everything in order
    foreach ($roads as $road)
        sort($road);
    sort($roads);
    
    // set cityTaken flag to jumpstart the for loop
    $cityTaken = true;
    
    // As long as a city was taken the previous night, 
    // determine if cities will be taken tonight
    for ($day=1;$cityTaken;$day++){
        
        $cityTaken = false;
        $list = [];
        
        foreach ($roads as list($city1, $city2)){
            $list[] = $city1;
            $list[] = $city2;
        }
        
        // get number of time a city appeared in the list
        $count = array_count_values($list);
        
        // go through each city
        for ($i=0; $i<$n;$i++)
            // if this city hasn't been taken over and it has less than 2 neighbors
            if (!in_array($i, $takenOverList) && $count[$i] < 2){
                // update our list
                $takenOverList[] = $i;
                // update our flag
                $cityTaken = true;
                // mark the day the city was taken
                $result[$i] = $day;
                // mark the size of $roads before we...
                $size = count($roads);
                
                // ...remove cities that were taken over tonight
                for ($j=0; $j<$size;$j++)
                    if (in_array($i, $roads[$j]))
                        unset($roads[$j]);
                
                // sort the roads to clean up the array
                sort($roads);
            }
    } // end of main for loop

    return $result;
}
