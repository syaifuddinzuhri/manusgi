<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $fillable = [
        'gambar',
        'album_id',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}