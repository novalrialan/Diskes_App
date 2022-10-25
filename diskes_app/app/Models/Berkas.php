<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;

    protected $table = 'berkas';
    protected $primaryKey = 'id';
    protected $fillable = ['pegawai_id', 'tanggal', 'title', 'keterangan', 'file'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function verifikasi()
    {
        return $this->hasMany(VerifikasiBerkas::class);
    }
}