<?php


function secondRightmostZeroBit($n) {
  // Example
  // $n = 37 = 101001
  // ($n | $n + 1 = 101001 | 101010 = 101011 --> first zero becomes a 1
  // 
  // equation boils down to ~101011 & (101011 + 1)
  //                       = 010100 & 101100
  //                       = 8 (0 based position of the 2nd zero)
  return  ~($n | $n + 1) & ($n | $n + 1) + 1;
}