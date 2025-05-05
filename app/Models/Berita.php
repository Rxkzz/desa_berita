<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
        'author_id',
        'kategori_berita_id',
        'title',
        'slug',
        'thumbnail',
        'content',
        'is_featured',
        'view_count' 
    ];
    
    
    public function incrementViewCount()
    {
        $this->increment('view_count');
        return $this;
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function kategoriBerita()
    {
        return $this->belongsTo(KategoriBerita::class);
    }

    public function banner()
    {
        return $this->hasOne(Banner::class);
    }

    
    public function scopeAccessibleByUser($query, $user)
    {
        if (in_array($user->role, ['admin', 'super_admin', 'superadmin'])) {
            return $query;
        }
        return $query->where('author_id', $user->id);
    }
    
}
