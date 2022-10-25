<?php

namespace App\Exports;

use App\Models\PengelolaanAngaran;
use Maatwebsite\Excel\Concerns\FromCollection;

class PengelolaanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PengelolaanAngaran::all();
    }
}
