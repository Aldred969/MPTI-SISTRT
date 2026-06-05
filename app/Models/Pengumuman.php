<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [
        'judul',
        'isi_pengumuman',
        'tanggal_mulai',
        'tanggal_selesai',
        'aktif'
    ];
}