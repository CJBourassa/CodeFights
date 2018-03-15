<?php

// https://codefights.com/arcade/code-arcade/at-the-crossroads/sgDWKCFQHHi5D3Szj/solutions

function extraNumber($a, $b, $c) {
    // return the value that only appears once in an array containing a, b and c
    return array_search(1, array_count_values([$a, $b, $c]));
}
