<?php

// https://codefights.com/arcade/code-arcade/corner-of-0s-and-1s/e3zfPNTwTa9qTQzcX

function mirrorBits($a) {
    return bindec(strrev(decbin($a)));
}
