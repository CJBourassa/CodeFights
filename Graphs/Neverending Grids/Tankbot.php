<?php

// https://codefights.com/arcade/graphs-arcade/neverending-grids/sPEWN2g9LDk87RYpm

function tankbot($forest) {
    $width = count($forest[0]);
    $height = count($forest);
    // check if start or finish node is blocked
    if (!$forest[0][0] || !$forest[$height-1][$width-1]) return 0;
    
    // update true/false values to 1/0, respectively
    array_walk_recursive($forest, function (&$item) {
        $item = $item ? 1 : 0;
    });
    
    // starting from vertex diagonally top left from finish node, check right, down and bottom right, updating the nodes
    // "weights" as the biggest size "s" square that can stand on that vertex
    for ($i = $height - 2; $i >= 0; $i--) {
        for ($j = $width - 2; $j >= 0; $j--) {
            if($forest[$i][$j])
                $forest[$i][$j] = 1 + min($forest[$i][$j+1], $forest[$i+1][$j],$forest[$i+1][$j+1]);
        }        
    }    
    // Try to find the biggest size "s" such that there is a path
    // from [0,0] to [height-size,width-size] of boxes with value "s"
    $startSize = $forest[0][0];
    $queue[] = [0, 0, $startSize];
    $visited[$x][$y] = true;
    while ($queue) {
        // ux = vertex x position
        // uy = vertex y position
        // sz = largest size available to starting vertex
        list($ux,$uy,$size) = array_pop($queue);
        // if the square extends to the finish line, then we've traversed to the end and can return the size
        if ($ux == $height - $size && $uy == $width - $size) return $size;
        // get neighbor nodes left, right, above and below this vertex
        foreach ([[0,-1],[0,1],[-1,0],[1,0]] as list($dx,$dy)) {
            // get x / y coordinates for this neighbor
            $x = $ux + $dx;
            $y = $uy + $dy;
            // check to main sure the offset didn't take us out of the grid and I haven't visited this vertex
            if ($forest[$x][$y] !== NULL && !$visited[$x][$y]) {
                $visited[$x][$y] = true;
                // if this neighbor doesn't support the same size square as the vertex can...
                $neighborSizeSupport = min($forest[$x][$y],$size);
                $itemsInQueue = count($queue);
                $i = 0;
                // ...count the number of neighbors we have in the queue that support squares less than the size
                // that this neighbor can support...
                while ($i < $itemsInQueue && $queue[$i][2] < $neighborSizeSupport) $i++;
                //... and insert this neighbor after them on the stack. This creates 
                // a priority queue and allows us to start following path that could support the largest square
                array_splice    ( $queue,   $i,    0,    [[$x,$y, $neighborSizeSupport]] );
                // array_splice ( $array, start, length, (neighbor coordinates and size) )
            }
        }
    }
    return 0;
}


