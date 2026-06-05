<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = [
        'user_id',
        'kategori',
        'judul',
        'isi_laporan',
        'status',
        'tanggapan_admin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}