<?php

// https://codefights.com/arcade/code-arcade/at-the-crossroads/jZ4ZSiGohzFTeg4yb/solutions

function willYou($young, $beautiful, $loved) {
    // young and beatuiful and not loved
    // or
    // loved and not young
    // or 
    // loved and not beautiful
    return $young && $beautiful && !$loved || ($loved && (!$young || !$beautiful) );
}

