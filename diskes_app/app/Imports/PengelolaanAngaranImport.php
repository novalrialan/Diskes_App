<?php

namespace App\Imports;

use App\Models\PengelolaanAngaran;
use Maatwebsite\Excel\Concerns\ToModel;

class PengelolaanAngaranImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new PengelolaanAngaran([
            'kode_rekening' => $row[0],
            'keterangan' => $row[1],
            'perihal_persub_kegiatan' => $row[2],
            'anggaran' => $row[3],
            'waktu' => $row[4],
            'biaya' => $row[5],
            'total' => $row[6],
            'saldo' => $row[7],
            'penangung_jawab' => $row[8]
        ]);
    }
}