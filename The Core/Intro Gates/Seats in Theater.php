<?php

// https://codefights.com/arcade/code-arcade/intro-gates/bszFiQAog96G9CXKg/solutions

function seatsInTheater($nCols, $nRows, $col, $row) {
    // $nRows - $row = Number of people in your row from you to the exit, inclusive
    // $nCols - $col + 1 = Column height from you to the back of the theater, inclusive
    return ($nRows - $row) * ($nCols - $col + 1);
}
