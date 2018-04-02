<?php

// https://codefights.com/arcade/graphs-arcade/neverending-grids/9dANZWyT332KTyJCw

function portals($maxTime, $manacost) {
    
    $height = count($manacost);
    $width = count($manacost[0]);
    
    if (!$height && !$width)return 0;
    if ($maxTime === 0 && $height > 0 && $width > 0)return 0;
    
    // BFS from top left to see the mana costs for every node reachable in $maxTime
    $offset = [[0,1],[0,-1],[1,0],[-1,0]];
    $start = [0,0];
    $movesToCostStart[0] = [$manacost[0][0]];
    $nextList[] = $start;
    for ($i=1; $i <= $maxTime; $i++){
        $list = $nextList;
        $nextList = [];
        if (!$list)break;
        foreach ($list as $n){
            if (!$visited[$n[0]][$n[1]])
                foreach ($offset as $os){
                    $y = $n[0] + $os[0];
                    $x = $n[1] + $os[1];
                    if ($y == $height-1 && $x == $width-1)return 0;
                    if ($manacost[$y][$x] !== NULL && $manacost[$y][$x] != -1 && !$visited[$y][$x]){
                         $nextList[] = [$y,$x];
                         $movesToCostStart[$i][] = $manacost[$y][$x];
                    }
                }
            $visited[$n[0]][$n[1]] = true;
        }
    }
    
    // BFS from bottom right to see the mana costs for every node reachable in $maxTime
    $nextList = [];
    $visited = [];
    $start = [$height-1,$width-1];
    $movesToCostFinish[0] = [$manacost[$height-1][$width-1]];
    $nextList[] = $start;
    for ($i=1; $i <= $maxTime; $i++){
        $list = $nextList;
        $nextList = [];
        if (!$list)break;
        foreach ($list as $n){
            if (!$visited[$n[0]][$n[1]])
                foreach ($offset as $os){
                    $y = $n[0] + $os[0];
                    $x = $n[1] + $os[1];
                    if ($manacost[$y][$x] !== NULL && $manacost[$y][$x] != -1 && !$visited[$y][$x]){
                         $nextList[] = [$y,$x];
                         $movesToCostFinish[$i][] = $manacost[$y][$x];
                    }
                }
            $visited[$n[0]][$n[1]] = true;
        }
    }
    
    // find the lowest start value/finish value combinations that are reachable in 
    $min = 1000;
    $v = 0;
    foreach ($movesToCostFinish as $keyFinish=>$finishValues){
        foreach ($finishValues as $finishValue)
           for ($i=0; $i<=$maxTime-$v;$i++)
                foreach ($movesToCostStart as $keyStart=>$startValues)
                    foreach ($startValues as $startValue)
                        if ($startValue + $finishValue < $min && $keyStart+$keyFinish <=$maxTime)
                            $min = $startValue + $finishValue;
        $v++;
    }
    return $min;
}


