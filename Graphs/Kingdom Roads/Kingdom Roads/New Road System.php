<?php

// https://codefights.com/arcade/graphs-arcade/kingdom-roads/nCMisf4ZKpDLdHevE/description

function newRoadSystem($roadRegister) {

    // check the row (outgoing) against the column (incoming)
    for($i=0;$i<count($roadRegister);$i++) 
        if(array_sum($roadRegister[$i]) != array_sum(array_column($roadRegister,$i))) 
            return false;

    return true;
}