<?php

// https://codefights.com/arcade/graphs-arcade/orienteering/XGxgi3cdvjF5Buggu/solutions

function escapeTheNightmare($h, $d, $start, $finish) {
    
    // calculate base edge lengths and hypotenuse length
    $baseEdgeLength = $d * cos(deg2rad(22.5)) * 2;
    $hypotenuseLength = sqrt($h ** 2 + $d ** 2);
    
    // build adjacency list
    $al = [[3, 5, 8], [4, 6, 8], [5, 7, 8], [0, 6, 8], [1, 7, 8], [0, 2, 8], [1, 3, 8], [2, 4, 8]];
    
    // build distance matrix and fill with values greater than any hypotenuse will have
    $distance = array_fill(0, 9, array_fill(0, 9, ($max = 3000)));
    
    // zero out distance from node to itself
    for ($i = 0; $i < 9;$i++)
        $distance[$i][$i] = 0;
    
    // fill in distance matrix with direct neighbors's distances
    foreach ($al as $node=>$neighbors)
        foreach ($neighbors as $neighbor){
            $val = $neighbor != 8 ? $baseEdgeLength : $hypotenuseLength;
            $distance[$node][$neighbor] = $distance[$neighbor][$node] = $val;
        }
    
    // run floyd warshall algorithm to get all shortest distances
    for ($k = 0; $k < 8; $k++)
         for ($i = 0; $i < 8; $i++)
             if ($distance[$i][$k] != $max)
                 for ($j = 0; $j < 8; $j++)
                    if ($distance[$k][$j] != $max)
                        $distance[$i][$j] = min($distance[$i][$j], $distance[$i][$k] + $distance[$k][$j]);
                 
    
    // get distances from start and finish point to the top and bottom of the pyramid
    $distanceToTopFromStart  = $hypotenuseLength - ($hypotenuseLength * ($start[2] / $h));
    $distanceToBottomFromStart  = $hypotenuseLength - ($hypotenuseLength * (($h - $start[2]) / $h));
    $distanceToTopFromFinish = $hypotenuseLength - ($hypotenuseLength * ($finish[2] / $h));
    $distanceToBottomFromFinish = $hypotenuseLength - ($hypotenuseLength * (($h - $finish[2]) / $h));
    
    // based on x and y, figure out what nodes the start and finish lines coorespond to
    $startNode = getNode($start[1], $start[0]);
    $finishNode = getNode($finish[1], $finish[0]);
    
    // if both start and finish are not along the same edge, the shortest distance is 
    // the minimum of meeting at the top of the pyramid or traversing through the base
    if ($startNode != $finishNode)
        return min($distanceToTopFromStart + $distanceToTopFromFinish, 
               $distanceToBottomFromStart + $distanceToBottomFromFinish + $distance[$startNode][$finishNode]);
    else 
        // if both start and finish are on the same edge, return the distance apart from eachother
        return abs($distanceToTopFromFinish - $distanceToTopFromStart);
}

function getNode($y, $x){
    if ($y > 0  && $x == 0) return 0;
    if ($y > 0  && $x > 0)  return 1;
    if ($y == 0 && $x > 0)  return 2;
    if ($y < 0  && $x > 0)  return 3;
    if ($y < 0  && $x == 0) return 4;
    if ($y < 0  && $x < 0)  return 5;
    if ($y == 0 && $x < 0)  return 6;
    if ($y > 0  && $x < 0)  return 7;
}