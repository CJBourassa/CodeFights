<?php

// https://codefights.com/arcade/code-arcade/at-the-crossroads/J7PQDxpWqhx7HrvBZ/solutions

function metroCard($lastNumberOfDays) {
    // months that have 31 days are always followed by months with 28, 30 or 31 days
    // and months that do not have 31 days are always followed by months with 31 days
    return ($lastNumberOfDays == 31) ? [28,30,31] : [31];
}
