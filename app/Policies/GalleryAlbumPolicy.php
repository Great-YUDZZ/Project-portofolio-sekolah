<?php

namespace App\Policies;

use App\Models\GalleryAlbum;
use App\Models\User;

class GalleryAlbumPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isGuru();
    }

    public function view(User $user, GalleryAlbum $album): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isGuru()) {
            return is_null($album->major_id) || ($user->major_id && $album->major_id === $user->major_id);
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isGuru();
    }

    public function update(User $user, GalleryAlbum $album): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isGuru() && $user->major_id && $album->major_id === $user->major_id) {
            return true;
        }

        return false;
    }

    public function delete(User $user, GalleryAlbum $album): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isGuru() && $user->major_id && $album->major_id === $user->major_id) {
            return true;
        }

        return false;
    }

    public function addPhotos(User $user, GalleryAlbum $album): bool
    {
        return $this->update($user, $album);
    }
}
