<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BeritaUnggulan extends Model
{
    protected $table = 'beritas';

    protected static function booted()
    {
        static::addGlobalScope('is_featured', function (Builder $builder) {
            $builder->where('is_featured', true);
        });
    }

 
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function kategoriBerita()
    {
        return $this->belongsTo(KategoriBerita::class);
    }
}