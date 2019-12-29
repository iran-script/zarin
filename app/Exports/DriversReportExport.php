<?php

namespace App\Exports;

use App\Drivers;
use Maatwebsite\Excel\Concerns\FromCollection;

class DriversReportExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Drivers::all();
    }
}
