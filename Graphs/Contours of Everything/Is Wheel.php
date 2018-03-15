<?php

// https://codefights.com/arcade/graphs-arcade/contours-of-everything/ZCzzBYpY8W5BPnNyb/solutions

function isWheel($adj) {
   
   // check that no nodes connect to themselves
   for ($i=0; $i<count($adj);$i++)
         if ($adj[$i][$i])return false;
   
   // get centerpoint, return false if it doesn't exist
   $vertices = count($adj);
   for ($i=0; $i<$vertices;$i++){
      $count = 0;
      for ($j=0; $j<$vertices;$j++)
         if ($adj[$i][$j])
            $count++;
     
      if ($count == $vertices-1 && $center === NULL)
         $center = $i;
      else if ($count == $vertices-1 && $center !== NULL && $vertices-1 !== 3)
         return false;
   }
   if ($center === NULL)return false;

   // check each row to make sure only count($adj)-2 true's exist
   for ($count = $i = 0; $i < $vertices;$i++, $count = 0)
      // skip centerpoint
      if ($i !== $center){ 
         for ($j = 0; $j < $vertices;$j++)
            if ($adj[$i][$j])
               $count++;

         if ($count != 3)return false;
      }
            
   return true;
}
