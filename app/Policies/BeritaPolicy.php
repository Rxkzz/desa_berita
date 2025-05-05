<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Berita;
use Illuminate\Auth\Access\HandlesAuthorization;

class BeritaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_berita');
    }

    public function view(User $user, Berita $berita): bool
    {
        return $user->can('view_berita');
    }

    public function create(User $user): bool
    {
        return $user->can('create_berita');
    }

    public function update(User $user, Berita $berita): bool
    {
        return $user->can('update_berita');
    }

    public function delete(User $user, Berita $berita): bool
    {
        return $user->can('delete_berita');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_berita');
    }

    public function forceDelete(User $user, Berita $berita): bool
    {
        return $user->can('force_delete_berita');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_berita');
    }

    public function restore(User $user, Berita $berita): bool
    {
        return $user->can('restore_berita');
    }

    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_berita');
    }

    public function replicate(User $user, Berita $berita): bool
    {
        return $user->can('replicate_berita');
    }

    public function reorder(User $user): bool
    {
        return $user->can('reorder_berita');
    }
}
