<?php

// https://codefights.com/arcade/graphs-arcade/contours-of-everything/shHv7RjLBCrDFN3np/solutions

function isButterfly($adj) {
   
   // check the diagonal to make sure they're set to false
   for ($i = 0; $i < 5;$i++)
      if ($adj[$i][$i])
         return false;

   // count the number of boolean true's in each column
   for ($i = 0; $i < 5; $i++)
      $count[$i] = array_sum(array_column($adj, $i));
   
   // there should be 4 counts of 2 and 1 count of 4 if it's a butterfly
   $trueCount = array_count_values($count);
   if ($trueCount["2"] == 4 && $trueCount["4"] == 1)
      return true;
   return false;
}
