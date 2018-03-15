<?php

// https://codefights.com/arcade/code-arcade/corner-of-0s-and-1s/6SLJChm9N3fEgr2R7

function equalPairOfBits($n, $m) {
  return $n + $m + 1 & ~($m) - $n ;
}

