<?php

// https://codefights.com/arcade/code-arcade/intro-gates/aiKck9MwwAKyF8D4L

function lateRide($n) {
    // store minutes and hours as string values
    $min  = strval($n % 60); 
    $hour = strval(floor($n / 60));
    
    // Access each HH & MM digit by taking advantage of the fact 
    // that individual string characters can be accessed the same as 
    // if they were stored in an array.
    
    // Note that PHP will automatically convert the string values 
    // to integers when performing addition.
    return $hour[0] + $hour[1] + $min[0] + $min[1];
}
