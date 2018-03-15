<?php

// https://codefights.com/arcade/code-arcade/loop-tunnel/scG8AFsPuqQGx8Qjf

function appleBoxes($k) {

    for ($i=1;$i <= $k; $i++) 
        if ($i%2)
            $yellowApples += $i ** 2;
        else
            $redApples += $i ** 2;

    return $redApples - $yellowApples;
}
