<?php
$date = [
    '2019-1-3',
    '19-1-3',
    '3-1-2019',
    '3-Jan-19',
    '3-1-19',];
foreach($date as $i => $d){
    echo $i ."\r\n";
    var_dump(date_format(date_create($d), 'Y-M-d')) . PHP_EOL;