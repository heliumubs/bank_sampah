<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class koin extends Model
{
    use HasFactory;
    protected $fillable = ['pengguna_id', 'jumlah','status','tgl_in'];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }
}