<?php
function escape($carpark){

    //Creates the Array of results and intializes the pointer tu calculate positions to move
    $result = array();
    $pointer = null;
    $countdown = 0;
    //To eliminate floors upper to our start position and establishes the intial start point
    foreach ($carpark as $floor) {
        $value = array_search(2, $floor, FALSE);

        if ($value >= 0) {
            $pointer = (array_search(2, $floor, FALSE) + 1);

            break;
        } else {
            array_shift($carpark);
        }
    }

    //Starts to calculate all moves
    $level = (count($carpark) - 1);
    foreach ($carpark as $floor) {

        if ($level == 0) {

            $move_positions = $pointer - count($floor);
            if ($move_positions != 0) {
                array_push($result, "R" . abs($move_positions));
                break;
            } else {
                break;
            }
        }

        $stairs = (array_search(1, $floor, FALSE) + 1);
        $move_positions = $pointer - $stairs;
        if ($move_positions != 0) {
            $countdown = 0;
            ($move_positions > 0) ? $Letter = "L" : $Letter = "R";
            array_push($result, $Letter . abs($move_positions));
            array_push($result, "D1");
            $countdown++;
        } else {
            $countdown++;
            if ($countdown > 1) {
                array_pop($result);
            }
            array_push($result, "D" . $countdown);
        }
        $pointer = $stairs;
        $level--;
    }

    return $result;
}

?>
