<?php

// https://codefights.com/arcade/graphs-arcade/neverending-grids/7NJiCELH4yxhc8hpJ
    
function electricField($grid, $wires) {

    $fx = $grid[1]-1;
    $fy = $grid[0]-1;
    // array is big. switch to using binary and say 
    // L = 1
    // R = 2
    // U = 4
    // D = 8
    // mark every cell as able to move in all four directions
    $dir = array_fill(0,$grid[0], array_fill(0,$grid[1], 15));
    // update cell's moveset around the edges of the grid
    for ($i=0; $i<$grid[0];$i++){
        for ($j=0; $j<$grid[1];$j++){
            if ($i === 0){
                $dir[$i][$j] = 11;
            }else if ($i == $grid[0]-1){
                $dir[$i][$j] = 7;
            }else if ($j === 0){
                $dir[$i][$j] = 14;
            }else if ($j === $grid[1]-1){
                $dir[$i][$j] = 13;
            }
        }
    }

    $dir[0][0] &= 14;             // top left corner can't go left
    $dir[$grid[0]-1][0] &= 14;    // bottom left corner can't go left
    $dir[0][$grid[1]-1] &= 13;    // top right corner can't go right
    
    // modify the moveset's for cells neighboring wires
    if ($wires){
        foreach ($wires as $wire){

            $x1 = $wire[0];
            $y1 = $wire[1];
            $x2 = $wire[2];
            $y2 = $wire[3];
            $xmin =min($x1, $x2);
            $xmax = max($x1, $x2);
            $ymin = min($y1, $y2);
            $ymax = max($y1, $y2);
            if ($x1 === $x2){
                while ($ymin !== $ymax){
                    $dir[$ymin][$x1] &= 14;
                    $dir[$ymin][$x1-1] &= 13;
                    $ymin++;
                }
            }else if ($y1 === $y2){
                while ($xmin !== $xmax){
                    $dir[$y1][$xmin] &= 11;
                    $dir[$y1-1][$xmin] &= 7;
                    $xmin++;
                }
            }
        }
    }
    
    // BFS to find the shortest path to the bottom right of the grid
    $visited = array_fill(0,$grid[0], array_fill(0,$grid[1], false));
    $route = [];
    $list[] = [0,0];
    $count = 0;
    $visited[0][0] = true;
    $distance[0][0] = 0;
    while ($list){
        $node = array_shift($list);
        if ($node[0] === $fy && $node[1] === $fx)return $distance[$node[0]][$node[1]];
        $route[] = $node;
        if ($dir[$node[0]][$node[1]] & 1 && !$visited[$node[0]][$node[1]-1]){
            $list[] = [$node[0], $node[1] - 1]; //add node to the left
            $distance[$node[0]][$node[1] - 1] = $distance[$node[0]][$node[1]] + 1;
            $visited[$node[0]][$node[1] - 1] = true;
        }
        if ($dir[$node[0]][$node[1]] & 2 && !$visited[$node[0]][$node[1]+1]){
            $list[] = [$node[0], $node[1] + 1]; //add node to the right
            $distance[$node[0]][$node[1] + 1] = $distance[$node[0]][$node[1]] + 1;
            $visited[$node[0]][$node[1]+1] = true;
        }
        if ($dir[$node[0]][$node[1]] & 4 && !$visited[$node[0] - 1][$node[1]]){
            $list[] = [$node[0] - 1, $node[1]]; //add node to the up
            $distance[$node[0] - 1][$node[1]] = $distance[$node[0]][$node[1]] + 1;
            $visited[$node[0] -1][$node[1]] = true;
        }
        if ($dir[$node[0]][$node[1]] & 8 && !$visited[$node[0] + 1][$node[1]]){
            $list[] = [$node[0] + 1, $node[1]]; //add node to the down
            $distance[$node[0] + 1][$node[1]] = $distance[$node[0]][$node[1]] + 1;
            $visited[$node[0]+1][$node[1]] = true;
        }
    }
    return -1;
}
   
