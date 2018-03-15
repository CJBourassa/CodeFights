<?php

// https://codefights.com/arcade/code-arcade/loop-tunnel/KLbRMcWhaZi3dvYH5/description

function increaseNumberRoundness($n) {
    
    $n = str_split($n);
    
    for ($i=1; $i<count($n)-1;$i++)
        if (!$n[$i] && $n[$i+1])
            return true;
    
    return false;
}


