<?php

// https://codefights.com/arcade/graphs-arcade/kingdom-roads/wkhfpfiT6YynLk2qE/description

function financialCrisis($roadRegister) {
    
    // go through connections in city $i
    for ($i=0; $i<sizeof($roadRegister);$i++){
        $temp = $roadRegister;
        // check each connection and if connection is true, turn other
        // citie's connection to false
        for ($c=0; $c<sizeof($roadRegister);$c++)
            if ($temp[$i][$c] === true)
                $temp[$c][$i] = false;
               
        // now that $temp has the correct values, I'll need to extract the 
        // values from it, excluding anything related to the city $i
        for ($v=0; $v<sizeof($roadRegister);$v++){
            for ($d=0; $d<sizeof($roadRegister);$d++)
                if (($v != $i) && ($d != $i))
                    $tmp[$v][] = $temp[$v][$d];
            
            $result[$i] = array_values($tmp);
        }
        $tmp = [];

    }
    return $result;
}