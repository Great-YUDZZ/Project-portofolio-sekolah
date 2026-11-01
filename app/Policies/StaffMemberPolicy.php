<?php

namespace App\Policies;

use App\Models\StaffMember;
use App\Models\User;

class StaffMemberPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, StaffMember $staffMember): bool
    {
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, StaffMember $staffMember): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, StaffMember $staffMember): bool
    {
        return $user->isAdmin();
    }
}
