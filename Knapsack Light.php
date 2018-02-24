<?php
//You found two items in a treasure chest! The first item weighs weight1 and is 
//worth value1, and the second item weighs weight2 and is worth value2. What is
//the total maximum value of the items you can take with you, assuming that your
// max weight capacity is maxW and you can't come back for the items later?
//Note that there are only two items and you can't bring more than one item of 
//each type, i.e. you can't take two first items or two second items.

//Example
//For value1 = 10, weight1 = 5, value2 = 6, weight2 = 4 and maxW = 8, the output
//should be
//knapsackLight(value1, weight1, value2, weight2, maxW) = 10.
//You can only carry the first item.
//For value1 = 10, weight1 = 5, value2 = 6, weight2 = 4 and maxW = 9, the 
//output should be knapsackLight(value1, weight1, value2, weight2, maxW) = 16.
//You're strong enough to take both of the items with you.
//For value1 = 5, weight1 = 3, value2 = 7, weight2 = 4 and maxW = 6, the 
//output should be knapsackLight(value1, weight1, value2, weight2, maxW) = 7.
//You can't take both items, but you can take any of them.

//[execution time limit] 4 seconds (php)

//[input] integer value1
//Guaranteed constraints:
//2 ≤ value1 ≤ 20.

//[input] integer weight1
//Guaranteed constraints:
//2 ≤ weight1 ≤ 10.

//[input] integer value2
//Guaranteed constraints:
//2 ≤ value2 ≤ 20.

//[input] integer weight2
//Guaranteed constraints:
//2 ≤ weight2 ≤ 10.

//[input] integer maxW
//Guaranteed constraints:
//1 ≤ maxW ≤ 20.

//[output] integer

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
