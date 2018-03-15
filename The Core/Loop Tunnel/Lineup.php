<?php

// https://codefights.com/arcade/code-arcade/loop-tunnel/8rqs3BLpdKePhouQM/description

function lineUp($commands) {
    
    if (!$commands)return 0;

    $commands = str_split($commands);

    foreach ($commands as $command){
        if ($command == 'A' && !$turnCount) 
            $total++;
        else if ($turnCount < 2 && ($command == 'L' || $command == 'R'))
            $turnCount++;
        else if ($command != 'A')
            $total++;

        if ($turnCount == 2){
            $total++;
            $turnCount = 0;
        }
    }
    return +$total;
}

