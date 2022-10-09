<?php

function generatePort($digits = 4)
{
    $i = 0; //counter
    $portapi = ''; //our default pin is blank.
    $portwinbox = '';
    $portweb = '';
    while ($i < $digits) {
        //generate a random number between 0 and 9.
        $portapi .= rand(1, 9);
        $portwinbox .= rand(1, 9);
        $portweb .= rand(1, 9);
        $i++;
    }

    return $portapi;
}
