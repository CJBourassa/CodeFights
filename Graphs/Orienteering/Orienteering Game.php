<?php

// https://codefights.com/arcade/graphs-arcade/orienteering/gDRv9hSBGutrsawEt

function orienteeringGame($board) {
    
    // used for moving in down, right, left, and up
    $offset = [[1,0],[0,1],[-1,0],[0,-1]];
    
    // store x/y coordinates for end location 
    $endX = count($board[0])-1;
    $endY = count($board)-1;
    
    // store value of the finish cell
    $endDist = $board[$endY][$endX];
    
    // prefill distance array to php version of infinity
    $distance = array_fill(0, count($board), array_fill(0, count($board[0]), PHP_INT_MAX));
    // distance to start is 0
    $distance[0][0] = $board[0][0];
    
    // create priority queue
    $pq = new splPriorityQueue();
    $pq->setExtractFlags(SplPriorityQueue::EXTR_BOTH);
    $pq->insert([0,0], $board[0][0] * -1);
    
    // BFS to find shortest path from top left to bottom right
    while (!$pq->isEmpty()){
        
        // pull out a cell from the priority queue
        $cell = $pq->extract();
        
        // get coordinates for the cell and it's wait ti
        list($y, $x) = $cell['data'];
        $waitTime = $cell['priority'] * -1;
        
        // foreach each of the 4 movement options, check if the distance to it can be reduced
        foreach ($offset as list($osy, $osx)){
            $newX = $x + $osx;
            $newY = $y + $osy;
            $cellCost = $board[$newY][$newX];
            
            if ($cellCost !== NULL){
                
                $cost = $waitTime + $cellCost;
                if ($cost < $distance[$newY][$newX]){
                    $pq->insert([$newY, $newX], $cost * -1);
                    $distance[$newY][$newX] = $cost;
                }
            }
            
        } // end of foreach
    }  // end of while
    
    // the distance to get to the finish cell does not include end cell's value
    return $distance[$endY][$endX] - $endDist;
}

