<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBerita extends Model
{
    protected $fillable = ['title', 'slug'];

    public function berita()
    {
        return $this->hasMany(Berita::class);
    }
}
