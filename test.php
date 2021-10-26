<?php 

require_once __DIR__.'/services/date.php';

use function dateServices\getList as getList;
use function dateServices\getFormattedList as getFormattedList;

if(isset($_GET['date']) && isset($_GET['limit']) && isset($_GET['format'])) {
    if($_GET['format'] == 'json') {
        header('Content-Type: application/json; charset=utf-8');
    } elseif($_GET['format'] == 'xml') {
        header('Content-Type: application/xml; charset=utf-8');
    }

    print getFormattedList($_GET['date'], $_GET['limit'], $_GET['format']);
}

if (isset($argv[1])) {
    $dates = getList($argv[1], $argv[2]);
    foreach ($dates as $date) {
        print($date).PHP_EOL;
    }
}
