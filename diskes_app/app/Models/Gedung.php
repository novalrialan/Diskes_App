<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;

    protected $table = 'gedung';
    protected $primaryKey = 'id';
    protected $fillable = ['kode_gedung', 'tanggal_peminjaman', 'jumlah', 'keterangan'];

    // public function pegawai()
    // {
    //     return $this->belongsTo(Pegawai::class);
    // }
}