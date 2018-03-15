<?php
function candies($n, $m) {
    // floor($m / $n) represents the number of candies that each child can get
    // Multiply this value by the number of children to get the total number of 
    // candies that will be given
    return floor($m / $n) * $n;
}
