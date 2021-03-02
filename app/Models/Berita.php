<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'thumbnail',
        'user_id',
        'kategori_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Adminsitrator'
        ]);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'berita_tag', 'berita_id', 'tag_id')
            ->withTimestamps();
    }
}