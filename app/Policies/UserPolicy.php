<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isGuru();
    }

    public function view(User $user, User $model): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isGuru() && $model->isSiswa() && $model->major_id === $user->major_id) {
            return true;
        }

        return $user->id === $model->id;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, User $model): bool
    {
        return $user->isAdmin() || $user->id === $model->id;
    }

    public function delete(User $user, User $model): bool
    {
        // Cannot delete oneself
        if ($user->id === $model->id) {
            return false;
        }

        return $user->isAdmin();
    }

    public function activateStudent(User $user, User $student): bool
    {
        if (!$student->isSiswa() || !$student->isPending()) {
            return false;
        }

        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isGuru() && $user->major_id && $student->major_id === $user->major_id) {
            return true;
        }

        return false;
    }

    public function rejectStudent(User $user, User $student): bool
    {
        return $this->activateStudent($user, $student);
    }
}
