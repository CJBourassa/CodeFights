<?php

// https://codefights.com/arcade/graphs-arcade/neverending-grids/HY68Gv9BWPLefQ7CT/solutions

function digitJumping($grid, $start, $finish) {
    
    // If I'm already standing on the finish line then I don't have to move at all!
    if ($start[0] == $finish[0] && $start[1] == $finish[1])return 0;

    // create 2D array to store distance values of each number on the grid
    $distance = array_fill(0,count($grid),array_fill(0,count($grid[0]), 100));

    //preload starting position as distance of 0
    $distance[$start[0]][$start[1]] = 0;

    // store offset values for traversing grid right, left, down, up
    $offset = [[0,1],[0,-1],[1,0],[-1,0]];

    // create array to keep track of numbers 0-9 I've visited while traversing the grid
    $visited = array_fill(0,10,false);

    // preload starting number as visited
    $visited[$grid[$start[0]][$start[1]]] = true;

    // Create variable to store the Number that the finish node is on
    $finishNumber = $grid[$finish[0]][$finish[1]];

    // initialize moves to 0
    $move = 0;
    
    // store height and width to save a little time during double for loop
    $height = count($grid);
    $width = count($grid[0]);
    
    // don't stop until we reach the finish!
    while (!$visited[$finishNumber]){
        // go through every column
        for ($i = 0;$i < $height;$i++){
            // and every row
            for ($j = 0;$j < $width;$j++){
                
                // update all digits that has been visited to our current move + 1
                if ($visited[$grid[$i][$j]] && $distance[$i][$j] == 100)
                    $distance[$i][$j] = $move + 1;
                
                // we only want to consider digits that are available to us on this move
                if ($distance[$i][$j] == $move)
                    // check up, down, left and right
                    foreach ($offset as $os){
                        $y = $i + $os[0];
                        $x = $j + $os[1];
                        $number = $grid[$y][$x];
                        
                        // continue if we're off the grid or we've 
                        // already update the node's distance beforehand
                        if (!$number === NULL || $distance[$y][$x] <= $move)
                            continue;
                        
                        // if the next step is the finish line, move there and
                        // return the number of moves it took to get there
                        if ($y == $finish[0] && $x == $finish[1])
                            return $move + 1;
                        
                        $visited2[$number] = true;
                        $distance[$y][$x] = $move + 1;
                    }  // end of foreach
            } // end of row scan
        } // end of column scan
        $move++;
        $visited = $visited2;
    } // end of while loop -- found number of moves to reach finish
    
    // adding 1 to $move because we haven't actually stepped on it yet
    return $move+1;
}

