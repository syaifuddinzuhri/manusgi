<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $table = 'album';

    protected $fillable = [
        'album',
        'slug',
    ];

    public function galeri()
    {
        return $this->hasMany(Galeri::class);
    }
}