<?php

namespace App\Http\Clients\Tests\Helpers;

class Helpers
{
    public static function csvToArray($path, $withHeader = false)
    {
        $csv = [];
        $file = fopen($path, 'r');

        while (($result = fgetcsv($file)) !== false) {
            $csv[] = $result;
        }

        fclose($file);

        if(!$withHeader){
            array_shift($csv);
        }

        return $csv;
    }
}
