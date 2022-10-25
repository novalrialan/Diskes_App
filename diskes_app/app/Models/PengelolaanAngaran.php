<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengelolaanAngaran extends Model
{
    use HasFactory;

    protected $table = "pengelolaan_angaran";
    protected $fillable = [
        'kode_rekening',
        'keterangan',
        'perihal_persub_kegiatan',
        'anggaran',
        'waktu',
        'biaya',
        'total',
        'saldo',
        'penangung_jawab',

    ];
}