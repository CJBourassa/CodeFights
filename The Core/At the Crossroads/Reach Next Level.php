<?php

// https://codefights.com/arcade/code-arcade/at-the-crossroads/m9wjpkCjgofg7gs8N/solutions

function reachNextLevel($experience, $threshold, $reward) {
    // return true if the experience gained + your current experience is >= threshold
    return $reward + $experience >= $threshold;
}
