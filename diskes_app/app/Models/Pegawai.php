<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'pegawai';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_pegawai', 'subbagian_id', 'jabatan'];

    public function subbagian()
    {
        return $this->belongsTo(Subbagian::class);
    }
}