<?php

// https://codefights.com/arcade/graphs-arcade/kingdom-roads/YRPT3woWzSnYmBudH

function mergingCities($roadRegister) {
    
    $cities = count($roadRegister);
    
    // go through each city
    for ($i = 0; $i < $cities;$i+=2)
        // if city $i+1 is connected to city $i
        if ($roadRegister[$i+1][$i]){
            // go through the cities again
            for ($j = 0; $j < $cities;$j++){
                // and if city $i+1 is connect to any other city
                if ($roadRegister[$i+1][$j] && $j !== $i){
                    // build a road between city $i and city $j 
                    $roadRegister[$i][$j] = true;
                    $roadRegister[$j][$i] = true;
                }
            }
            
            // go through and unset every connection from any city to city $i+1
            for ($k=0; $k<$cities;$k++)
                unset($roadRegister[$k][$i+1]);
            
            // 
            $citiesMerged[] = $i+1;
        }
    
    // remove all cities that were affected by the merger
    foreach ($citiesMerged as $city)
        unset($roadRegister[$city]);
    
    // store the array values of the roads in the result
    foreach ($roadRegister as $roads)
        $result[] = array_values($roads);

    return $result;
}

