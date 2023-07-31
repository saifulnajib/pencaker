<?php

use Illuminate\Support\HtmlString;

function convertToDMS($coordinate, $isLongitude = false): HtmlString
{
    $coordinate = (float)$coordinate;
    $direction = $isLongitude ? ($coordinate < 0 ? 'BB' : 'BT') : ($coordinate < 0 ? 'LS' : 'LU');
    $coordinate = abs($coordinate);
    $degrees = floor($coordinate);
    $tempMinutes = ($coordinate - $degrees) * 60;
    $minutes = floor($tempMinutes);
    $seconds = round(($tempMinutes - $minutes) * 60, 2);
    return new HtmlString(<<<HTML
        <span>$degrees&#176; $minutes' $seconds" $direction</span>
    HTML);
}
