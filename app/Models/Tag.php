<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tag';

    protected $fillable = [
        'nama'
    ];

    // public function tag()
    // {
    //     return $this->hasMany(Tag::class, 'berita_tag', 'berita_id', 'tag_id');
    // }

    public function berita()
    {
        return $this->belongsToMany(Tag::class, 'berita_tag', 'tag_id', 'berita_id')->withTimestamps();
    }
}