<?php

// https://codefights.com/arcade/graphs-arcade/kingdom-roads/5Emk5PFgFBWR4YiCo/solutions

function greatRenaming($roadRegister) {
    
    $n = count($roadRegister);
    
    // create the resultant matrix and fill it with boolean false
    $resultMatrix = array_fill(0, $n, array_fill(0,$n, false));

    // cover every city but the first
    for ($i=0; $i<$n;$i++){
        
        // put last element in array in the front
        array_unshift($roadRegister[$i], array_pop($roadRegister[$i])); 
        
        // update next citie's data to this cities
        $resultMatrix[$i+1] = $roadRegister[$i];
    }
    
    // first city is update to the last citie's temp data
    $resultMatrix[0] = $resultMatrix[$i]; 
    
    // delete temp data
    unset($resultMatrix[$i]);             
    
    return $resultMatrix;
}

