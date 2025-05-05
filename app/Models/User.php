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
        'avatar_url',  
    ];
    
    // Update the avatar URL getter
    /**
     * Get the URL for the user's avatar.
     *
     * @return string|null
     */
    public function getFilamentAvatarUrl(): ?string
    {
       
        if ($this->avatar_url) {
          
            return Storage::disk('public')->url($this->avatar_url);
        }

     
        return null;

    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    
    public function beritas()
    {
        return $this->hasMany(Berita::class, 'author_id');
    }

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return true;
    }
}
