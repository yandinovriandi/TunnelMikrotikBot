<?php

function generatePort($digits = 4)
{
    $i = 0; //counter
    $portapi = ''; //our default pin is blank.
    $portwinbox = '';
    $portweb = '';
    while ($i < $digits) {
        //generate a random number between 0 and 9.
        $portapi .= rand(1, 2);
        $portwinbox .= rand(3, 4);
        $portweb .= rand(5, 6);
        $i++;
    }

    return $portapi;
}
