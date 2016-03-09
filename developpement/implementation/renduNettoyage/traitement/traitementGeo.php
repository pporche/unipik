<?php

function traitementGeo(&$geo) {
    //concatenation des coordonnées géographique
    $coord = [];
    $temp = [];
    $coord[0] = $geo[1].'.'.$geo[2];
    $coord[1] = $geo[3].'.'.$geo[4];

    $temp[0] = $geo[0];
    $temp[1] = $coord[0];
    $temp[2] = $coord[1];

    $geo = $temp;
}

?>