<?php

// https://codefights.com/arcade/graphs-arcade/contours-of-everything/3QCs2Td5vzj8sorAR/solutions

function countStars($adj) {

    $vertices = count($adj);
    
    // 0 out any nodes connected to themselves and 
    // count number of trues in each column
    for ($i=0; $i<$vertices;$i++){
        if ($adj[$i][$i]) $cantBeStar[] = $i; // if a node contains a self loop it can't be part of a star
        $trueCount[$i] = array_sum(array_column($adj, $i));
    }
    
    // convert adjacency matrix to list
    for ($i=0; $i < $vertices - 1; $i++)
        for ($j = $i + 1; $j < $vertices;$j++)
            if ($adj[$i][$j]){
                $adjacencyList[$i][] = $j;
                $adjacencyList[$j][] = $i;
            }
    
    // create array to track the visited nodes - initialize values to false
    $visited = array_fill(0, $vertices, false);
    
    // perform BFS on each node (if I haven't visited it already) 
    // and validate its constellation as a star
    for ($i = 0; $i < $vertices;$i++)
        if (!$visited[$i]){
            $q[] = $i;
            $group = [];
            while ($q){
                $vertex = array_pop($q);
                $group[] = $vertex;
                foreach ($adjacencyList[$vertex] as $neighbor)
                    if (!$visited[$neighbor])
                        $q[] = $neighbor;

                $visited[$vertex] = true;
            }

            if (count($group) == 2 && array_sum($adj[$group[0]]) == 1 && array_sum($adj[$group[0]]) == 1)
                $stars++;
            else if (count($group) != 1){
                // validate the constellation
                $moreThanOneEdge = false;
                $notStar = false;
                foreach ($group as $vertex)
                    if ($trueCount[$vertex] == 1)
                        continue;
                    else if ($trueCount[$vertex] > 1 && !$moreThanOneEdge && !in_array($vertex, $cantBeStar))
                        $moreThanOneEdge = true;
                    else{
                        $notStar = true;
                        break;
                    }
                
                if (!$notStar)
                    $stars++;
            }
        }
    
    return +$stars;
}

