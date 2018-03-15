<?php

// https://codefights.com/arcade/code-arcade/at-the-crossroads/7jaup9HprdJno2diw

function tennisSet($score1, $score2) {
    
    // see if either player wins by getting to 5 first
    if ($score1 < 5 && $score2 == 6 || $score2 < 5 && $score1 == 6)
        return true;
    // see if either player wins by getting to 7 first 
    else if (($score1 >=5 && $score1 < 7 && $score2 == 7) 
           ||($score2 >=5 && $score2 < 7 && $score1 == 7))
        return true;
        
return false;
}
