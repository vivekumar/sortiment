<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class NameListExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    function __construct($data) {
            $this->data = $data;
    }
    public function collection()
    {
        return collect($this->data);
    }
}
