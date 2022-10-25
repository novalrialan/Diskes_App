<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiBerkas extends Model
{
    use HasFactory;

    protected $table = 'verifikasi_berkas';
    protected $primaryKey = 'id';
    protected $fillable = ['berkas_id', 'tanggal_verifikasi', 'status'];

    public function berkas()
    {
        return $this->belongsTo(Berkas::class);
    }
}