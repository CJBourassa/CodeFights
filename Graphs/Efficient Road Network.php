<?php

// https://codefights.com/arcade/graphs-arcade/kingdom-roads/ty4w8WJZ4sZSBNK5Q/description

function efficientRoadNetwork($n, $roads) {
    $nm = array_fill(0, $n, array_fill(0, $n, 0));

    // mark all the connections with 1's
    for ($i=0;$i<sizeof($roads);$i++){
        $y = $roads[$i][0];
        $x = $roads[$i][1];

        $nm[$y][$x] = 1;
        $nm[$x][$y] = 1;
    }

    if ($n == 1)
        return true;
    
    // check if array sum of any city is 0. if it is then it's not connected
    // to any city and the result should be false
    for ($i=0;$i<$n;$i++){
        $sum = array_sum($nm[$i]);
        if ($sum == 0)
            return false;
        else
            $sum = 0;
    }

    // get binary values of each citie's connections
    for ($i=0;$i<$n;$i++)
        $bin[$i] = implode("",$nm[$i]);
    
    // go through each city
    for ($i=0;$i<$n;$i++){
        $temp = $bin[$i]; 
        // go through each of the citie's connections 
        for ($c=0;$c<$n;$c++)
            if ($nm[$i][$c] === 1)
                $temp = $temp | $bin[$c];
            
        $temp = str_split($temp);
        if (array_search("0", $temp))
            return false;
    }

    return true;
}
