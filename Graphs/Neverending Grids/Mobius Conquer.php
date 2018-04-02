<?php

// https://codefights.com/arcade/graphs-arcade/neverending-grids/hvJfAuqSX3HDjDZ6P

function mobiusConquer($field, $ratiorg, $enemy, $impassableCells) {
    
    // building grid double in width
    $grid = array_fill(0,$field[0], array_fill(0, $field[1]*2, 1));
    $xedge = $field[1]*2 - 1;
    $yedge = $field[0] - 1;

    // add impassable cells to grid
    foreach ($impassableCells as $impassableCell)
        if ($impassableCell[0] == 1)
            $grid[$impassableCell[1]][$impassableCell[2]+$field[1]] = 0;
        else
            $grid[$impassableCell[1]][$impassableCell[2]] = 0; 
    

    // perform BFS starting at ratioorgs position
    $list = [];
    if ($ratiorg[0] == 1){
        $startx = $ratiorg[2] + $field[1];
        $starty = $ratiorg[1];
    }else{
        $startx = $ratiorg[2];
        $starty = $ratiorg[1];
    }
    
    // perform BFS at Ratiorg's location
    $visited = array_fill(0,$field[0], array_fill(0, $field[1]*2, 0));
    $distanceR = array_fill(0,$field[0], array_fill(0, $field[1]*2, 101));
    $distanceR[$starty][$startx] = 0;
    $visited[$starty][$startx] = true;
    $list[] = [$starty, $startx];
    $count = 0;
    while($list){
        $node = array_shift($list);
        $x = $node[1];
        $y = $node[0];

        // grab node above this
            //not at ceil     haven't been here        not blocked
        if ($y !== 0 && !$visited[$y-1][$x] && $grid[$y-1][$x] !== 0){
            $list[] = [$y-1, $x];
            $distanceR[$y-1][$x] = $distanceR[$y][$x]+1;
            $visited[$y-1][$x] = true;
        }
         // grab node below this
            //not at bottom   haven't been here   not blocked
        if ($y !== $yedge && !$visited[$y+1][$x] && $grid[$y+1][$x] !== 0){
            $list[] = [$y+1, $x];
            $distanceR[$y+1][$x] = $distanceR[$y][$x]+1;
            $visited[$y+1][$x] = true;
        }

         // grab node left of this
            //not at left edge   haven't been here   not blocked
        if ($x !== 0 && !$visited[$y][$x-1] && $grid[$y][$x-1] !== 0){
            $list[] = [$y, $x-1];
            $distanceR[$y][$x-1] = $distanceR[$y][$x]+1;
            $visited[$y][$x-1] = true;
                  // at edge   // right side not visited  // not blocked
        }else if ($x === 0 && !$visited[$y][$xedge] && $grid[$y][$xedge] !== 0){
            $list[] = [$y, $xedge];
            $distanceR[$y][$xedge] = $distanceR[$y][$x]+1;
            $visited[$y][$xedge] = true;
        }

         // grab node left of this
            //not at right edge   haven't been here   not blocked
        if ($x !== $xedge && !$visited[$y][$x+1] && $grid[$y][$x+1] !== 0){
            $list[] = [$y, $x+1];
            $distanceR[$y][$x+1] = $distanceR[$y][$x]+1;
            $visited[$y][$x+1] = true;
                  // at edge   // left side not visited  // not blocked
        }else if ($x === $xedge && !$visited[$y][0] && $grid[$y][0] !== 0){
            $list[] = [$y, 0];
            $distanceR[$y][0] = $distanceR[$y][$x]+1;
            $visited[$y][0] = true;
        }
    }

    // perform BFS starting at enemy position
    $list = [];
    if ($enemy[0] == 1){
        $startx = $enemy[2] + $field[1];
        $starty = $enemy[1];
    }else{
        $startx = $enemy[2];
        $starty = $enemy[1];
    }
    $visited = array_fill(0,$field[0], array_fill(0, $field[1]*2, 0));
    $distanceE = array_fill(0,$field[0], array_fill(0, $field[1]*2, 101));
    $distanceE[$starty][$startx] = 0;
    $list[] = [$starty, $startx];
    $visited[$starty][$startx] = true;
    while($list){
        $node = array_shift($list);
        $x = $node[1];
        $y = $node[0];

        // grab node above this
            //not at ceil     haven't been here        not blocked
        if ($y !== 0 && !$visited[$y-1][$x] && $grid[$y-1][$x] !== 0){
            $list[] = [$y-1, $x];
            $distanceE[$y-1][$x] = $distanceE[$y][$x]+1;
            $visited[$y-1][$x] = true;
        }
         // grab node below this
            //not at bottom   haven't been here   not blocked
        if ($y !== $yedge && !$visited[$y+1][$x] && $grid[$y+1][$x] !== 0){
            $list[] = [$y+1, $x];
            $distanceE[$y+1][$x] = $distanceE[$y][$x]+1;
            $visited[$y+1][$x] = true;
        }

         // grab node left of this
            //not at left edge   haven't been here   not blocked
        if ($x !== 0 && !$visited[$y][$x-1] && $grid[$y][$x-1] !== 0){
            $list[] = [$y, $x-1];
            $distanceE[$y][$x-1] = $distanceE[$y][$x]+1;
            $visited[$y][$x-1] = true;
                  // at edge   // right side not visited  // not blocked
        }
        if ($x === 0 && !$visited[$y][$xedge] && $grid[$y][$xedge] !== 0){
            $list[] = [$y, $xedge];
            $distanceE[$y][$xedge] = $distanceE[$y][$x]+1;
            $visited[$y][$xedge] = true;
        }

         // grab node left of this
            //not at right edge   haven't been here   not blocked
        if ($x !== $xedge && !$visited[$y][$x+1] && $grid[$y][$x+1] !== 0){
            $list[] = [$y, $x+1];
            $distanceE[$y][$x+1] = $distanceE[$y][$x]+1;
            $visited[$y][$x+1] = true;
                  // at edge   // left side not visited  // not blocked
        }
        if ($x === $xedge && !$visited[$y][0] && $grid[$y][0] !== 0){
            $list[] = [$y, 0];
            $distanceE[$y][0] = $distanceE[$y][$x]+1;
            $visited[$y][0] = true;
        }
    }
    
    // count up cells
    for ($i=0; $i<count($grid);$i++)
        for ($j=0; $j<count($grid[0]);$j++)
            if ($distanceE[$i][$j] !== $distanceR[$i][$j])
                if ($distanceE[$i][$j] < $distanceR[$i][$j])
                    $enemyCount++;
                else   
                    $RatiorgCount++;

    return [$RatiorgCount, $enemyCount];
}

