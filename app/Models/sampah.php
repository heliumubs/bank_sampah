<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sampah extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_sampah',
        'keterangan',
        'jenis',
        'harga',
    ];
}