<?php

// https://codefights.com/arcade/graphs-arcade/kingdom-roads/qsRNQ2iR5xRzidNGW/solutions/KMooyavHNd2hZDpGr

function livingOnTheRoads($roadRegister) {
    
    $size = count($roadRegister);
    
    // build list of edges
    for ($i=0; $i<$size;$i++)
        for ($j=0; $j<$size;$j++)
            if ($roadRegister[$i][$j])
                $cities[] = [$i, $j];
    
    // filter out duplicates   
    for($i = count($cities)-1; $i >= 0 ; $i--) {
       $j = $i; 
       while ($j-- >= 0) 
          if (count(array_intersect($cities[$i],$cities[$j])) == count($cities[$i]))
              unset($cities[$i]);  
    }
    
    $cities = array_values($cities);
    $numberOfCities = count($cities);
    
    // create a result matrix that's the size of the number of remaining cities.
    // the connections are prefilled with boolean false.
    $resultMatrix = array_fill(0,  $numberOfCities, array_fill(0, $numberOfCities, false));
    
    // go through each cities connections and build the connections
    for ($i=0; $i< $numberOfCities-1;$i++)
        for ($j=$i+1; $j< $numberOfCities;$j++)
            if (in_array($cities[$i][0], $cities[$j]) || in_array($cities[$i][1], $cities[$j])){
                $resultMatrix[$i][$j] = true;
                $resultMatrix[$j][$i] = true;
            }
            
    return $resultMatrix;
}
