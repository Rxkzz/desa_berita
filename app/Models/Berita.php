<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = ['author_id', 'kategori_berita_id', 'title', 'slug', 'thumbnail', 'content', 'is_featured'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function kategoriBerita()
    {
        return $this->belongsTo(KategoriBerita::class);
    }

    public function banner()
    {
        return $this->hasOne(Banner::class);
    }
}
