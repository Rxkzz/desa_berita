<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Filament\Models\Contracts\HasAvatar;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_url',  // Make sure this is included
    ];
    
    // Update the avatar URL getter
    /**
     * Get the URL for the user's avatar.
     *
     * @return string|null
     */
    public function getFilamentAvatarUrl(): ?string
    {
        // Asumsikan plugin menyimpan path di kolom 'avatar_url'
        // dan menggunakan disk 'public'
        if ($this->avatar_url) {
            // Mengembalikan URL publik ke file avatar
            return Storage::disk('public')->url($this->avatar_url);
        }

        // Kembalikan null jika tidak ada avatar_url,
        // Filament akan menampilkan avatar default/inisial
        return null;

        // Atau, jika Anda ingin fallback ke Gravatar:
        // return $this->avatar_url ? Storage::disk('public')->url($this->avatar_url) : $this->getGravatarUrl();
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    // Relasi ke berita
    public function beritas()
    {
        return $this->hasMany(Berita::class, 'author_id');
    }

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return true;
    }
}
