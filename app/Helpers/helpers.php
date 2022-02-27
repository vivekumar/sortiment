<?php 
use Carbon\Carbon;

if (! function_exists('convertLocalToUTC')) {
    function convertLocalToUTC($time)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $time, 'Europe/Paris')->setTimezone('UTC');
    }
}

if (! function_exists('convertUTCToLocal')) {
    function convertUTCToLocal($time)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $time, 'UTC')->setTimezone('Europe/Paris');
    }
}

if (! function_exists('convertINRToDDK')) {
    function convertINRToDDK($amount)
    {
    	$formatter = new NumberFormatter('de_DE',  NumberFormatter::CURRENCY);
		return  $formatter->formatCurrency($amount, 'DKK'), PHP_EOL;
        
    }
}


