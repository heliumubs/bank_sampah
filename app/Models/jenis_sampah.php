<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_sampah extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'deskripsi',
    ];
}