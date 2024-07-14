<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pupuk extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'jenis',
        'foto',
        'deskripsi',
        'fungsi',
    ];
}