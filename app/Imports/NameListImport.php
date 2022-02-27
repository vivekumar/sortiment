<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
class NameListImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        //dd($row);
         //return $collection;
    }
}
