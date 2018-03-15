<?php

// https://codefights.com/arcade/code-arcade/at-the-crossroads/r9azLYp2BDZPyzaG2

function knapsackLight($value1, $weight1, $value2, $weight2, $maxW) {
    // can't carry either. value 0
    if ($weight1 > $maxW && $weight2 > $maxW) 
        return 0;
    // can carry both. add em up!
    else if ($weight1 + $weight2 <= $maxW) 
        return $value1 + $value2;
    // can only pick one. see if 1st item is more valuable and can carry
    else if(($value1 > $value2 && $weight1 <= $maxW) || $weight2 > $maxW)
        return $value1;
    // last item is only option
    return $value2;
}
