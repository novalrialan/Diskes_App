<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subbagian extends Model
{
    use HasFactory;
    protected $table = 'subbagian';
    protected $primaryKey = 'id';
    protected $fillable = ['namabagian'];
}
