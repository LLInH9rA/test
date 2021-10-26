<?php

namespace dateServices;

use SimpleXMLElement;

function getFormattedList(string $date, int $limit = 1, string $format = 'json')
{
    $dates = getList($date, $limit);
    
    if($format == 'json') {
        return json_encode($dates, JSON_UNESCAPED_UNICODE);
    } elseif($format == 'xml') {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><dates/>');

        foreach ($dates as $date) {
            $xml->addChild('date', $date);
        }
        return $xml->asXML();
    }
}

function getList(string $date, int $limit)
{
    $date = \DateTime::createFromFormat('Y-m-d', $date);
    $dates[] = $date->format('Y-m-d');

    for ($i=0; $i < $limit-1; $i++) { 
        $date->modify('+1 day');
        $dates[] = $date->format('Y-m-d');
    }
    
    return $dates;
}

