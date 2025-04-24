<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['berita_id'];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }
}
