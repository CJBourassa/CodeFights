<?php

// https://codefights.com/arcade/graphs-arcade/neverending-grids/ASAZNscPBXpRNrvkL/solutions

function horsebot($n, $m) {
    // n is the height of the board
    // m is the  width of the board
     
    // go through every combination of moves from (1,1 to $n, $m)
    // and see if it's possible to make it to ($n, $m)
    for ($i = 1; $i < $n;$i++){
        for ($j = 1; $j < $m;$j++){
            // if, for example, I've already evaluated moving (2,4), I don't
            // need to check (4,2) because of the way a horse moves on the board
            if ($memo[$i][$j] || $memo[$j][$i])continue;
            
            // only moves are diagonal
            if ($i == $j){
                $moves = [
                    [ $i  , $j],
                    [-$i  ,-$j],
                    [-$i  , $j],
                    [ $i  ,-$j]
                ];       
            // all 8 horse movements are available
            }else{
                $moves = [
                    [ $j  , $i],
                    [-$j  ,-$i],
                    [-$j  , $i],
                    [ $j  ,-$i],
                    [ $i  , $j],
                    [-$i  ,-$j],
                    [-$i  , $j],
                    [ $i  ,-$j]
                ];
            }
            // mark this (i, j) movement pair as evaluated
            $memo[$i][$j] = $memo[$j][$i] = true;
            
            // create 2d array of size n * m to track visited nodes
            $visited = array_fill(1,$n, array_fill(1,$m,false));
            
            // check if you can reach (n,m) from (1,1) with given moveset
            if (check(1, 1, $moves, $visited, $n, $m))
                $count++;
        } 
    }
    
    // + sign casts $count to integer type, turning NULL to 0 
    return +$count; 
}

// utility function to recursively evaluate all reachable locations for a given moveset
function check($x, $y, $moves, &$visited, $n, $m){
    if ($x < 1 || $y < 1 || $x > $m || $y > $n || $visited[$y][$x])
        return false;

    if ($x == $m && $y == $n)
        return true;

    $visited[$y][$x] = true;
    foreach ($moves as list($ox, $oy))
        if (check($x+$ox, $y+$oy, $moves, $visited, $n, $m))
            return true;
}
