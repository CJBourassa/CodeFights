<?php

// https://codefights.com/arcade/graphs-arcade/kingdom-roads/CSzczQWdnYwmyEjvv/description

function roadsBuilding($cities, $roads) {
    
    // fill matrix $cities x $cities with 0's
    $nm = array_fill(0, $cities, array_fill(0, $cities, 0));

    if ($cities == 1)
        return [];
    
    // mark roads that lead to themselves(impossible) with an "x"
    for ($i=0; $i<$cities; $i++)
        $nm[$i][$i] = "x";
    

    // fill in the roads that are provided with 1's (both directions)
    for ($i=0; $i<sizeof($roads);$i++){
        $y = $roads[$i][0];
        $x = $roads[$i][1];

        $nm[$y][$x] = 1;
        $nm[$x][$y] = 1;
    }

    // look for 0's row by row, return the coordinate, update coordinates
    // in both directions to 1 (undirected)
    for ($i=0; $i<$cities;$i++){
        for ($c=0; $c<$cities;$c++){
            if (array_search("0", $nm[$i]) !== false){
                $x = $i;
                $y = array_search("0", $nm[$i]);
                $nm[$y][$x] = 1;
                $nm[$x][$y] = 1;
                $result[] = array($x,$y);
            }
        }
    }
    return $result;
}

