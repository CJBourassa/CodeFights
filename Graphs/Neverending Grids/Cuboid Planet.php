<?php

// https://codefights.com/arcade/graphs-arcade/neverending-grids/kpp94L9QXMdaHrQ5X
    
 function cuboidPlanet($cuboid, $impassableCells) {
    //cuboid given as   a    *     b     *    c  
    //                height *   width   *  length
    $a = $cuboid[0];
    $b = $cuboid[1];
    $c = $cuboid[2];

    //6 arrays to hold blocked / unblocked values for each face  
    $cube["a"] = array_fill(0,$a,array_fill(0,$c,0));
    $cube["b"] = array_fill(0,$a,array_fill(0,$b,0));
    $cube["c"] = array_fill(0,$a,array_fill(0,$c,0));
    $cube["d"] = array_fill(0,$c,array_fill(0,$b,0));
    $cube["e"] = array_fill(0,$c,array_fill(0,$b,0));
    $cube["f"] = array_fill(0,$a,array_fill(0,$b,0));

    //6 arrays to store boolean value for having visited the node
    $visited["a"] = $cube["a"];
    $visited["b"] = $cube["b"];
    $visited["c"] = $cube["c"];
    $visited["d"] = $cube["d"];
    $visited["e"] = $cube["e"];
    $visited["f"] = $cube["f"];

    // precalculate these to save time during BFS
    $sizea = count($cube["a"])-1;
    $lengtha = count($cube["a"][0])-1;
    $sizeb = count($cube["b"])-1;
    $lengthb = count($cube["b"][0])-1;
    $sizec = count($cube["c"])-1;
    $lengthc = count($cube["c"][0])-1;
    $sized = count($cube["d"])-1;
    $lengthd = count($cube["d"][0])-1;
    $sizee = count($cube["e"])-1;
    $lengthe = count($cube["e"][0])-1;
    $sizef = count($cube["f"])-1;
    $lengthf = count($cube["f"][0])-1;

    // offsets to use for checking up / down / left / right
    $offset[] = [0,1];
    $offset[] = [0,-1];
    $offset[] = [1,0];
    $offset[] = [-1,0];

    //mark all impassible blocks as visited
    foreach ($impassableCells as $block)
    {
        switch ($block[0]){
            case 0:
                $visited["a"][$block[1]][$block[2]] = true;
                break;
            case 1:
                $visited["b"][$block[1]][$block[2]] = true;
                break;
            case 2:
                $visited["c"][$block[1]][$block[2]] = true;
                break;
            case 3:
                $visited["d"][$block[1]][$block[2]] = true;
                break;
            case 4:
                $visited["f"][$block[1]][$block[2]] = true;
                break;
            case 5:
                $visited["e"][$block[1]][$block[2]] = true;
                break;
        }
    }

    // this variable will keep the paths seperate
    $pathNum = 0;

    ///// find an unvisited node to continue BFS////
    z: 
    $found = false;
    for ($i=97;$i<103;$i++){
        $face = chr($i);
        $rows = count($visited[$face]);
        for ($j=0;$j<$rows;$j++){
            $x = array_search(false, $visited[$face][$j]);
            if ($x !== false){
                $found = true;
                $y = $j;
                echo $face ." , " . $y . "," . $x;
                break(2);
            }
        }
    }

    // if I didn't find a false then I visited every node and can analyze the connections
    if (!$found)goto g;
    $visited[$face][$y][$x] = true;
    $q[] = [$face, $y, $x];
    $path[$pathNum][] = 1;
    while ($q){
        $node = array_pop($q);
        $f = $node[0];
        $y = $node[1];
        $x = $node[2];
        // check up / left / down / right and add to que if unvisited
        // should probably use a switch statement here to seperate different faces 
        switch ($f){
        case "a":
            foreach ($offset as $os){
                // check connection on the right
                if ($x+$os[1] > $lengtha){
                    if (!$visited["b"][$y][0]){
                        $q[] = ["b", $y, 0]; 
                        $visited["b"][$y][0] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the left
                }else if ($x+$os[1] < 0){
                    if (!$visited["f"][$sizef - $y][0]){
                        $q[] = ["f", $sizef - $y, 0]; 
                        $visited["f"][$sizef - $y][0] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the top
                }else if ($y+$os[0] < 0){
                    if (!$visited["e"][$x][0]){
                        $q[] = ["e", $x, 0]; 
                        $visited["e"][$x][0] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the bottom
                }else if ($y+$os[0] > $sizea){
                    if (!$visited["d"][$sized - $x][0]){
                        $q[] = ["d", $sized - $x, 0]; 
                        $visited["d"][$sized - $x][0] = true;
                        $path[$pathNum][] = 1;
                    }
                // same-face connection
                }else if (!$visited["a"][$y+$os[0]][$x+$os[1]]){
                        $q[] = ["a", $y+$os[0], $x+$os[1]]; 
                        $visited["a"][$y+$os[0]][$x+$os[1]] = true;
                        $path[$pathNum][] = 1;
                }
            }
            break;
        case "b":
            foreach ($offset as $os){
                // check connection on the right
                if ($x+$os[1] > $lengthb){
                    if (!$visited["c"][$y][0]){
                        $q[] = ["c", $y, 0]; 
                        $visited["c"][$y][0] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the left
                }else if ($x+$os[1] < 0){
                    if (!$visited["a"][$y][$lengtha]){
                        $q[] = ["a", $y, $lengtha]; 
                        $visited["a"][$y][$lengtha] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the top
                }else if ($y+$os[0] < 0){
                    if (!$visited["e"][$sizee][$x]){
                        $q[] = ["e", $sizee, $x]; 
                        $visited["e"][$sizee][$x] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the bottom
                }else if ($y+$os[0] > $sizeb){
                    if (!$visited["d"][0][$x]){
                        $q[] = ["d", 0, $x]; 
                        $visited["d"][0][$x] = true;
                        $path[$pathNum][] = 1;
                    }
                // same-face connection
                }else if (!$visited["b"][$y+$os[0]][$x+$os[1]]){
                        $q[] = ["b", $y+$os[0], $x+$os[1]]; 
                        $visited["b"][$y+$os[0]][$x+$os[1]] = true;
                        $path[$pathNum][] = 1;
                }
            }
            break;

        case "c":
            foreach ($offset as $os){
                // check connection on the right
                if ($x+$os[1] > $lengthc){
                    if (!$visited["f"][$sizef - $y][$lengthf]){
                        $q[] = ["f",$sizef - $y, $lengthf]; 
                        $visited["f"][$sizef - $y][$lengthf] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the left
                }else if ($x+$os[1] < 0){
                    if (!$visited["b"][$y][$lengthb]){
                        $q[] = ["b", $y, $lengthb]; 
                        $visited["b"][$y][$lengthb] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the top
                }else if ($y+$os[0] < 0){
                    if (!$visited["e"][$sizee - $x][$lengthe]){
                        $q[] = ["e", $sizee - $x, $lengthe]; 
                        $visited["e"][$sizee - $x][$lengthe] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the bottom
                }else if ($y+$os[0] > $sizec){
                    if (!$visited["d"][$x][$lengthd]){
                        $q[] = ["d", $x, $lengthd]; 
                        $visited["d"][$x][$lengthd] = true;
                        $path[$pathNum][] = 1;
                    }
                // same-face connection
                }else if (!$visited["c"][$y+$os[0]][$x+$os[1]]){
                        $q[] = ["c", $y+$os[0], $x+$os[1]]; 
                        $visited["c"][$y+$os[0]][$x+$os[1]] = true;
                        $path[$pathNum][] = 1;
                }
            }
            break;

        case "d":
            foreach ($offset as $os){
                // check connection on the right
                if ($x+$os[1] > $lengthd){
                    if (!$visited["c"][$sizec][$y]){
                        $q[] = ["c", $sizec, $y]; 
                        $visited["c"][$sizec][$y] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the left
                }else if ($x+$os[1] < 0){
                    if (!$visited["a"][$sizea][$sized - $y]){
                        $q[] = ["a", $sizea, $sized - $y]; 
                        $visited["a"][$sizea][$sized - $y] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the top
                }else if ($y+$os[0] < 0){
                    if (!$visited["b"][$sizeb][$x]){
                        $q[] = ["b", $sizeb, $x]; 
                        $visited["b"][$sizeb][$x] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the bottom
                }else if ($y+$os[0] > $sized){
                    if (!$visited["f"][0][$x]){
                        $q[] = ["f", 0, $x]; 
                        $visited["f"][0][$x] = true;
                        $path[$pathNum][] = 1;
                    }
                // same-face connection
                }else if (!$visited["d"][$y+$os[0]][$x+$os[1]]){
                        $q[] = ["d", $y+$os[0], $x+$os[1]]; 
                        $visited["d"][$y+$os[0]][$x+$os[1]] = true;
                        $path[$pathNum][] = 1;
                }
            }
            break;

        case "e":
            foreach ($offset as $os){
                // check connection on the right
                if ($x+$os[1] > $lengthe){
                    if (!$visited["c"][0][$sizee - $y]){
                        $q[] = ["c", 0, $sizee - $y]; 
                        $visited["c"][0][$sizee - $y] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the left
                }else if ($x+$os[1] < 0){
                    if (!$visited["a"][0][$y]){
                        $q[] = ["a", 0, $y]; 
                        $visited["a"][0][$y] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the top
                }else if ($y+$os[0] < 0){
                    if (!$visited["f"][$sizef][$x]){
                        $q[] = ["f", $sizef, $x]; 
                        $visited["f"][$sizef][$x] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the bottom
                }else if ($y+$os[0] > $sizee){
                    if (!$visited["b"][0][$x]){
                        $q[] = ["b", 0, $x]; 
                        $visited["b"][0][$x] = true;
                        $path[$pathNum][] = 1;
                    }
                // same-face connection
                }else if (!$visited["e"][$y+$os[0]][$x+$os[1]]){
                        $q[] = ["e", $y+$os[0], $x+$os[1]]; 
                        $visited["e"][$y+$os[0]][$x+$os[1]] = true;
                        $path[$pathNum][] = 1;
                }
            }
            break;

        case "f":
            foreach ($offset as $os){
                // check connection on the right
                if ($x+$os[1] > $lengthf){
                    if (!$visited["c"][$sizef - $y][$lengthc]){
                        $q[] = ["c", $sizef - $y, $lengthc]; 
                        $visited["c"][$sizef - $y][$lengthc] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the left
                }else if ($x+$os[1] < 0){
                    if (!$visited["a"][$sizef - $y][0]){
                        $q[] = ["a",$sizef - $y, 0]; 
                        $visited["a"][$sizef - $y][0] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the top
                }else if ($y+$os[0] < 0){
                    if (!$visited["d"][$sized][$x]){
                        $q[] = ["d", $sized, $x]; 
                        $visited["d"][$sized][$x] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the bottom
                }else if ($y+$os[0] > $sizef){
                    if (!$visited["e"][0][$x]){
                        $q[] = ["e", 0, $x]; 
                        $visited["e"][0][$x] = true;
                        $path[$pathNum][] = 1;
                    }
                // same-face connection
                }else if (!$visited["f"][$y+$os[0]][$x+$os[1]]){
                        $q[] = ["f", $y+$os[0], $x+$os[1]]; 
                        $visited["f"][$y+$os[0]][$x+$os[1]] = true;
                        $path[$pathNum][] = 1;
                }
            }
            break;	
        }
    }
    $pathNum++;
    goto z;
    g:
    foreach ($path as $p){
        $size = count($p);
        echo $size.PHP_EOL;
        if ($size > 1)$cubeCount += ($size * ($size-1)) / 2;
    }

    // reset variables
    $path = [];
    $pathNum = 0;
    $visited["a"] = $cube["a"];
    $visited["b"] = $cube["b"];
    $visited["c"] = $cube["c"];
    $visited["d"] = $cube["d"];
    $visited["e"] = $cube["e"];
    $visited["f"] = $cube["f"];

    //mark all impassible blocks as visited
    foreach ($impassableCells as $block)
    {
        switch ($block[0]){
            case 0:
                $visited["a"][$block[1]][$block[2]] = true;
                break;
            case 1:
                $visited["b"][$block[1]][$block[2]] = true;
                break;
            case 2:
                $visited["c"][$block[1]][$block[2]] = true;
                break;
            case 3:
                $visited["d"][$block[1]][$block[2]] = true;
                break;
            case 4:
                $visited["f"][$block[1]][$block[2]] = true;
                break;
            case 5:
                $visited["e"][$block[1]][$block[2]] = true;
                break;
        }
    }

    // Perform another BFS with modified traversal parameters to get # of pairs on the net
    f: 
    $found = false;
    for ($i=97;$i<103;$i++){
        $face = chr($i);
        $rows = count($visited[$face]);
        for ($j=0;$j<$rows;$j++){
            $x = array_search(false, $visited[$face][$j]);
            if ($x !== false){
                $found = true;
                $y = $j;
                break(2);
            }
        }
    }

    // if I didn't find a false then I visited every node and can analyze the connections
    if (!$found)goto h;
    $visited[$face][$y][$x] = true;
    $q[] = [$face, $y, $x];
    $path[$pathNum][] = 1;
    while ($q){
        $node = array_pop($q);
        $f = $node[0];
        $y = $node[1];
        $x = $node[2];
        // check up / left / down / right and add to que if unvisited
        // should probably use a switch statement here to seperate different faces 
        switch ($f){
        case "a":
            foreach ($offset as $os){
                // check connection on the right
                if ($x+$os[1] > $lengtha){
                    if (!$visited["b"][$y][0]){
                        $q[] = ["b", $y, 0]; 
                        $visited["b"][$y][0] = true;
                        $path[$pathNum][] = 1;
                    }
                // same-face connection
                }else if (!$visited["a"][$y+$os[0]][$x+$os[1]] && $cube["a"][$y+$os[0]][$x+$os[1]] === 0){
                        $q[] = ["a", $y+$os[0], $x+$os[1]]; 
                        $visited["a"][$y+$os[0]][$x+$os[1]] = true;
                        $path[$pathNum][] = 1;
                }
            }
            break;
        case "b":
            foreach ($offset as $os){
                // check connection on the right
                if ($x+$os[1] > $lengthb){
                    if (!$visited["c"][$y][0]){
                        $q[] = ["c", $y, 0]; 
                        $visited["c"][$y][0] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the left
                }else if ($x+$os[1] < 0){
                    if (!$visited["a"][$y][$lengtha]){
                        $q[] = ["a", $y, $lengtha]; 
                        $visited["a"][$y][$lengtha] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the bottom
                }else if ($y+$os[0] > $sizeb){
                    if (!$visited["d"][0][$x]){
                        $q[] = ["d", 0, $x]; 
                        $visited["d"][0][$x] = true;
                        $path[$pathNum][] = 1;
                    }
                // same-face connection
                }else if (!$visited["b"][$y+$os[0]][$x+$os[1]]  && $cube["b"][$y+$os[0]][$x+$os[1]] === 0){
                        $q[] = ["b", $y+$os[0], $x+$os[1]]; 
                        $visited["b"][$y+$os[0]][$x+$os[1]] = true;
                        $path[$pathNum][] = 1;
                }
            }
            break;

        case "c":
            foreach ($offset as $os){
                // check connection on the left
                if ($x+$os[1] < 0){
                    if (!$visited["b"][$y][$lengthb]){
                        $q[] = ["b", $y, $lengthb]; 
                        $visited["b"][$y][$lengthb] = true;
                        $path[$pathNum][] = 1;
                    }
                // same-face connection
                }else if (!$visited["c"][$y+$os[0]][$x+$os[1]]  && $cube["c"][$y+$os[0]][$x+$os[1]] === 0){
                        $q[] = ["c", $y+$os[0], $x+$os[1]]; 
                        $visited["c"][$y+$os[0]][$x+$os[1]] = true;
                        $path[$pathNum][] = 1;
                }
            }
            break;

        case "d":
            foreach ($offset as $os){
                // check connection on the top
                if ($y+$os[0] < 0){
                    if (!$visited["b"][$sizeb][$x]){
                        $q[] = ["b", $sizeb, $x]; 
                        $visited["b"][$sizeb][$x] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the bottom
                }else if ($y+$os[0] > $sized){
                    if (!$visited["f"][0][$x]){
                        $q[] = ["f", 0, $x]; 
                        $visited["f"][0][$x] = true;
                        $path[$pathNum][] = 1;
                    }
                // same-face connection
                }else if (!$visited["d"][$y+$os[0]][$x+$os[1]]  && $cube["d"][$y+$os[0]][$x+$os[1]] === 0){
                        $q[] = ["d", $y+$os[0], $x+$os[1]]; 
                        $visited["d"][$y+$os[0]][$x+$os[1]] = true;
                        $path[$pathNum][] = 1;
                }
            }
            break;

        case "e":
            foreach ($offset as $os){
                // check connection on the top
                if ($y+$os[0] < 0){
                    if (!$visited["f"][$sizef][$x]){
                        $q[] = ["f", $sizef, $x]; 
                        $visited["f"][$sizef][$x] = true;
                        $path[$pathNum][] = 1;
                    }
                // same-face connection
                }else if (!$visited["e"][$y+$os[0]][$x+$os[1]]  && $cube["e"][$y+$os[0]][$x+$os[1]] === 0){
                        $q[] = ["e", $y+$os[0], $x+$os[1]]; 
                        $visited["e"][$y+$os[0]][$x+$os[1]] = true;
                        $path[$pathNum][] = 1;
                }
            }
            break;

        case "f":
            foreach ($offset as $os){
                // check connection on the top
                if ($y+$os[0] < 0){
                    if (!$visited["d"][$sized][$x]){
                        $q[] = ["d", $sized, $x]; 
                        $visited["d"][$sized][$x] = true;
                        $path[$pathNum][] = 1;
                    }
                // check connection on the bottom
                }else if ($y+$os[0] > $sizef){
                    if (!$visited["e"][0][$x]){
                        $q[] = ["e", 0, $x]; 
                        $visited["e"][0][$x] = true;
                        $path[$pathNum][] = 1;
                    }
                // same-face connection
                }else if (!$visited["f"][$y+$os[0]][$x+$os[1]]  && $cube["f"][$y+$os[0]][$x+$os[1]] === 0){
                        $q[] = ["f", $y+$os[0], $x+$os[1]]; 
                        $visited["f"][$y+$os[0]][$x+$os[1]] = true;
                        $path[$pathNum][] = 1;
                }
            }
            break;	
        }
    }

    $pathNum++;
    goto f;
    h:
    foreach ($path as $p){
        $size = count($p);
        if ($size > 1)$netCount += ($size * ($size-1)) / 2;
    }    

    return $cubeCount - $netCount;
}

