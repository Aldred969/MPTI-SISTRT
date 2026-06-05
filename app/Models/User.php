<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Iuran;
use App\Models\Laporan;

#[Fillable([
    'nik',
    'nama',
    'email',
    'no_hp',
    'role',
    'password'
])]

#[Hidden([
    'password',
    'remember_token'
])]

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function iuran()
    {
        return $this->hasMany(Iuran::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }
}