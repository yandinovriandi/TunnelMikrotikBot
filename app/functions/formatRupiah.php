<?php

function formatRupiah($string)
{
    return str_replace(',', '.', number_format($string));
}
