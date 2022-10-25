<?php

namespace App\Exports;

use App\Models\VerifikasiBerkas;
use Maatwebsite\Excel\Concerns\FromCollection;

class VerfikasiExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return VerifikasiBerkas::all();
    }
}