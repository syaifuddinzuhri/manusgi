<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplikasi extends Model
{
    use HasFactory;

    protected $table = 'aplikasi';

    protected $fillable = [
        'logo',
        'nama',
        'alamat',
        'telepon',
        'facebook',
        'instagram',
        'youtube',
        'twitter',
        'meta_deskripsi',
        'meta_keyword',
    ];
}